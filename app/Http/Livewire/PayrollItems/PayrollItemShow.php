<?php

namespace App\Http\Livewire\PayrollItems;

use App\Models\PayrollItem;
use Livewire\Component;

class PayrollItemShow extends Component
{
    public $payroll_item, $payroll_item_id;
    protected $listeners = [
        'refreshPayrollItemShow' => 'ActionRefreshPayrollItemShow'
    ];

    public function ActionRefreshPayrollItemShow()
    {

    }

    public function mount($payroll_item_id)
    {
        $this->payroll_item_id = $payroll_item_id;
        $this->payroll_item = PayrollItem::where('payroll_id', $payroll_item_id)->get();
        // dd($this->payroll_item);

    }

    public function render()
    {
        // return view('livewire.invoice-items.invoice-item-show');
        return view('livewire.payroll-items.payroll-items-show', [
            'payrolls' => $this->payroll_item,
            'payroll_item_id' => $this->payroll_item_id
        ]);
    }
}
