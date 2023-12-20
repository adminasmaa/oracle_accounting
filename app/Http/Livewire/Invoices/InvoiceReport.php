<?php

namespace App\Http\Livewire\Invoices;

use App\Models\IndexAccount;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class InvoiceReport extends Component
{
    public $from, $to;

    public function mount()
    {
        if (request('role_id')) {
            $this->role_id = request('role_id')?request('role_id'):3;
        }else{
            $this->role_id = 3;
        }


        $this->from = date('Y-m-d');
        $this->to = date('Y-m-d');

        $this->from = date('Y-m-d', strtotime($this->from));
        $this->to = date('Y-m-d', strtotime($this->to) + (24 * 60 * 60));

        if (request('from')) {
            $this->from = request('from');
        }

        if (request('to')) {
            $this->to = request('to');
        }

    }

    public function render()
    {
        $invoices = Invoice::query();
        if (auth()->user()->hasRole('Admin')) {
            $invoices = $invoices;
        } else {
            $invoices = Invoice::where('user_id', auth()->id());
        }

        if ($this->from && $this->to) {
            $invoices = $invoices->whereBetween('invoice_date', array_map('strval', [$this->from, $this->to]));

        }

        $invoice = $invoices->where('type', 0)->paginate(10);

        // $invoice = Invoice::where('type',0)->where('is_active',1)->get();

        return view('livewire.invoices.invoice-report', [
            'invoice' => $invoice,

        ]);
    }
}
