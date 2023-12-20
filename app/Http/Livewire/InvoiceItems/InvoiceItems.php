<?php

namespace App\Http\Livewire\InvoiceItems;

use App\Models\ArrestReceipt;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\InvoiceItem;
use Livewire\WithPagination;
use App\Models\InvoiceDiscount;
use Session;

class InvoiceItems extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $invoice;
    public $invoice_items;
    public $discount;
    public $sumdesc, $events = [];

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

    protected $listeners = [
        'refreshInvoiceItemsList' => 'ActionRefreshInvoiceItemsList'
    ];

    function ActionRefreshInvoiceItemsList()
    {

    }

    function UpdateItem()
    {

        foreach ($this->invoice_items as $item) {
            $invoice_item = InvoiceItem::where('id', $item['id'])->first();
            $invoice_item->quantity = $item['quantity'];
            $invoice_item->purchasing_price = $item['purchasing_price'];
            $invoice_item->selling_price = $item['selling_price'];
            $invoice_item->save();
        }

    }

    function DeleteItem($id)
    {
         InvoiceItem::where('id', $id)->delete();
    }

    public function render()
    {
        $this->invoice_items = InvoiceItem::where('invoice_id', $this->invoice->id)->with('unit','item','item.units','serial')->get()->toArray();
        return view('livewire.invoice-items.invoice-items');
    }

    public function updateActivite($subtotal = null, $totalprice = null)
    {

        ArrestReceipt::updateOrCreate(['invoice_id' => $this->invoice->id],[
            'user_id' => $this->invoice->user_id,
            'date' => $this->invoice->date,
            'advance' => $this->invoice->sub_total-$this->invoice->total_price,
            'type' => $this->invoice->type,
        ]);

        $invoice = Invoice::find($this->invoice->id);
        $invoice->update([
            'sub_total' => $subtotal,
            'total_price' => $totalprice,
            'balanceUser' => $totalprice,
            'is_active' => 1]);
        $this->emit('alertSuccess', 'Created Successfully');

    }
}
