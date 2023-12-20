<?php

namespace App\Http\Livewire\Expenses;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\ArrestReceipt;
use Illuminate\Support\Facades\Hash;


class ExpenseDelete extends Component
{
    public $expense = [];

    public function mount($arrest_receipt_id)
    {
        $this->expense = ArrestReceipt::find($arrest_receipt_id);

    }

    public function delete()
    {

        $expense = ArrestReceipt::find($this->expense['id']);
        $expense->delete();

        $this->emit('refreshExpensesList');
        $this->dispatchBrowserEvent('close-modal');


    }


    public function render()
    {
        return view('livewire.expenses.expense-delete');
    }
}
