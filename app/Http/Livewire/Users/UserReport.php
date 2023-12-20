<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Models\Invoice;
use App\Models\ArrestReceipt;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserReport extends Component
{
    public $user;

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
        $this->user['role_id'] = $this->user->roles->pluck('id');
        $this->user = $this->user->toArray();
    }

    public function render()
    {
// dd($this->user['id']);
        $userss = User::find($this->user['id']);
        $invoice = Invoice::where('user_id', $this->user['id'])->get();
        $arrestreceipt = ArrestReceipt::where('user_id', $this->user['id'])->get();

        return view('livewire.users.user-report', [
            'userss' => $userss,
            'invoice' => $invoice,
            'arrestreceipt' => $arrestreceipt,
        ]);
    }
}
