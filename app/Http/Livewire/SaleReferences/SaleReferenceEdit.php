<?php

namespace App\Http\Livewire\SaleReferences;

use App\Models\ArrestReceipt;
use App\Models\Invoice;
use App\Models\User;
use App\Models\InvoiceItem;
use Livewire\WithPagination;
use App\Models\InvoiceDiscount;
use Livewire\Component;

class SaleReferenceEdit extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $invoice;
    public $discount;
    public $sumdesc;

    protected $listeners = [
        'refreshSaleReferenceShow' => 'ActionRefreshSaleReferenceShow'
    ];

    public function ActionRefreshSaleReferenceShow()
    {

    }

    public function mount($invoice_id)
    {

        if (is_object($invoice_id)) {
            $this->invoice = $invoice_id;
        } else {
            $this->invoice = Invoice::findOrFail($invoice_id);
            $this->discount = InvoiceDiscount::where('invoice_id', $this->invoice->id)->get();
            $this->sumdesc = 0;
            foreach ($this->discount as $disc) {
                $this->sumdesc = $this->sumdesc + ($disc->discount_quantity);

            }
        }
    }


    public function render()
    {
        // dd("wsw");
        return view('livewire.sale-references.sale-reference-edit', [
            'users' => User::role((($this->invoice and $this->invoice['type'] == 3) ? 'Supplier' : 'Customer'))->get(),
            'invoice_items' => InvoiceItem::where('invoice_id', $this->invoice->id)->paginate(9),
            'invoice' => Invoice::findOrFail($this->invoice->id),
        ]);
    }

    public function updateActivite($subtotal = null, $totalprice = null)
    {

        $invoice = Invoice::find($this->invoice->id);
        $invoice->update([
            'sub_total' => $subtotal,
            'total_price' => $totalprice,
            'is_active' => 1]);

    }

}
