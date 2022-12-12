<?php

namespace App\Http\Livewire;

use App\Models\Quotation;
use Livewire\Component;
use Livewire\WithPagination;

class ViewQuotations extends Component
{
    use WithPagination;

    public function render()
    {
        $quotations = Quotation::query()->orderBy('id', 'DESC')->paginate(20);
        return view('livewire.view-quotations', ['quotations'=> $quotations]);
    }

    public function delete($qID)
    {
        Quotation::query()->where('id', $qID)->delete();
        $this->dispatchBrowserEvent('deletedQuotation', ['qID' => $qID] );
    }
}
