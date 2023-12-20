<?php

namespace App\Http\Livewire\Items;


use App\Models\Item;
use App\Models\Unit;
use Livewire\Component;
use App\Models\Category;
use App\Models\UnitItem;
use App\Models\SerialNumber;
use Faker\Factory;

class ItemSerial extends Component
{
    public $serial = [];

    // public $serial;
    public $unit_id;

    public function mount($unit_id)
    {
        $this->unit_id = $unit_id;
    }

    public function store()
    {
        dd($this->serial);
        $data = $this->validate([
            'serial.serial' => 'required',
            'serial.unit_id' => 'required',


        ]);
        $data['serial']['title'] = "uuu";
        $data['serial']['status'] = "1";
        $data['serial']['unit_id'] = $this->$unit_id;
        $unit = SerialNumber::create($data['serial']);
        $this->emit('refreshItemsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.items.item-serial');
    }
}