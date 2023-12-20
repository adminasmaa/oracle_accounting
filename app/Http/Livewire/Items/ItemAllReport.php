<?php

namespace App\Http\Livewire\Items;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ItemAllReport extends Component
{
    public $item;

    public function render()
    {
        $invoice = Invoice::get();

        $this->item = Item::get();
        return view('livewire.items.item-all-report', [
            'item' => $this->item,
            'invoice' => $invoice,

        ]);
    }
}
