<?php

namespace App\Http\Livewire\ArrestReceipts;

use Illuminate\Http\Request;

use App\Models\ArrestReceipt;
use App\Models\Limitation;
use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;
use \Carbon\Carbon;
use Session;

class ArrestReceiptCreate extends Component
{
    public $arrest_receipt = ['batch_quantity' => 0];
    public $invoice, $type;
    public $invoice_id;
    public $typeinv;
    public $date, $user_id_invoice;


    public function mount($invoice_id = null)
    {
        $invoice_id = $this->invoice_id;

        if ($invoice_id) {
            if (is_object($invoice_id)) {
                $this->invoice = $invoice_id;
            } else {
                $this->invoice = Invoice::findOrFail($invoice_id);
                $this->type = $this->invoice->type;
            }
            $this->arrest_receipt['invoice_id'] = $this->invoice->id;
            $this->arrest_receipt['user_id'] = 0;
            $this->arrest_receipt['date'] = $this->invoice->invoice_date;
            $this->user_id_invoice = $this->invoice->user_id;

        }
        if (array_key_exists(request('type'), ArrestReceipt::typeList(false))) {
            $this->type = request('type');
        }
        $this->arrest_receipt['type'] = $this->type;
        if ($this->arrest_receipt['batch_quantity']) {
            $this->store();
        }
        $this->arrest_receipt['batch_quantity'] = ($recipt = ArrestReceipt::where('invoice_id', $this->arrest_receipt['invoice_id'])->first()) ? $recipt->batch_quantity : 0;

    }


    public function store(Request $request)
    {


        $data = $this->validate([
            // 'arrest_receipt.invoice_id' => 'nullable|int|exists:invoices,id',
            // 'arrest_receipt.user_id' => 'nullable|int',
            'arrest_receipt.batch_quantity' => 'required|numeric',
            'arrest_receipt.type' => 'nullable',
            'arrest_receipt.date' => 'nullable',
            'arrest_receipt.advance' => 'nullable',
        ]);

        $data['arrest_receipt']['invoice_id'] = $this->invoice_id;
        $data['arrest_receipt']['type'] = $this->type;

        if ($data['arrest_receipt']['batch_quantity'] > 0) {
            if ($this->invoice_id) {
                ArrestReceipt::updateOrCreate([
                    'invoice_id' => $data['arrest_receipt']['invoice_id']
                ], $data['arrest_receipt']);
                Limitation::create([
                    'invoice_id' => $data['arrest_receipt']['invoice_id'],
                    'date' => $data['arrest_receipt']['date'],
                    'user_id' => $this->user_id_invoice,
                ]);
            }
        }

        Session::flash("msg", "Successfully");

        $this->emit('refreshArrestReceiptsList');
        $this->emit('refreshInvoiceShow');
        $this->emit('refreshInvoiceItemsList');

        $this->dispatchBrowserEvent('close-modal');

    }

    public function render()
    {

        return view('livewire.arrest-receipts.arrest-receipt-create', [
            'invoices' => Invoice::all(),
            'users' => User::role((($this->arrest_receipt and $this->arrest_receipt['type'] == 1) ? 'Customer' : 'Supplier'))->get(),
        ]);
    }
}
