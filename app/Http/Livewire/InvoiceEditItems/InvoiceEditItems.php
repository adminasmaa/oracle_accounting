<?php

namespace App\Http\Livewire\InvoiceEditItems;

use App\Models\Item;
use App\Models\Unit;
use Livewire\Component;
use App\Models\InvoiceItem;
use Livewire\WithPagination;
use App\Models\InvoiceDiscount;


class InvoiceEditItems extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $invoice;
    public $discount;
    public $sumdesc;
    public $event = [];

    protected $listeners = [
        'refreshInvoiceEditItemsList' => 'ActionRefreshInvoiceEditItemsList'
    ];

    function ActionRefreshInvoiceEditItemsList()
    {

    }

    public function render()
    {

        $item = Item::get();

        return view('livewire.invoice-edit-items.invoice-edit-items', [
            'items' => $item,
            'array' => $this->event,

        ]);
    }

    public function selectUnit($event)
    {

        foreach ($this->event as $key => $value) {
            $this->event = $value;
        }
        $this->emit('refreshInvoiceEditItemsList');
        $this->dispatchBrowserEvent('close-modal');

        return view('livewire.invoice-items.invoice-items', [
            'event' => $this->event,
        ]);


    }


}
