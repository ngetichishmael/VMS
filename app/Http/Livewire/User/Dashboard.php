<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Organization;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 40;
    public $sortField = 'id';
    public $sortAsc = true;
    public ?string $search = null;

    public function render()
    {
        $this->users = User::join('organizations', 'users.organization_id', '=', 'organizations.id')
       
        ->select('users.*', 'organizations.name AS org_name')
        
        ->get();

        $searchTerm = '%' . $this->search . '%';
        
        $users = User::whereLike(['name'], $searchTerm)
            ->get();

        return view('livewire.user.dashboard', [
            'users' => $users,
        ]);
    }
}
