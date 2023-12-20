<?php

namespace App\Http\Livewire\IndexAccounts;

use App\Models\AccountGuide;
use App\Models\IndexAccount;
use App\Models\Invoice;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ArrestReceipt;

class IndexAccounts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search, $index_account_id, $account_guide_id, $basic;

    protected $listeners = [
        'refreshIndexAccountsList' => 'ActionRefreshIndexAccountsList'
    ];

    function ActionRefreshIndexAccountsList()
    {

    }

    public function mount()
    {
        $settings = Setting::first();
        // dd($settings);
        if ($settings) {
            $invoice_sub_total = 0;
            $invoices = Invoice::where('type', 0)->orwhere('type', 2)->get();
            foreach ($invoices as $invoice) {
                $invoice_sub_total = $invoice_sub_total + $invoice->sub_total;
            }
            $invoice_sub_total_dis = 0;
            $invoices_dis = Invoice::where('type', 1)->orwhere('type', 3)->get();
            foreach ($invoices_dis as $invoices_diss) {
                $invoice_sub_total_dis = $invoice_sub_total_dis + $invoices_diss->sub_total;
            }
            $settings = Setting::first();
            $settings->inbox_account_index->balance = $invoice_sub_total - $invoice_sub_total_dis;
            $indexaccount = IndexAccount::where('id', $settings->inbox_account_index_id);
            $indexaccount->update([
                'balance' => $settings->inbox_account_index->balance,
            ]);
        } else {
            if (request('search')) {
                $this->search = request('search');
            }

            if (request('index_account_id')) {
                $this->index_account_id = request('index_account_id');
            }

            if (array_key_exists(request('basic'), IndexAccount::basicList(false))) {
                $this->basic = request('basic');
            }

            if (request('account_guide_id')) {
                $this->account_guide_id = request('account_guide_id');
            }
        }
    }

    public function render()
    {
        $index_accounts = IndexAccount::query();
        if ($this->search) {
            $index_accounts = $index_accounts->where(function ($q) {
                return $q->where('account_number', 'LIKE', "%$this->search%")
                    ->orWhere('account_name', 'LIKE', "%$this->search%");
            });
        }

        if ($this->index_account_id) {
            $index_accounts = $index_accounts->where('index_account_id', $this->index_account_id);
        }

        if (array_key_exists($this->basic, IndexAccount::basicList(false))) {
            $index_accounts = $index_accounts->where('basic', $this->basic);
        }

        if ($this->account_guide_id) {
            $index_accounts = $index_accounts->where('account_guide_id', $this->account_guide_id);
        }

        $index_accounts = $index_accounts->orderBy('account_number', 'DESC')->get();
        $arrestreceipt = ArrestReceipt::get();

        foreach ($index_accounts as $indexaccountbalance) {

            $arrestreceiptsexpensesbatch_quantity = 0;
            foreach ($arrestreceipt->where('index_account_id', $indexaccountbalance->id)->where('type', 3) as $arrestreceiptexpensesbatch_quantity) {
                $arrestreceiptsexpensesbatch_quantity = $arrestreceiptsexpensesbatch_quantity + $arrestreceiptexpensesbatch_quantity->batch_quantity;
            }
            $arrestreceiptsrevenuesbatch_quantity = 0;
            foreach ($arrestreceipt->where('index_account_id', $indexaccountbalance->id)->where('type', 4) as $arrestreceiptrevenuesbatch_quantity) {
                $arrestreceiptsrevenuesbatch_quantity = $arrestreceiptsrevenuesbatch_quantity + $arrestreceiptrevenuesbatch_quantity->batch_quantity;
            }

            foreach ($arrestreceipt->where('index_account_id', $indexaccountbalance->id) as $arrestreceipts) {
                // $this->account= -$indexaccountbalance->salary + $arrestreceipts->advance;
                $indexaccount = IndexAccount::find($indexaccountbalance->id);
                $indexaccount->balance = $arrestreceiptsexpensesbatch_quantity - $arrestreceiptsrevenuesbatch_quantity;
                $indexaccount->update();
            }
        }
         return view('livewire.index-accounts.index-accounts', [
            'index_accounts' => $index_accounts,
            'index_accounts_filter' => IndexAccount::all(),
            'account_guides' => AccountGuide::all(),
            'invoices_all' => Invoice::all(),
        ]);
    }

    public function viewindexaccountreport($index_account_id)
    {
        return redirect()->route('report.viewindexaccountreport', $index_account_id);

    }
}
