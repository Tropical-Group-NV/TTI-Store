<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Filter extends Component
{

//    TODO Controller for filters
    public $brands;
    public $branches;
    public $privateBranches;
    public $req_brand;
    public $req_branch;
    public $req_unit;

    public function mount()
    {
        $this->privateBranches = DB::connection('qb_sales')->table('settings_branch_view_item_on_user')->get()->all();
        $this->brands = DB::connection('qb_sales')->table('filter_brand')->orderBy('name')->get();
        $this->branches = Branch::query()->orderBy('CustomFieldBranch')->get();
        if (isset($_REQUEST['brand']))
        {
            $this->req_brand = $_REQUEST['brand'];
        }
        if (isset($_REQUEST['branch']))
        {
            $this->req_branch = $_REQUEST['branch'];
        }
        if (isset($_REQUEST['unit']))
        {
            $this->req_unit = $_REQUEST['unit'];
        }
    }
    public function render()
    {
        return view('livewire.filter');
    }
}
