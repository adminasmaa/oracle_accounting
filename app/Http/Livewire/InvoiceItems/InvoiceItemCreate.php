<?php

namespace App\Http\Livewire\InvoiceItems;

use App\Models\IndexAccount;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\SerialNumber;
use App\Models\UnitItem;
use App\Models\Item;
use App\Models\Unit;
use App\Models\User;
use Livewire\Component;
use Session;

class InvoiceItemCreate extends Component
{
    public $invoice_item = [ 'item_id' => 0, 'unit_id' => 0, 'quantity' => 1 ,'purchasing_price' => 0 ,'selling_price' => 0 ];
    public $items = [];
    public $unit;
    public $invoice;
    public $item_number;
    public $unitsele = array();
    public $invoice_it, $description, $pricelive, $quantitylive;
    public $serial, $itemunit, $events = [], $unititem, $keys, $search, $item_results = [], $selectedserialoption = [], $serialresult;
    public $total_price_quantity, $total_selling_price_quantity;


    public function mount($invoice_id)
    {

        if (is_object($invoice_id)) {
            $this->invoice = $invoice_id;
        } else {
            $this->invoice = Invoice::findOrFail($invoice_id);
        }
        if (request('search')) {
            $this->search = request('search');
        }


    }

    public function store()
    {

        if(count($this->events) == 0){
            $this->emit('alertFailed', 'لم تقم باختيار اي صنف');
            return false;
        }

        foreach ($this->events as $value) {

            $item = Item::where('id', $value['id'])->first();
            $unit = $item->units->first();
            $data['invoice_item']['item_name'] = $item->name;
            if ($this->invoice->type == 0) {
                foreach ($this->events as $key => $value) {
                    if (!InvoiceItem::where('invoice_id',$this->invoice->id)
                        ->where('item_id',$value['id'])
                        ->where('unit_id',$unit->id)
                        ->first()) {
                        InvoiceItem::create([
                            'item_id' => $value['id'],
                            'unit_id' => $unit->id,
                            'selling_price' => $unit->selling_price,
                            'quantity' => 1,
                            'invoice_id' => $this->invoice->id,
                            'item_name' => $value['name'],
                            'serial_number_id' => $unit->id,
                            'total_price_quantity' => 1 * $unit->selling_price,
                        ]);
                    }
                }
            }
            if ($this->invoice->type == 1) {

                if($unit) {
                    $unit->update([
                        'purchasing_price' => $unit->purchasing_price,
                    ]);
                }
                $OldPrice = $unit->purchasing_price;
                $OldQuantity = $item->qty;
                $newPrice = $unit->purchasing_price;
                $NewQuantity = 1 * $unit->pieces;
                $update_price = (($OldQuantity + $NewQuantity > 0) ? ($OldPrice * $OldQuantity + $newPrice * $NewQuantity) / ($OldQuantity + $NewQuantity) : 0);
                $unit->update(['purchasing_price' => $update_price]);
                $item->update(['qty' => $OldQuantity + (1 * $unit->pieces)]);
                $IfItemExist = InvoiceItem::where('invoice_id', $this->invoice->id)->where('item_name', $data['invoice_item']['item_name'])->where('unit_id', $value['id'])->first();
                $data['invoice_item']['invoice_update'] = $item->qty * $OldPrice;

                if ($IfItemExist) {
                    $data['invoice_item']['invoice_update'] = $item->qty * $OldPrice;
                    $data['invoice_item']['quantity'] = (1 * $unit->pieces) + $IfItemExist->quantity;
                    $IfItemExist->update($data['invoice_item']);
                } else {
                    foreach ($this->events as $key => $value) {
                        if (!InvoiceItem::where('invoice_id',$this->invoice->id)
                            ->where('item_id',$value['id'])
                            ->where('unit_id',$value['id'])
                            ->first()) {
                            InvoiceItem::create([
                                'item_id' => $value['id'],
                                'unit_id' => $value['id'] ?? '',
                                'purchasing_price' => $unit->purchasing_price,
                                'quantity' => 1,
                                'invoice_id' => $this->invoice->id,
                                'item_name' => $value['name'],
                                'serial_number_id' => $value['id'],
                                'total_price_quantity' => 1 * $unit->selling_price,
                            ]);
                        }
                    }
                }
            }
        }

        $this->emit('refreshInvoiceItemsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function SelectedSerial()
    {

        foreach ($this->selectedserialoption as $key => $selectedserialoption) {
            $this->serialresult = $this->selectedserialoption[$key];

        }

    }

    public function render()
    {
        $items = Item::query();
        if ($this->search) {
            $items = $items->where(function ($q) {
                return $q->where('name', 'LIKE', "%$this->search%");
            });
            $items = $items->OrWhereHas('SerialNumbers', function ($q) {
                return $q->where('serial', 'LIKE', "%$this->search%");
            });
        }
        $this->items = $items->get();

        return view('livewire.invoice-items.invoice-item-create');
    }

    public function InvoiceSelectedUnit($units)
    {
        $delete = false;
        foreach ($this->events as $key => $event){
            if($event['id'] == $units['id'] ){
                unset($value);
                $delete = true;
            }
        }

        if(!$delete) {
            $this->events[] = $units;
        }

    }


}
  