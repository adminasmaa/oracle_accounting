<?php

namespace App\Http\Livewire\Reports;

use App\Models\Payroll;
use App\Models\PayrollItem;
use App\Models\InvoiceItem;
use App\Models\Invoice;
use App\Models\User;
use App\Models\ArrestReceipt;
use App\Models\InvoiceDiscount;
use Livewire\Component;
use Livewire\WithPagination;

class Reports extends Component
{
    use WithPagination;

    public $from, $to;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshReportsList' => 'ActionRefreshReportsList'
    ];

    function ActionRefreshReportsList()
    {
    }

    public function mount()
    {
        // $this->from = date('Y-m-d');
        // $this->to = date('Y-m-d');

        // $this->from = date('Y-m-d', strtotime($this->from));
        // $this->to = date('Y-m-d', strtotime($this->to) +(24 * 60 * 60) );

        if (request('from')) {
            $this->from = request('from');
        }

        if (request('to')) {
            $this->to = request('to');
        }
    }

    public function render()
    {

        $invoices = InvoiceItem::query();
        if (auth()->user()->hasRole('Admin')) {
            $invoices = $invoices;
        } else {
            $invoices = $invoices;
        }

        if ($this->from && $this->to) {
            $invoices = $invoices->whereBetween('created_at', array_map('strval', [$this->from, $this->to]));

        }
        $invoices1 = Invoice::get();
        $invoicesell = $invoices1->where('type', 0)->whereBetween('created_at', array_map('strval', [$this->from, $this->to]))->sum('sub_total');
// dump($invoicesell);
        $invoiceitems = $invoices->WhereHas('invoice', function ($q) {
            return $q->where('type', '0')->select('invoice_number');
        })->get();
        $invoiceitems = InvoiceItem::WhereHas('invoice', function ($q) {
            return $q->where('type', '0')->select('invoice_number');
        })->get();
        $invoiceitemssum = InvoiceItem::WhereHas('invoice', function ($q) {
            return $q->where('type', '0');
        })->sum('profit');
        // dd($invoiceitemssum);
        $invoice_earned_discount = InvoiceDiscount::WhereHas('invoice', function ($q) {
            return $q->where('type', '1');
        })->sum('discount_quantity');

        $invoice_discountـpermitted = InvoiceDiscount::WhereHas('invoice', function ($q) {
            return $q->where('type', '0');
        })->sum('discount_quantity');

        $arrestreceipt = ArrestReceipt::where('type', 3)->get();
        $arrestreceiptsum = ArrestReceipt::where('type', 3)->sum('batch_quantity');

        // dd($invoice_earned_discount);
        // dd($invoice[0]->invoice);
        return view('livewire.reports.reports', [
            'invoiceitems' => $invoiceitems,
            'invoiceitemssum' => $invoiceitemssum,
            'invoice_earned_discount' => $invoice_earned_discount,
            'invoice_discountـpermitted' => $invoice_discountـpermitted,
            'arrestreceipt' => $arrestreceipt,
            'arrestreceiptsum' => $arrestreceiptsum
        ]);
    }

}
