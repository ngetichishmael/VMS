<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Organization;
use App\Models\Role;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    
    
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public ?string $search = null;
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        $this->users = User::join('organizations', 'users.organization_id', '=', 'organizations.id')
       
        ->join('roles', 'users.role_id', '=', 'roles.id')
       
        ->select('users.*', 'organizations.name AS org_name', 'roles.name AS role_name')
        
        ->get();
    
        $searchTerm = '%' . $this->search . '%';
        
        $users = User::whereLike(['name'], $searchTerm)
        
        ->get();

        $organizations = Organization::select(['id','name'])

        ->get();

        $roles = Role::select(['id','name'])

        ->get();

        return view('livewire.user.dashboard', [ 
            'users' => $users, 
             'organizations' => $organizations,
             'roles' => $roles,
        ]);
    }
}
