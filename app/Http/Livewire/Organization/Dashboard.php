<?php

namespace App\Http\Livewire\Organization;

use Livewire\Component;
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
        $searchTerm = '%' . $this->search . '%';
        $organizations = Organization::whereLike(['name'], $searchTerm)
            ->get();
        return view('livewire.organization.dashboard', [
            'organizations ' => $organizations ,
        ]);
    }
}
