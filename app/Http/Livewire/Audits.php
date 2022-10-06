<?php

namespace App\Http\Livewire;

use App\Models\Audit;
use Livewire\Component;
use Livewire\WithPagination;

class Audits extends Component
{
    use WithPagination;

    protected $audits;

    public function boot()
    {
        $this->audits = Audit::query()->paginate(10);
    }
    public function render()
    {
        $audits2 = Audit::query()->orderBy('id', 'DESC')->paginate(10);
        $audits = Audit::query()->paginate(10);
        return view('livewire.audits',['audits' => $audits2]);
    }
}
