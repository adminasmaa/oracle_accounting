<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\Setting;
use App\Models\User;
use App\Models\IndexAccount;
use Carbon\Carbon;
use Livewire\Component;


class InvoiceShow extends Component
{
    public $invoice,$setting;
    public $date, $description;
    public $user, $search, $client, $client2, $arrest_receipt, $userSelect, $useraccount, $users1, $accounts = [], $index_account, $index_account_id = 0;
    protected $listeners = [
        'refreshInvoiceShow' => 'ActionRefreshInvoiceShow'
    ];

    public function ActionRefreshInvoiceShow()
    {

    }

    public function mount($invoice_id)
    {

        $this->date = Carbon::today()->toDateString();
        if (auth()->user()->hasRole('Admin')) {
            $this->invoice = Invoice::where('id', $invoice_id)->firstOrFail();
        } else {
            $this->invoice = Invoice::where('id', $invoice_id)->where('user_id', auth()->id())->firstOrFail();
        }


        $user_id = $this->invoice->user_id ? $this->invoice->user_id : 0;

        $this->userSelect = $user_id;
        $this->user = User::find($this->userSelect);
        if($this->user) {
            $this->client = $this->user->roles()->value('name');
        }else{
            $this->client = "اختر";
        }
        $this->setting = Setting::first();
        $this->setting = $this->setting->toArray();

        $index_account_id = $this->invoice->index_account_id ? $this->invoice->index_account_id : $this->setting['inbox_account_index_id'];
        $this->index_account = \App\Models\IndexAccount::where('id', $index_account_id)->first();
        $this->index_account_id = $this->index_account->id;
        $this->invoice->index_account_id = $this->index_account->id;
        $this->invoice->save();

        $this->accounts = IndexAccount::get();
    }

    public function selectUser($user_id)
    {

        $this->userSelect = $user_id;
        $this->user = User::find($this->userSelect);
        $this->invoice->user_id = $this->user->id;
        $this->invoice->invoice_date = $this->date;
        $this->invoice->save();

        $this->emit('refreshInvoiceShow');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function selectAccount($account_id)
    {

        $this->index_account = IndexAccount::find($account_id);
        $this->invoice->index_account_id = $this->index_account->id;
        $this->invoice->invoice_date = $this->date;
        $this->invoice->save();

        $this->emit('refreshInvoiceShow');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateDescription()
    {
        $this->invoice->description = $this->description;
        $this->invoice->save();
    }

    public function render()
    {
        if ($this->client == "acount") {
            $user = IndexAccount::get();
        } else {

            $user = User::query();
            if ($this->search) {
                $user = User::where('name', 'LIKE', "%$this->search%")->whereHas("roles", function ($q) {
                    $q->where("name", $this->client);
                })->get();
            } else {
                $user = $user->whereHas("roles", function ($q) {
                    $q->where("name", $this->client);
                })->get();
            }
        }

        return view('livewire.invoices.invoice-show', [
            'users' => $user,
        ]);
    }

}
