<?php

namespace App\Http\Livewire\Revenues;

use App\Models\Limitation;
use App\Models\ArrestReceipt;
use App\Models\User;
use App\Models\IndexAccount;
use Livewire\Component;
use Livewire\WithFileUploads;

class RevenueCreate extends Component
{
    use WithFileUploads;

    public $revenue, $typeselect, $userSelect, $userSelectaccount, $usernaem, $usernaemsup, $useraccount;

    public function store()
    {
        // dd("dd");
        $data = $this->validate([

            'revenue.batch_quantity' => 'required|numeric',
            'revenue.description' => 'nullable',
            'revenue.type' => 'nullable',
            'revenue.user_id' => 'nullable',
            'revenue.index_account_id' => 'nullable',
            'revenue.date' => 'required',

        ]);
        $data['revenue']['user_id'] = $this->userSelect;
        $data['revenue']['index_account_id'] = $this->userSelectaccount;

        $data['revenue']['type'] = "4";
        $revenue = ArrestReceipt::create($data['revenue']);
        Limitation::create([
            'arrest_receipt_id' => $revenue->id
        ]);
        session()->flash('msg', 'تم الاضافه بنجاح');
        $this->emit('refreshRevenuesList');
        $this->dispatchBrowserEvent('close-modal');
        $this->revenue = [];
    }

    public function selectUser($user_id)
    {


        $this->userSelect = $user_id;
        $this->user = User::find($this->userSelect);
        $this->usernaemsup = $this->user->name;

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
            $q->where("name", 'Customer');
        })->get();
        return view('livewire.revenues.revenue-create', [
            'users' => $user,
            'indexaccount' => $indexaccount
        ]);
    }
}
