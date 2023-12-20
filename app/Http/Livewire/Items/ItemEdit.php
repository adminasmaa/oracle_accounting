<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use App\Models\Unit;
use Livewire\Component;
use App\Models\Category;
use App\Models\UnitItem;
use App\Models\Attachment;
use App\Models\SerialNumber;
use App\Models\InvoiceItem;
use App\Models\Manufacturing;
use Livewire\WithFileUploads;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemEdit extends Component
{
    use WithFileUploads;

    public $ottPlatform = '';
    public $webseries = [
        'Wanda Vision',
        'Money Heist',
        'Lucifer',
        'Stranger Things'
    ];
    public $item;
    public $unitsele = [[]];
    public $firstunit;
    public $id_one, $id_two, $id_three;
    public $firstunits = [];
    public $secoundunits = [];
    public $thirdunits = [];
    public $serial_number = [];
    public $serial_numbertwo = [];
    public $serial_numberthree = [];
    public $secoundunit;
    public $thirdunit;
    public $firstpieces;
    public $secoundpieces;
    public $thirdpieces;
    public $i = 0;
    public $len;
    public $serialNumbers = [];
    public $serialNumbersUpdate = [];
    public $serialNumbers3 = [];
    public $unit = [];
    public $unit2 = [];
    public $unit3 = [];
    public $manuf = 0;
    // public $manufacturingnumber = [];
    public $code = [], $quantity, $price, $total_price, $inovceite = [['code' => "", 'quantity' => "", 'price' => "", 'totalPrice' => ""]], $quantitykeymanu, $totalPrice, $purchasinkeymanu, $inovceiteprice = [], $key;
    public $n, $unitname, $multisearials;
    public $unit_item;
    public $unit_searial = array();
    public $Manufacturings = array();
    public $ManufacturingsIDS = array();
    // public $serialNumbers[1] = array();

    // public $serial=[];

    public function mount($item_id)
    {
        $item = Item::find($item_id);

        $this->item = $item;

        $this->serialNumbers = $this->item->serial_numbers;

        foreach ($this->item->serial_numbers as $serial) {
            $this->serialNumbersUpdate[$serial->id] = $serial->serial;
        }

        $this->unitsele = $this->item->units;
        if ($this->unitsele) {
            $this->len = count($this->unitsele);
            $i = 3-$this->len;
            for($i;$i>0;$i--){
                $item->units()->create(['item_id' => 0]);
            }
        }


        foreach ($item->units as $unit){
            if(SerialNumber::where('item_id',$item->id)->where('unit_id',$unit->id)->count() < 1) {
                SerialNumber::create([
                    'title' => 'وحدة رقم '. $unit->id, 'serial' => "serial".$unit->id, 'item_id' => $item->id, 'status' => 1, 'unit_id' => $unit->id
                ]);
            }
        }

        $this->unit_searial = Unit::with('serialnumbers')->where('item_id', $item_id)->get();

        $this->unit[1] = [];
        foreach ($this->item->units as $key => $unit) {
            $this->unit[$unit->id] = $unit;
        }

        $this->item = $this->item->toArray();

        $Manufacturings = Manufacturing::where('parent_id', $this->item['id'])->get();
        $this->Manufacturings = [];
        $this->ManufacturingsIDS = [];
        foreach ($Manufacturings as $Manufacturing){
            $this->ManufacturingsIDS[] = $Manufacturing->id;
            $this->Manufacturings[] = $Manufacturing->toArray();
        }

        $this->serialNumbers = SerialNumber::where('item_id',$item->id)->get();
     }

    public function addSerialnumber($unit)
    {
        $serial = new SerialNumber();
        $serial->unit_id = $unit;
        $serial->item_id = $this->item['id'];
        $serial->save();
        $this->item = Item::find($this->item['id']);
        $this->serialNumbers = $this->item->serial_numbers;
        foreach ($this->item->serial_numbers as $serial) {
            $this->serialNumbersUpdate[$serial->id] = $serial->serial;
        }
    }

    public function removeSerialnumber($serial)
    {
        SerialNumber::where('id', $serial)->delete();
        $this->item = Item::find($this->item['id']);
        $this->serialNumbers = $this->item->serial_numbers;
        foreach ($this->item->serial_numbers as $serial) {
            $this->serialNumbersUpdate[$serial->id] = $serial->serial;
        }
    }

    public function updateSerial($id)
    {
        $serial = SerialNumber::where('id', $id)->first();
        $serial->serial = !empty($this->serialNumbersUpdate[$serial->id]) ? $this->serialNumbersUpdate[$serial->id] : null;
        $serial->save();
    }

    public function addManufacturingNumber()
    {
        Manufacturing::create([
            'parent_id' => $this->item['id'],
            'item_id' => 0,
            'quantity' => 0,
            'price' => 0,
            'total_price' => 0
        ]);

        $Manufacturings = Manufacturing::where('parent_id', $this->item['id'])->get();

        $this->Manufacturings = [];
        $this->ManufacturingsIDS = [];
        foreach ($Manufacturings as $Manufacturing){
            $this->ManufacturingsIDS[] = $Manufacturing->id;
            $this->Manufacturings[] = $Manufacturing->toArray();
        }

    }

    public function removeManufacturingnumber($id)
    {
        Manufacturing::where('parent_id', $this->item['id'])->where('id', $id)->delete();
        $Manufacturings = Manufacturing::where('parent_id', $this->item['id'])->get();

        $this->Manufacturings = [];
        $this->ManufacturingsIDS = [];
        foreach ($Manufacturings as $Manufacturing){
            $this->ManufacturingsIDS[] = $Manufacturing->id;
            $this->Manufacturings[] = $Manufacturing->toArray();
        }
    }

    private function resetInputFields()
    {
        $this->serialNumbers = '';
        $this->unit = '';
    }

    private function resetInputFieldmanuf()
    {
        $this->code = '';
        $this->quantity = '';
        $this->total_price = '';

    }

    public function like()
    {
        $this->multisearials = 1;
    }

    public function update($id_one = null, $id_two = null, $id_three = null)
    {
        $fake = Factory::create();

        $unitone = $this->validate(['firstunits.name' => 'nullable', 'firstunits.pieces' => 'nullable', 'firstunits.purchasing_price' => 'nullable', 'firstunits.selling_price' => 'nullable', 'firstunits.check' => 'nullable']);

        $this->firstunits ? Unit::where('id', $id_one)->update($unitone['firstunits']) : null;

        $unittwo = $this->validate(['secoundunits.name' => 'nullable', 'secoundunits.pieces' => 'nullable', 'secoundunits.purchasing_price' => 'nullable', 'secoundunits.selling_price' => 'nullable']);
        $this->secoundunits ? Unit::where('id', $id_two)->update($unittwo['secoundunits']) : null;

        $unitthree = $this->validate(['thirdunits.name' => 'nullable', 'thirdunits.pieces' => 'nullable', 'thirdunits.purchasing_price' => 'nullable', 'thirdunits.selling_price' => 'nullable']);
        $this->thirdunits ? Unit::where('id', $id_three)->update($unitthree['thirdunits']) : null;

        $data = $this->validate([
            'item.name' => 'required',
            'item.path' => 'nullable|image|mimes:jpg,png',
            'item.item_number' => 'nullable',
            'item.serial_number' => 'nullable',
            'item.place' => 'nullable|string',
            'item.category_id' => 'nullable|int|exists:categories,id',
            'item.serial_multi' => 'required',
        ]);
        if (empty($data['item']['path']) || $data['item']['path'] == "") {
            if (!empty($data['item']['path'])) {
                unset($data['item']['path']);
            }
        }


        $item_update = Item::find($this->item['id']);
        $item_update->update($data['item']);


        if (!empty($this->item['path'])) {
            $file = $this->item['path']->store('attachments', 'public');
            Attachment::create([
                'path' => $file,
                'item_id' => $this->item['id'],
            ]);
        }

        foreach ($this->unit as $key => $unit) {
            if (!empty($unit['id'])) {
                $unite = Unit::find($unit['id']);
                $unite->name = $unit['name'];
                $unite->pieces = $unit['pieces'];
                $unite->selling_price = $unit['selling_price'];
                $unite->purchasing_price = $unit['purchasing_price'];
                $unite->save();
            }
        }

        foreach ($this->Manufacturings as $Manufacturing) {
            unset($Manufacturing['created_at']);
            unset($Manufacturing['updated_at']);
            if(!empty($Manufacturing['id'])) {
                $ManufacturingO = Manufacturing::where('id', $Manufacturing['id'])->first();

                Manufacturing::where('id',$ManufacturingO->id)->update($Manufacturing);

            }
        }

        session()->flash('success', 'Updated Successfully');
        return $this->redirect(route('items'));
    }

    public function ProjectEditOpenModal($item_id)
    {
        $item_select = Item::find($item_id);
        if ($item_select) {
            $this->dispatchBrowserEvent('updateSelect2');
        } else {
            abort(403);
        }
    }

    public function render()
    {
        $this->dispatchBrowserEvent('SelectEditProjectUsers-' . $this->item['id']);
        return view('livewire.items.item-edit', [
            'categories' => Category::all(),
            'unititems' => Unit::all(),
            'invoiceite' => InvoiceItem::where('item_id', $this->code)->first(),
            'totalprice' => $this->quantity,
            'multisearials' => $this->multisearials
        ]);
    }
}