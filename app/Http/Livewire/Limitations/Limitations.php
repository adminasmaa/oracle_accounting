<?php

namespace App\Http\Livewire\Limitations;

use App\Models\Limitation;
use Livewire\Component;
use Livewire\WithPagination;

class Limitations extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'refreshLimitationsList' => 'ActionRefreshLimitationsList'
    ];

    function ActionRefreshItemsList()
    {

    }

    public function mount()
    {
        if (request('search')) {
            $this->search = request('search');
        }
    }

    public function render()
    {
        $items = Limitation::query();
        if ($this->search) {
            $items = $items->where(function ($q) {
                return $q->where('name', 'LIKE', "%$this->search%")
                    ->orWhere('item_number', 'LIKE', "%$this->search%")
                    ->orWhere('serial_number', 'LIKE', "%$this->search%")
                    ->orWhere('place', 'LIKE', "%$this->search%");
            });
        }
        $items = $items->get();
 
        return view('livewire.limitations.limitations', [
            'items' => $items
        ]);
    }
}
