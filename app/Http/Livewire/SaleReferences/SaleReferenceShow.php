<?php

namespace App\Http\Livewire\SaleReferences;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Item;
use App\Models\SerialNumber;
use App\Models\UnitItem;
use App\Models\Unit;
use App\Models\InvoiceItem;
use Livewire\Component;
use Session;

class SaleReferenceShow extends Component
{
    public $invoice_item = ['item_id' => 0, 'unit_id' => 0, 'quantity' => 1];
    public $invoice;
    public $date;
    public $user, $serial;
    protected $listeners = [
        'refreshSaleReferenceShow' => 'ActionRefreshSaleReferenceShow'
    ];

    public function ActionRefreshSaleReferenceShow()
    {

    }

    public function mount($reference_id)
    {
        // dd($reference_id);
        if (auth()->user()->hasRole('Admin')) {
            $this->invoice = Invoice::where('id', $reference_id)->firstOrFail();
        } else {
            $this->invoice = Invoice::where('id', $reference_id)->where('user_id', auth()->id())->firstOrFail();
        }
        $this->invoice_it = InvoiceItem::where('invoice_id', $reference_id)->first();


        if (is_object($reference_id)) {
            $this->invoice = $reference_id;
        } else {
            $this->invoice = Invoice::findOrFail($reference_id);
        }
        $this->invoice_item['invoice_id'] = $this->invoice->id;
        $this->invoice_item['user_id'] = 0;
        $this->invoice_item['index_account_id'] = $this->invoice->index_account_id;


    }

    public function selectUser($user_id)
    {

        // dd($user_id);
        $this->user = User::find($user_id);
        $this->invoice->user_id = $this->user->id;
        $this->invoice->invoice_date = $this->date;
        $this->invoice->save();
        $this->emit('refreshSaleReferenceShow');
        $this->dispatchBrowserEvent('close-modal');

    }

    public function store()
    {
        $data = $this->validate([
            'invoice_item.description' => 'nullable',
            'invoice_item.item_name' => 'string',
            'invoice_item.invoice_id' => 'required|int|exists:invoices,id',
            'invoice_item.item_id' => 'required|int|exists:items,id',
            'invoice_item.user_id' => 'required|int',
            'invoice_item.unit_id' => 'required|int|exists:units,id',
            'invoice_item.index_account_id' => 'nullable|int|exists:index_accounts,id',
            'invoice_item.purchasing_price' => 'required|numeric',
            'invoice_item.selling_price' => 'required|numeric',
            'invoice_item.quantity' => 'nullable|numeric',
            'date' => 'required',
            'user' => 'required',
            'invoice_item.total_price_quantity' => 'nullable|numeric',
            'invoice_item.total_selling_price_quantity' => 'nullable|numeric',
        ]);


        $item = Item::where('id', $data['invoice_item']['item_id'])->first();
        $data['invoice_item']['item_name'] = $item->name;
        ///////////////////////// فواتير البيع ///////////////////////////////


        if ($this->invoice->type == 2) {
            $item_unit = $item->units->where('id', $data['invoice_item']['unit_id'])->first();
            $item_unit->update([
                'selling_price' => $data['invoice_item']['selling_price'],
            ]);

            $quantity = $data['invoice_item']['quantity'];

            if ($item->qty > $item_unit->pieces * $quantity) {
                $item->update(['qty' => ($item->qty) - $item_unit->pieces * $quantity]);
                // $item_unit->update(['selling_price'=>$data['invoice_item']['selling_price']]);

            } else {
                $this->emit('alertFailed', 'the quantity not avaliable');
                return false;
            }

            $check_item_exists = InvoiceItem::where('invoice_id', $data['invoice_item']['invoice_id'])->where('item_name', $data['invoice_item']['item_name'])->where('unit_id', $data['invoice_item']['unit_id'])->first();
            if ($check_item_exists) {

                $data['invoice_item']['quantity'] = $check_item_exists->quantity + $data['invoice_item']['quantity'];
                $check_item_exists->update($data['invoice_item']);

            } else {
                InvoiceItem::create($data['invoice_item']);
            }
        }

        Session::flash("msg", "Successfully");


        ///////////////////// فواتير الشراء /////////////////////////

        if ($this->invoice->type == 3) {

            $item_unit = $item->units->where('id', $data['invoice_item']['unit_id'])->first();
            $oldprice = $item_unit->purchasing_price;
            $oldquntity = $item->qty;
            $newPrice = $data['invoice_item']['purchasing_price'];
            $newquntity = $data['invoice_item']['quantity'] * $item_unit->pieces;
            $update_price = (($oldquntity + $newquntity) ? ($oldprice * $oldquntity + $newPrice * $newquntity) / ($oldquntity + $newquntity) : 0);
            $item_unit->update(['purchasing_price' => $update_price]);


            $item->update(['qty' => $oldquntity + ($data['invoice_item']['quantity'] * $item_unit->pieces)]);
            $ifitemexist = InvoiceItem::where('invoice_id', $data['invoice_item']['invoice_id'])->where('item_name', $data['invoice_item']['item_name'])->where('unit_id', $data['invoice_item']['unit_id'])->first();


            if ($ifitemexist) {
                $data['invoice_item']['quantity'] = ($data['invoice_item']['quantity'] * $item_unit->pieces) + $ifitemexist->quantity;
                $ifitemexist->update($data['invoice_item']);
            } else {

                InvoiceItem::create($data['invoice_item']);

            }
            Session::flash("msg", "Successfully");

        }

        $this->emit('refreshSaleReferenceShow');

        // $this->reset('invoice_item');
        // $this->invoice_item = ['item_id'=> 0,'unit_id'=> 0];
    }


    public function render()
    {
        // dump($this->invoice_item['quantity']);
        $serial = SerialNumber::where('serial', $this->serial)->first();
        if ($serial) {
            $unitdata = Unit::find($serial->unit_id);
            $itemid = $unitdata->item_id;
            $item = Item::find($itemid);

            if ($item) {
                $this->invoice_item['quantity'] = $this->invoice_item['quantity'];
                $newunit = $item->where('id', $itemid)->first();
                if (!$newunit) {
                    $newunit = $item->where('id', $itemid)->first();
                    // $newunit = $unitdata->where('item_id', $itemserial->id)->first();
                }
                $this->invoice_item['item_id'] = $newunit ? $newunit->id : 0;
            }
        } else {
            $unitdata = null;
            $itemid = null;
        }


        // $this->invoice_item['item_id']
        $item = Item::find($itemid);
        if ($item) {
            // dd($this->invoice_item['quantity']);
            $this->invoice_item['quantity'] = $this->invoice_item['quantity'];
            $newunit = $item->units->where('id', $this->invoice_item['unit_id'])->first();

            if (!$newunit) {
                $newunit = $item->units->where('item_id', $this->invoice_item['item_id'])->first();

            }

            //    $this->invoice_item['unit_id']= $unitdata->item_id;
            $this->invoice_item['unit_id'] = $newunit ? $newunit->id : 0;


            $this->invoice_item['purchasing_price'] = $newunit ? $newunit->purchasing_price : 0;

            $this->invoice_item['total_price_quantity'] = $this->invoice_item['purchasing_price'] * $this->invoice_item['quantity'];
            //  dd($this->invoice_item['total_price_quantity']);

            $this->invoice_item['selling_price'] = $newunit ? $newunit->selling_price : 0;

            $this->invoice_item['total_selling_price_quantity'] = $this->invoice_item['selling_price'] * $this->invoice_item['quantity'];

        }
        $unititem = UnitItem::where('item_id', $itemid)->get();
        if ($unititem) {
            foreach ($unititem as $unititems)
                $this->itemunit = Unit::where('id', $unititems->unit_id)->get();
        }

        return view('livewire.sale-references.sale-reference-show', [
            'users' => User::role((($this->invoice and $this->invoice['type'] == 3) ? 'Supplier' : 'Customer'))->get(),
            'items' => Item::all(),
            'units' => $item ? $item->unit_item : [],

        ]);
    }

}
