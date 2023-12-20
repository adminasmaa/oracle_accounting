<?php

namespace App\Http\Livewire\Payrolls;

use App\Models\Payroll;
use App\Models\PayrollItem;
use Livewire\Component;
use Livewire\WithPagination;

class Payrolls extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshPayrollsList' => 'ActionRefreshPayrollsList'
    ];

    function ActionRefreshPayrollsList()
    {

    }

    public function render()
    {

        return view('livewire.payrolls.payrolls', [
            'payrolls' => Payroll::paginate(5),

        ]);
    }

    public function addpayroll()
    {
        return redirect()->route('payrolls.newpayrolls');
    }
}
