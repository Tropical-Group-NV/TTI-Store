<?php

namespace App\Http\Livewire;

use App\Models\CrmInteraction;
use App\Models\Quotation;
use Illuminate\Support\Facades\Storage;
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

    public function exportPDF($id)
    {
        $quotation = Quotation::query()->where('id', $id)->first();
        $data = ['model' => $quotation, 'quotation' => $quotation];
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.quotation', $data);
        $pdf->setPaper('a4', 'portrait');
        $savePdf =  $pdf->download('Q-' . time() . '.pdf')->getOriginalContent();
        $filename = '/quotation/Q-' . time();
        Storage::put($filename, $savePdf);
        return Storage::download($filename);
    }
}
