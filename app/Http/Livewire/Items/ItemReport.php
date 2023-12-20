<?php

namespace App\Http\Livewire\Items;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ItemReport extends Component
{
    public $item;

    public function mount($item_id)
    {
        $this->item = Item::find($item_id);
    }

    public function render()
    {

        return view('livewire.items.item-report', [
            'item' => $this->item,
        ]);
    }
}
