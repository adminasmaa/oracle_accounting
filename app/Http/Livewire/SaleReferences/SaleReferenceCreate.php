<?php

namespace App\Http\Livewire\SaleReferences;

use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;

class SaleReferenceCreate extends Component
{
    public $invoice;
    public $date;
    public $user;
    protected $listeners = [
        'refreshSaleReferenceShow' => 'ActionRefreshSaleReferenceShow'
    ];

    public function ActionRefreshSaleReferenceShow()
    {

    }

    public function mount($invoice_id)
    {

    }


    public function render()
    {
        // dd("wsw");
        return view('livewire.sale-references.sale-reference-create', [
            'users' => User::role((($this->invoice and $this->invoice['type'] == 3) ? 'Supplier' : 'Customer'))->get(),
        ]);
    }

}
