<?php

namespace App\Http\Livewire\ArrestReceipts;

use App\Models\Setting;
use App\Models\User;
use Livewire\Component;
use App\Models\ArrestReceipt;
use App\Models\IndexAccount;

class ArrestReceiptShow extends Component
{
    public $arrest_receipt, $index_account, $accounts = [], $index_account_id, $setting;
    public $batch_quantity, $client = "Customer", $date, $advance;
    public $user, $userAccount;
    public $userSelect, $typeReceipt, $arrestReceiptType;
    protected $listeners = [
        'refreshArrestReceiptShow' => 'ActionRefreshArrestReceiptShow'
    ];

    public function ActionRefreshArrestReceiptShow()
    {

    }

    public function mount($arrest_receipt_id)
    {
        $this->arrest_receipt = ArrestReceipt::where('id', $arrest_receipt_id)->first();
        $this->userSelect = ($this->arrest_receipt and $this->arrest_receipt->user) ? $this->arrest_receipt->user->id : 0;
        $this->user = User::find($this->userSelect);
        $this->arrest_receipt->user_id = $this->user ? $this->user->id : 0;
        $this->date = $this->arrest_receipt->date;
        $this->advance = $this->arrest_receipt->advance;

        $user_id = $this->arrest_receipt->user_id ? $this->arrest_receipt->user_id : 0;

        $this->userSelect = $user_id;
        $this->user = User::find($this->userSelect);
        if($this->user) {
            $this->client = $this->user->roles()->value('name');
        }else{
            $this->client = "اختر";
        }

        $this->setting = Setting::first();
        $this->setting = $this->setting->toArray();

        $index_account_id = $this->arrest_receipt->index_account_id ? $this->arrest_receipt->index_account_id : $this->setting['inbox_account_index_id'];

        $this->index_account = \App\Models\IndexAccount::where('id', $index_account_id)->first();

        $this->index_account_id = $this->index_account->id;
        $this->arrest_receipt->index_account_id = $this->index_account->id;
        $this->arrest_receipt->save();

        $this->accounts = IndexAccount::get();

    }

    public function selectUser($user_id)
    {
        $this->userSelect = $user_id;
        $this->user = User::find($this->userSelect);
        $this->arrest_receipt->user_id = $this->user->id;

        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function SaveUser($userSelect = null, $typeReceipt = null)
    {

        $data = $this->validate([
            'date' => 'required',
            'advance' => 'required',
            'client' => 'required',
        ]);

        $this->user = User::find($userSelect);
        $advanceArrest = ArrestReceipt::where('user_id', $this->user->id)->sum('advance');
        $reportUserArrest = ArrestReceipt::where('user_id', $this->user->id)->sum('reportuser');
        $this->userAccount = IndexAccount::find($userSelect);

        ArrestReceipt::where('id', $this->arrest_receipt->id)->update([
            'user_id' => $this->user->id,
            'date' => $this->date,
            'index_account_id' => $this->userAccount->id,
            'date' => $this->date,
            'advance' => (float)$this->advance,
            'type' => $this->arrest_receipt->type,
            'reportuser' => (float)$this->user->salary - ((float)$this->advance + (float)$advanceArrest),
            'balance' => ((float)$this->user->salary - ((float)$this->advance + $advanceArrest) + (float)$reportUserArrest) - ((float)$this->advance + (float)$advanceArrest),
        ]);
        $this->emit('alertSuccess', 'تم العملية على السند بنجاح');


        $this->redirect('/arrest-receipts?type=' . ($this->arrest_receipt->type ? $this->arrest_receipt->type : 0));

    }

    public function render()
    {

        $user = User::whereHas("roles", function ($q) {
            $q->where("name", $this->client);
        })->get();

        return view('livewire.arrest-receipts.arrest-receipt-show', [
            'users' => $user
        ]);
    }
}