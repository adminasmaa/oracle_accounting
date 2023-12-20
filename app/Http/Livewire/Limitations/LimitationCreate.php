<?php

namespace App\Http\Livewire\Limitations;

use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\IndexAccount;
use App\Models\Limitation;
use Session;

class LimitationCreate extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $date;
    public $description;
    public $key, $limidebit = 0, $limicredit = 0, $limitationAcount;
    public $typearrest, $limitation, $userSelectAcount, $userSelect, $debit_amount, $credit_amount, $limit = [], $Limitation = [['typearrest' => "", 'limitType' => "", 'debit_amount' => "", 'credit_amount' => "", 'user_id' => "", 'index_account_id' => "", 'selectuser' => ""]], $limitType = [], $limitTypekey;
    protected $listeners = [
        'refreshLimitationShowList' => 'ActionRefreshLimitationShowList'
    ];

    function ActionRefreshLimitationShowList()
    {

    }

    public function addLimitationnumber()
    {
        // for($i=0; $i<1; $i++){
        array_push($this->Limitation, ['typearrest' => "", 'limitType' => "", 'debit_amount' => "", 'credit_amount' => "", 'user_id' => "", 'index_account_id' => "", 'selectuser' => ""]);
        // }


    }

    public function removeLimitationnumber($limit)
    {
        unset($this->Limitation[$limit]);
    }

    // protected $rules = [
    //     'date' => 'required',
    //     // 'description' => 'required',
    // ];

    public function store(Request $request)
    {
        // $this->validate();
        $data = $this->validate([
            'limitation.date' => 'required',
            'limitation.description' => 'required',
            // 'limitation.debit_amount' => 'required_without:limitation.credit_amount',
            // 'limitation.credit_amount' => 'required_without:limitation.debit_amount',
        ]);

        foreach ($this->Limitation as $key => $value) {
            $manufac = Limitation::create([
                'date' => $this->limitation['date'],
                'description' => $this->limitation['description'] ? $this->limitation['description'] : null,
                'debit_amount' => $this->Limitation[$key]['debit_amount'],
                'credit_amount' => $this->Limitation[$key]['credit_amount'],
                'user_id' => $this->Limitation[$key]['id'] ? $this->Limitation[$key]['id'] : null,
                'index_account_id' => $this->Limitation[$key]['index_account_id']?$this->Limitation[$key]['index_account_id']:null,
                'type' => "1",
            ]);
            Session::flash("msg", "Created Successfully");


        }


    }

    public function codeSelected($key)
    {
        $this->key = $key;
        // dd($this->Limitation[$key]['typearrest']);
        $this->limitType = $this->Limitation[$key]['limitType'];
        $users = User::whereHas("roles", function ($q) {
            $q->where("name", $this->limitType);
        })->get();

        // dd($this->Limitation[$key]['typearrest']);
        if ($this->limitType == "acount") {
            $users = IndexAccount::get();
        } else {
            $users = User::whereHas("roles", function ($q) {
                $q->where("name", $this->limitType);
            })->get();
        }

        $this->Limitation[$key]['debit_amount'] = $this->Limitation[$key]['debit_amount'];
        $this->Limitation[$key]['credit_amount'] = $this->Limitation[$key]['credit_amount'];


    }


    public function selectUser($key, $user_id)
    {
        $this->Limitation[$key]['account_number'] = "12345";
        $this->Limitation[$key]['debit_amount'] = "12345";
        $this->Limitation[$key]['credit_amount'] = "12345";
        $this->Limitation[$key]['name'] = "12345";
        $this->Limitation[$key]['account_name'] = "12345";

        $this->limitType = $this->Limitation[$key]['limitType'];
        if ($this->Limitation[$key]['limitType'] == "acount") {
            $this->userSelectAcount = $user_id;
            $this->useraccount = IndexAccount::find($this->userSelectAcount);
            // dd($this->useraccount);
            $this->Limitation[$key]['index_account_id'] = $this->useraccount->id;
            $this->Limitation[$key]['account_number'] = $this->useraccount->account_number;
            // dd($this->Limitation[$key]['account_number']);
            $this->Limitation[$key]['account_name'] = $this->useraccount->account_name;
            // $this->limitationAcount=$this->limitType;
            // dd($this->limitationAcount);
            // $this->limitation = $this->useraccount->id;
        } else {
            $this->userSelect = $user_id;
            $this->useraccount = User::find($this->userSelect);
            $this->Limitation[$key]['user_id'] = $this->useraccount->id;
            $this->Limitation[$key]['id'] = $this->useraccount->id;
            $this->Limitation[$key]['name'] = $this->useraccount->name;

            // $this->limitation = $this->useraccount->id;
        }
        $this->emit('refreshArrestReceiptsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function debitSelected($key)
    {
        $this->limidebit += $this->Limitation[$key]['debit_amount'];
    }

    public function creditSelected($key)
    {

        $this->limicredit += $this->Limitation[$key]['credit_amount'];

    }


    public function render()
    {
        $this->debit_amount;

        // $this->limitTypekey;
        if ($this->limitType == "acount") {
            $users = IndexAccount::get();
        } else {
            $users = User::whereHas("roles", function ($q) {
                $q->where("name", $this->limitType);
            })->get();
        }
        // $users = User::get();
        // $indexaccount = IndexAccount::get();

        return view('livewire.limitations.limitation-create', [
            'users' => $users,
            // 'indexaccount' => $indexaccount
        ]);
    }
}
