<?php

namespace App\Http\Livewire\PayrollItems;

use App\Models\PayrollItem;
use App\Models\Payroll;
use App\Models\User;
use Livewire\Component;

class PayrollItemEdit extends Component
{
    public $payroll_item;
    public $payroll;
    public $salary;
    public $payroll_item_id, $userid, $salaryes;


    public function mount($payroll_item_id)
    {
        $this->payroll_item_id = $payroll_item_id;
        $this->payroll = Payroll::find($payroll_item_id);
        $this->payroll = $this->payroll->toArray();

        $this->payroll_item = PayrollItem::where('payroll_id', $this->payroll['id'])->get();
        $this->payroll_item = $this->payroll_item->toArray();


    }

    public function update()
    {
        foreach ($this->payroll_item as $index => $payroll) {

            $payroll_update = PayrollItem::find($this->payroll_item[$index]['id']);
            $payroll_update->advance = $this->payroll_item[$index]['advance'];
            $payroll_update->paying_off = $this->payroll_item[$index]['paying_off'];

            $payroll_update->update();

        }


        $this->emit('refreshPayrollsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        foreach ($this->payroll_item as $index => $payroll) {
            $user = User::where('id', $this->payroll_item[$index]['user_id'])->first();
            $this->salary = $user->salary;
            // $basePayrollItem=PayrollItem::where('payroll_id',$this->payroll['id'])->get();
            // dd($basePayrollItem);
            if ($user) {
                // $payrolladvance = PayrollItem::where('user_id',$user->id)->first();
                // if($payrolladvance){
                //     foreach($payrolladvance as $payrolladvances){
                //     $this->payroll_item[$index]['advance']+=$payrolladvances->advance;
                // }
                // }
            }
            $this->payroll_item[$index]['paying_off'] = $this->salary - $this->payroll_item[$index]['advance'];

        }


        return view('livewire.payrolls.payroll-edit', [
            'users' => User::whereHas("roles", function ($q) {
                $q->where("name", "Employee");
            })->get(),
            'payrollitems' => PayrollItem::where('payroll_id', $this->payroll['id'])->get(),

        ]);
    }
}
