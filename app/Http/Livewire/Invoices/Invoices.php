<?php

namespace App\Http\Livewire\Invoices;

use App\Models\IndexAccount;
use App\Models\Invoice;
use App\Models\User;
use App\Models\SerialNumber;
use App\Models\Unit;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;


class Invoices extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search, $from, $to, $user_id, $index_account_id, $status, $type;


    protected $listeners = [
        'refreshInvoicesList' => 'ActionRefreshInvoicesList'
    ];

    function ActionRefreshInvoicesList()
    {

    }

    public function mount()
    {
        if (request('role_id')) {
            $this->role_id = request('role_id') ? request('role_id') : 3;
        } else {
            $this->role_id = 3;
        }

        if (request('search')) {
            $this->search = request('search');
        }

        if (request('user_id')) {
            $this->user_id = request('user_id');
        }

        if (request('index_account_id')) {
            $this->index_account_id = request('index_account_id');
        }

        if (array_key_exists(request('status'), Invoice::statusList(false))) {
            $this->status = request('status');
        }

        if (array_key_exists(request('type'), Invoice::typeList(false))) {
            $this->type = request('type');
        } else {
            $this->type = 0;
        }

//        $this->from = date('2022-01-01');
//        $this->from = date('Y-m-d');
//        $this->to = date('Y-m-d');

//        $this->from = date('Y-m-d', strtotime($this->from));
//        $this->to = date('Y-m-d', strtotime($this->to) + (24 * 60 * 60));
//
        if (request('from')) {
            $this->from = request('from');
        }

        if (request('to')) {
            $this->to = request('to');
        }

    }

    public function render()
    {

        $invoices = Invoice::query();
//        $invoices = $invoices->where('type', $this->type);
//        $invoices = $invoices->paginate(10);

//        $invoices = Invoice::all();

        if (auth()->user()->hasRole('Admin')) {
            $invoices = $invoices;
        } else {
            $invoices = Invoice::where('user_id', auth()->id());
        }

        if ($this->search) {
            $invoices = $invoices->where(function ($q) {
                return $q->where('invoice_number', 'LIKE', "%$this->search%")->orWhere('description', 'LIKE', "%$this->search%");
            });
        }

        if (array_key_exists($this->status, Invoice::statusList(false))) {
            $invoices = $invoices->where('status', $this->status);
        }

        if (array_key_exists($this->type, Invoice::typeList(false))) {

//            dd(Invoice::query());
            $invoices = $invoices->where('type', $this->type);
//            $invoices = Invoice::latest()->where('type', $this->type);

//            return $invoices->simplePaginate(10);

//            dd(Invoice::where('type', $this->type));

        }

        if ($this->user_id) {
            $invoices = $invoices->where('user_id', $this->user_id);
        }

        if ($this->index_account_id) {
            $invoices = $invoices->where('index_account_id', $this->index_account_id);
        }

        if ($this->from && $this->to !== null) {

//            dd($this->from);
            $invoices = $invoices->whereBetween('invoice_date', array_map('strval', [$this->from, $this->to]));

        }
        // $users = User::get();
        $userssup = User::whereHas("roles", function ($q) {
            $q->where("name", "Supplier");
        })->get();
        $userscust = User::whereHas("roles", function ($q) {
            $q->where("name", "Customer");
        })->get();

//        $invoices = Invoice::latest()->where('type', $this->type)->paginate(10);
//        dd($invoices);

        $invoices = $invoices->paginate(10);


        return view('livewire.invoices.invoices', [
            'invoices' => $invoices,
            'userscust' => $userscust,
            'userssup' => $userssup,
            'index_accounts' => IndexAccount::all(),
        ]);

    }


    public function addinvoice($type)
    {
        $invoice_num = Invoice::where('type', $type)->max('id') + 1;
        $invoice = Invoice::create([
            'invoice_number' => $invoice_num + 1,
            'user_id' => 0,
            'is_active' => 0,
            'type' => $type,

        ]);
        if ($invoice) {
            return redirect()->route('invoices.show', ['invoice_id' => $invoice->id]);
        }
    }

    public function invoicereports()
    {
        return redirect()->route('invoicesreport');
    }

}
