<?php

namespace App\Http\Livewire;

use App\Models\SalesRep;
use Livewire\Component;

class SalesrepOrderReport extends Component
{

    public $reps;

    public function mount()
    {
        $this->reps = SalesRep::query()->where('IsActive', 1)->orderBy('SalesRepEntityRefFullName', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.salesrep-order-report');
    }
}
