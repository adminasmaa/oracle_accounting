<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Models\PayrollItem;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use App\Models\ArrestReceipt;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search, $role_id, $account;

    protected $listeners = [
        'refreshUsersList' => 'ActionRefreshUsersList'
    ];

    function ActionRefreshUsersList()
    {
    }

    public function mount()
    {
        if (request('search')) {
            $this->search = request('search');
        }

        if (!auth()->user()->hasRole('Admin') and !in_array(request('role_id'), ['2', '3', '4'])) {
            abort(403);
        }

        if (request('role_id')) {
            $this->role_id = request('role_id')?request('role_id'):3;
        }else{
            $this->role_id = 3;
        }
    }

    public function render()
    {

        $users = User::query();
        if ($this->search) {
            $users = $users->where(function ($q) {
                return $q->where('name', 'LIKE', "%$this->search%")
                    ->orWhere('email', 'LIKE', "%$this->search%")
                    ->orWhere('mobile', 'LIKE', "%$this->search%");
            });
        }

        if ($this->role_id) {
            $users = $users->whereHas('roles', function ($q) {
                return $q->where('id', $this->role_id);
            });
        }

        $users = $users->paginate(10);

        return view('livewire.users.users', [
            'users' => $users,
            'roles' => Role::all(),
            'account' => $this->account
        ]);
    }

    public function viewreport($user_id)
    {
        return redirect()->route('report.viewreport', $user_id);
    }
}
