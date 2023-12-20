<?php

namespace App\Http\Livewire\Payrolls;

use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\PayrollItem;
use App\Models\ArrestReceipt;
use App\Models\Limitation;
use Session;

class PayrollShow extends Component
{
    public $employees = [];
    public $salary = [];
    public $item = [];
    public $payroll_items = [];
    public $payroll = [], $name_payroll, $id_payroll;
    public $total_advance = 0;
    public $user_select;
    public $user_account;

    protected $listeners = [
        'refreshPayrollShow' => 'ActionRefreshPayrollShow'
    ];

    public function ActionRefreshPayrollShow()
    {

    }

    public function mount($payroll_id = null)
    {

        $payroll = Payroll::find($payroll_id);

        if($payroll) {
            $this->payroll = $payroll->toArray();
        }

        $this->payroll['date'] = !empty($this->payroll['date']) ? $this->payroll['date'] :Carbon::today()->format("Y-m-d");

        if($this->payroll){
            if($payroll and $payroll->payroll_items->count()>0) {
                foreach ($payroll->payroll_items as $payroll_item) {
                    $this->payroll_items[] = ['user_id' => $payroll_item->user_id, 'salary' => $payroll_item->user->salary, 'advance' => $payroll_item->advance, 'paying_off' => $payroll_item->paying_off];
                    $this->name_payroll[] = $payroll_item->user->name;
                }
            }else{
                $this->payroll_items[] = ['user_id' => 0, 'salary' => 0, 'advance' => 0, 'paying_off' => 0];
                $this->name_payroll[] = "";
            }
        }else {
            $this->payroll_items[] = ['user_id' => 0, 'salary' => 0, 'advance' => 0, 'paying_off' => 0];
            $this->name_payroll[] = "";
        }
    }

    public function AddEmployee()
    {
        $this->payroll_items[] = ['user_id' => 0, 'salary' => 0, 'advance' => 0 , 'paying_off' => 0];
        $this->name_payroll[] = "";

    }

    public function addpayrolls()
    {


        $validate = $this->validate([
            'payroll.date' => 'required',
            'payroll.description' => 'nullable',
        ]);


        $payroll = "";

        if(!empty($this->payroll['id'])) {
            $payroll = Payroll::find($this->payroll['id']);
        }

        if(!$payroll) {
            $payroll = Payroll::create($validate['payroll']);
        }


        foreach ($this->payroll_items as $key => $payroll_item) {
            $user = User::where('id', $this->payroll_items[$key]['user_id'])->first();
            if($user) {

                $this->payroll_items[$key]['payroll_id'] = $payroll->id;
 
                PayrollItem::updateOrCreate(['payroll_id' => $this->payroll_items[$key]['payroll_id'],'user_id' => $this->payroll_items[$key]['user_id']],$this->payroll_items[$key]);

                Limitation::create([
                    'debit_amount' => $this->payroll_items[$key]['advance'] ?? '',
                    'credit_amount' => $this->payroll_items[$key]['paying_off'] ?? '',
                    'user_id' => $user->id,
                    'payroll_id' => $payroll->id,
                    'type' => "2",

                ]);
            }
        }

        $this->emit('refreshPayrollsList');
        $this->emit('refreshPayrollShow');
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('alertSuccess', 'Created Successfully');
        $this->redirect('/payrolls');
    }

    public function selectUser($key,$user_id)
    {

        $this->user_select[$key] = $user_id;
        $this->user_account[$key] = User::find($user_id);
        $this->name_payroll[$key] = $this->user_account[$key]->name;
        $this->payroll_items[$key]['user_id'] = $this->user_account[$key]->id;
        $this->payroll_items[$key]['salary'] = $this->user_account[$key]->salary;
        $this->id_payroll[$key] = $this->user_account[$key]->id;

        $this->emit('refreshPayrollsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {

        return view('livewire.payrolls.payroll-show', [
            'users' => User::whereHas("roles", function ($q) {
                $q->where("name", "Employee");
            })->get()
        ]);

    }
}
