<?php

namespace App\Http\Livewire\Revenues;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\ArrestReceipt;
use Illuminate\Support\Facades\Hash;


class RevenueDelete extends Component
{
    public $revenue = [];

    public function mount($arrest_receipt_id)
    {
        $this->revenue = ArrestReceipt::find($arrest_receipt_id);

    }

    public function delete()
    {

        $revenue = ArrestReceipt::find($this->revenue['id']);
        $revenue->delete();

        $this->emit('refreshRevenuesList');
        $this->dispatchBrowserEvent('close-modal');

    }


    public function render()
    {
        return view('livewire.revenues.revenue-delete');
    }
}
