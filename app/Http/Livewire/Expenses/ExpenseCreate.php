<?php

namespace App\Http\Livewire\Expenses;

use App\Models\Limitation;
use App\Models\ArrestReceipt;
use App\Models\User;
use App\Models\IndexAccount;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseCreate extends Component
{
    use WithFileUploads;

    public $expense, $typeselect, $userSelect, $userSelectaccount, $usernaem, $usernaemsup, $useraccount;

    public function store()
    {
        $data = $this->validate([

            'expense.batch_quantity' => 'required|numeric',
            'expense.description' => 'nullable',
            'expense.type' => 'nullable',
            'expense.user_id' => 'nullable',
            'expense.index_account_id' => 'nullable',
            'expense.date' => 'required',
        ]);
        $data['expense']['user_id'] = $this->userSelect;
        $data['expense']['index_account_id'] = $this->userSelectaccount;

        $data['expense']['type'] = "3";
        $expense = ArrestReceipt::create($data['expense']);
        Limitation::create([
            'arrest_receipt_id' => $expense->id
        ]);
        session()->flash('msg', 's:تم الاضافه بنجاح');
        $this->emit('refreshExpensesList');
        $this->dispatchBrowserEvent('close-modal');
        $this->expense = [];
    }

    public function selectUser($user_id)
    {


        // if($this->typeselect == "Supplier"){
        $this->userSelect = $user_id;
        $this->user = User::find($this->userSelect);
        $this->usernaemsup = $this->user->name;
        // }else{
        $this->userSelectaccount = $user_id;
        $this->useraccount = IndexAccount::find($this->userSelectaccount);
        // $this->usernaem = $this->useraccount->account_name;
        // }
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function selectAccount($user_id)
    {
        $this->userSelectaccount = $user_id;
        $this->useraccount = IndexAccount::find($this->userSelectaccount);
        $this->usernaem = $this->useraccount->account_name;
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $indexaccount = IndexAccount::get();
        $user = User::whereHas("roles", function ($q) {
            $q->where("name", 'Supplier');
        })->get();
        return view('livewire.expenses.expense-create', [
            'users' => $user,
            'indexaccount' => $indexaccount
        ]);
    }
}
