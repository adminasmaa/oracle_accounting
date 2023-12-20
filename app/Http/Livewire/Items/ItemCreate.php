<?php

namespace App\Http\Livewire\Items;


use App\Models\Item;
use App\Models\Unit;
use Livewire\Component;
use App\Models\Category;
use App\Models\UnitItem;
use App\Models\Attachment;
use Faker\Factory;
use Livewire\WithFileUploads;
use Session;

class ItemCreate extends Component
{

    use WithFileUploads;

    public $item, $categories, $units, $catchError;
    public $addItem = array();
    public $category;
    public $i = 0;

    public function mount()
    {
        $this->categories = Category::all();
        $this->units = Unit::all();
    }

    public function store()
    {
        $fake = Factory::create();
        $data = $this->validate([
            'item.name' => 'required',
            'item.path' => 'nullable|image|mimes:jpg,png',
            'item.item_number' => 'required|unique:'.Item::class.',item_number',
            'item.serial_number' => 'required|unique:'.Item::class.',serial_number',
            'item.place' => 'nullable|string',
            'item.category_id' => 'nullable|int|exists:categories,id',
            'item.serial_multi' => 'nullable',
        ]);

        // dd($data);
        $item = Item::create($data['item']);
        try {
            $ifcategoryexists = Category::where('name', $this->category)->first();
            if (!$ifcategoryexists) {
                $newCategory = Category::create([
                    'name' => $this->category,
                ]);
                $data['item']['category_id'] = $newCategory->id;
            } else {
                $data['item']['category_id'] = $ifcategoryexists->id;
            }

            if (!empty($this->item['path'])) {
                $file = $this->item['path']->store('attachments', 'public');
                Attachment::create([
                    'path' => $file,
                    'item_id' => $item->id,
                ]);
            }

            for ($this->i; $this->i < 3; $this->i++) {
                Unit::create([
                    'name' => "الوحدة ".($this->i+1),
                    'measruing_unit' => 'ml',
                    'item_id' => $item->id,
                    'pieces' => 1*($this->i+1),
                ]);
            }

        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }

        Session::flash("msg", "Created Successfully");
        return $this->redirect(route('items'));
    }

    public function render()
    {
        return view('livewire.items.item-create');
    }
}
