<?php

namespace App\Http\Livewire\SystemConstants;

use App\Models\Setting;
use App\Models\IndexAccount;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attachment;
use Livewire\WithFileUploads;


class SystemConstants extends Component
{
    use WithPagination;

    public $setting, $useraccount, $settings, $payment_selling_account, $payment_parchasing_account, $inbox_account_account, $salary_account, $customers_account,$suppliers_account, $discount_earned_account, $allowed_discount_account;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshSystemConstantsList' => 'ActionRefreshSystemConstantsList'
    ];

    function ActionRefreshSettingsList()
    {

    }

    public function mount()
    {
        $this->setting = Setting::first();
        $this->setting = $this->setting->toArray();
        $this->payment_selling_account = \App\Models\IndexAccount::where('id', $this->setting['payment_selling_account_index_id'])->first();
        $this->payment_parchasing_account = \App\Models\IndexAccount::where('id', $this->setting['payment_parchasing_account_index_id'])->first();
        $this->inbox_account_account = \App\Models\IndexAccount::where('id', $this->setting['inbox_account_index_id'])->first();
        $this->salary_account = \App\Models\IndexAccount::where('id', $this->setting['salary_account_index_id'])->first();
        $this->customers_account = \App\Models\IndexAccount::where('id', $this->setting['customers_account_index_id'])->first();
        $this->suppliers_account = \App\Models\IndexAccount::where('id', $this->setting['suppliers_account_index_id'])->first();
        $this->discount_earned_account = \App\Models\IndexAccount::where('id', $this->setting['discount_earned_account_index_id'])->first();
        $this->allowed_discount_account = \App\Models\IndexAccount::where('id', $this->setting['allowed_discount_account_index_id'])->first();

    }


    public function update()
    {
        $data = $this->validate([
            'setting.company_name' => 'required',
            'setting.company_phone' => 'nullable',
            'setting.company_email' => 'nullable|email',
            'setting.company_address' => 'nullable',
            'setting.company_manager' => 'nullable',
            'setting.company_description' => 'nullable',
            'setting.path' => 'nullable|image|mimes:jpg,png',
            'setting.payment_selling_account_index_id' => 'required',
            'setting.payment_parchasing_account_index_id' => 'required',
            'setting.inbox_account_index_id' => 'required',
            'setting.salary_account_index_id' => 'required',
            'setting.customers_account_index_id' => 'required',
            'setting.suppliers_account_index_id' => 'required',
            'setting.discount_earned_account_index_id' => 'required',
            'setting.allowed_discount_account_index_id' => 'required',
        ]);

        if (empty($data['setting']['path']) || $data['setting']['path'] == "") {
            if (!empty($data['setting']['path'])) {
                unset($data['setting']['path']);
            }
        }

        $setting_update = Setting::find($this->setting['id']);
        $setting_update->update($data['setting']);

        if (!empty($this->setting['path'])) {
            $file = $this->setting['path']->store('attachments', 'public');
            Attachment::create([
                'path' => $file,
                'setting_id' => $setting_update['id'],
            ]);
        }

        $this->emit('refreshSettingsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function selectAccount($user_id)
    {
        $this->userSelectaccount = $user_id;
        $this->setting['payment_selling_account_index_id'] = $user_id;
        $this->payment_selling_account = \App\Models\IndexAccount::where('id', $user_id)->first();
        $this->useraccount = IndexAccount::find($this->userSelectaccount);
        $this->usernaem = $this->useraccount->account_name;

        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }


    public function selectAccountparchasing($user_id)
    {
        $this->userSelectaccount = $user_id;
        $this->setting['payment_parchasing_account_index_id'] = $user_id;
        $this->payment_parchasing_account = \App\Models\IndexAccount::where('id', $user_id)->first();
        $this->useraccount = IndexAccount::find($this->userSelectaccount);
        $this->usernaem = $this->useraccount->account_name;
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function selectAccountindex($user_id)
    {
        $this->userSelectaccount = $user_id;
        $this->setting['inbox_account_index_id'] = $user_id;
        $this->inbox_account_account = \App\Models\IndexAccount::where('id', $user_id)->first();
        $this->useraccount = IndexAccount::find($this->userSelectaccount);
        $this->usernaem = $this->useraccount->account_name;
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function selectsalaryaccount($user_id)
    {
        $this->userSelectaccount = $user_id;
        $this->setting['salary_account_index_id'] = $user_id;
        $this->salary_account = \App\Models\IndexAccount::where('id', $user_id)->first();
        $this->useraccount = IndexAccount::find($this->userSelectaccount);
        $this->usernaem = $this->useraccount->account_name;
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function selectcustomersaccount($user_id)
    {
        $this->userSelectaccount = $user_id;
        $this->setting['customers_account_index_id'] = $user_id;
        $this->customers_account = \App\Models\IndexAccount::where('id', $user_id)->first();
        $this->useraccount = IndexAccount::find($this->userSelectaccount);
        $this->usernaem = $this->useraccount->account_name;
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function selectsuppliersaccount($user_id)
    {
        $this->userSelectaccount = $user_id;
        $this->setting['suppliers_account_index_id'] = $user_id;
        $this->suppliers_account = \App\Models\IndexAccount::where('id', $user_id)->first();
        $this->useraccount = IndexAccount::find($this->userSelectaccount);
        $this->usernaem = $this->useraccount->account_name;
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function selectdiscountearnedaccount($user_id)
    {
        $this->userSelectaccount = $user_id;
        $this->setting['discount_earned_account_index_id'] = $user_id;
        $this->discount_earned_account = \App\Models\IndexAccount::where('id', $user_id)->first();
        $this->useraccount = IndexAccount::find($this->userSelectaccount);
        $this->usernaem = $this->useraccount->account_name;
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function selectalloweddiscountaccount($user_id)
    {
        $this->userSelectaccount = $user_id;
        $this->setting['allowed_discount_account_index_id'] = $user_id;
        $this->allowed_discount_account = \App\Models\IndexAccount::where('id', $user_id)->first();
        $this->useraccount = IndexAccount::find($this->userSelectaccount);
        $this->usernaem = $this->useraccount->account_name;
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {

        return view('livewire.system-constants.system-constants', [
            'index_accounts' => IndexAccount::all(),
            'settings' => Setting::first(),

        ]);
    }
}
