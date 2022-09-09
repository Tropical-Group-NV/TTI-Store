<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Filter extends Component
{
    public $brands;
    public $branches;
    public $privateBranches;

    public function mount()
    {
        $this->privateBranches = DB::connection('qb_sales')->table('settings_branch_view_item_on_user')->get()->all();
        $this->brands = DB::connection('qb_sales')->table('filter_brand')->orderBy('name')->get();
        $this->branches = Branch::query()->orderBy('CustomFieldBranch')->get();
    }
    public function render()
    {
        return view('livewire.filter');
    }
}
