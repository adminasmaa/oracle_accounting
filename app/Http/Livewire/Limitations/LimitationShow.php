<?php

namespace App\Http\Livewire\Limitations;

use App\Models\Limitation;
use Livewire\Component;
use Livewire\WithPagination;

class LimitationShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $item;
    protected $listeners = [
        'refreshLimitationShowList' => 'ActionRefreshLimitationShowList'
    ];

    function ActionRefreshLimitationShowList()
    {

    }

    public function mount($limitation_id)
    {
        $this->item = Limitation::where('id', $limitation_id)->first();

    }

    public function render()
    {
        $items = Limitation::find($this->item->id);

        return view('livewire.limitations.limitation-show', [
            'items' => $items
        ]);
    }
}
