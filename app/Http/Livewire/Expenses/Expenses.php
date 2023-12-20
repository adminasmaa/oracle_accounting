<?php

namespace App\Http\Livewire\Expenses;

use App\Models\ArrestReceipt;
use App\Models\PayrollItem;
use Livewire\Component;
use Livewire\WithPagination;

class Expenses extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshExpensesList' => 'ActionRefreshExpensesList'
    ];

    function ActionRefreshExpensesList()
    {

    }

    public function render()
    {

        return view('livewire.expenses.expenses', [
            'arrestreceipts' => ArrestReceipt::where('type', 3)->paginate(5),

        ]);
    }

}
