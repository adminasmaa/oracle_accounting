<?php

namespace App\Http\Livewire\Revenues;

use App\Models\ArrestReceipt;
use App\Models\PayrollItem;
use Livewire\Component;
use Livewire\WithPagination;

class Revenues extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshRevenuesList' => 'ActionRefreshRevenuesList'
    ];

    function ActionRefreshRevenuesList()
    {

    }

    public function render()
    {

        return view('livewire.revenues.revenues', [
            'arrestreceipts' => ArrestReceipt::where('type', 4)->paginate(5),

        ]);
    }

}
