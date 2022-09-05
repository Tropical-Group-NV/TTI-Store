<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Filter extends Component
{
    public $brands;
    public $branches;

    public function mount()
    {
        $this->brands = DB::connection('qb_sales')->table('filter_brand')->orderBy('name')->get();
        $this->branches = Branch::query()->orderBy('CustomFieldBranch')->get();
    }
    public function render()
    {
        return view('livewire.filter');
    }
}
