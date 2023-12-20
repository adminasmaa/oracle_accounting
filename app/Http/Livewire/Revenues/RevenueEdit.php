<?php

namespace App\Http\Livewire\Revenues;

use App\Models\ArrestReceipt;
use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;

class RevenueEdit extends Component
{
    public $arrest_receipt;

    public function mount($arrest_receipt_id)
    {
        $this->arrest_receipt = ArrestReceipt::find($arrest_receipt_id);
        $this->arrest_receipt = $this->arrest_receipt->toArray();
        // dd( $this->arrest_receipt['description']);
    }

    public function update()
    {
        $data = $this->validate([

            'arrest_receipt.user_id' => 'nullable|int|exists:users,id',
            'arrest_receipt.batch_quantity' => 'nullable|numeric',
            'arrest_receipt.description' => 'nullable',

        ]);

        $arrest_receipt_update = ArrestReceipt::find($this->arrest_receipt['id']);
        $arrest_receipt_update->update($data['arrest_receipt']);

        $this->emit('refreshRevenuesList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.revenues.revenue-edit', [
            'invoices' => Invoice::all(),
            'users' => User::all()
        ]);
    }
}
