<?php

namespace App\Http\Livewire\Payrolls;

use App\Models\Payroll;
use App\Models\User;
use Livewire\Component;

class PayrollCreate extends Component
{

    public function store()
    {
        $data = $this->validate([
            'payroll.user_id' => 'required',
            'payroll.advance' => 'nullable',
            'payroll.description' => 'required',

        ]);

        $payroll = Payroll::create($data['payroll']);

        $this->emit('refreshPayrollsList');
        $this->emit('refreshUsersList');
        $this->emit('refreshUserShow');
        $this->dispatchBrowserEvent('close-modal');
        $this->payroll = [];


    }

    public function render()
    {

        return view('livewire.payrolls.payroll-create', [
            'users' => User::whereHas("roles", function ($q) {
                $q->where("name", "Employee");
            })->get()
        ]);
    }
}
