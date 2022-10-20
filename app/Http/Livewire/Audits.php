<?php

namespace App\Http\Livewire;

use App\Models\Audit;
use App\Models\AuditMail;
use Livewire\Component;
use Livewire\WithPagination;

class Audits extends Component
{

    /** TODO: Livewire controller for audits */
    use WithPagination;

    public $auditType;
    protected $audits;
    protected $auditMails;

    public function boot()
    {
        $this->auditType = 1;
        $this->audits = Audit::query()->paginate(10);
    }
    public function render()
    {
        /** TODO: view audits */
        $audits2 = Audit::query()->orderBy('id', 'DESC')->paginate(10);
        $audits = Audit::query()->paginate(10);
        $auditMails = AuditMail::query()->latest()->paginate(10);
        return view('livewire.audits',['audits' => $audits2, 'auditMails' => $auditMails]);
    }

    /** TODO: toggle audits */


    public function mailAudit()
    {
        $this->auditType = 2;
    }
    public function dataAudit()
    {
        $this->auditType = 1;
    }
}
