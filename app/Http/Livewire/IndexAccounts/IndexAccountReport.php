<?php

namespace App\Http\Livewire\IndexAccounts;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\IndexAccount;
use App\Models\ArrestReceipt;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class IndexAccountReport extends Component
{
    public $index_account;
    public $index_account_id;


    public function mount($index_account_id)
    {
        $this->index_account_id = $index_account_id;
        $settings = Setting::first();
        $settings->payment_selling_account_index_id = $index_account_id;
        $this->index_account = IndexAccount::find($index_account_id);
        $this->index_account = $this->index_account->toArray();
    }

    public function render()
    {
        $settings = Setting::first();
        // $invoice=Invoice::first();

        if ($settings->payment_selling_account_index_id == $this->index_account_id) {
            $invoice = Invoice::where('type', 0)->get();
            $invoiceuser = '';

        } elseif ($settings->payment_parchasing_account_index_id == $this->index_account_id) {
            $invoice = Invoice::where('type', 1)->get();
            $invoiceuser = '';

        } elseif ($settings->discount_earned_account_index_id == $this->index_account_id) {
            $invoice = Invoice::where('type', 1)->with('invoice_discounts')->get();
            $invoiceuser = '';

        } elseif ($settings->allowed_discount_account_index_id == $this->index_account_id) {
            $invoice = Invoice::where('type', 0)->with('arrest_receipts')->get();
            $invoiceuser = '';

        } elseif ($settings->inbox_account_index_id == $this->index_account_id) {
            $invoice = Invoice::with('arrest_receipts')->get();
            $invoiceuser = '';

        } elseif ($settings->salary_account_index_id == $this->index_account_id) {
            $invoice = User::whereHas("roles", function ($q) {
                $q->where("name", 'Employee');
            })->get();
            $invoiceuser = '';
            // foreach($user as $user1){
            //     $invoice=ArrestReceipt::where('user_id',$user1->id)->get();
            // }
        } elseif ($settings->customers_account_index_id == $this->index_account_id) {
            $invoiceuser = User::whereHas("roles", function ($q) {
                $q->where("name", 'Customer');
            })->get();
            $invoice = '';

        } else {
            $invoice = Invoice::with('arrest_receipts')->where('index_account_id', $this->index_account_id)->get();
            $invoiceuser = '';
            // $invoice="";
        }

        return view('livewire.index-accounts.index-account-report', [
            'invoice' => $invoice,
            'invoiceuser' => $invoiceuser

        ]);
    }
}
