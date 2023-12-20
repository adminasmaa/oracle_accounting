<?php

namespace App\Http\Livewire\PayrollItems;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\PayrollItem;
use Illuminate\Support\Facades\Hash;


class PayrollItemDelete extends Component
{
    public $payroll = [];

    public function mount($payroll_id)
    {
        $this->payroll = PayrollItem::find($payroll_id);
        $this->emit('refreshPayrollItemShow');
        $this->dispatchBrowserEvent('close-modal');

    }

    public function delete()
    {

        $payroll = PayrollItem::find($this->payroll['id']);
        $payroll->delete();

        $this->emit('refreshPayrollItemShow');
        $this->dispatchBrowserEvent('close-modal');

    }


    public function render()
    {
        return view('livewire.payroll-items.payroll-item-delete');
    }
}
