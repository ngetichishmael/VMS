<?php

namespace App\Http\Livewire\Organization;

use App\Models\DriveIn;
use App\Models\Organization;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public ?string $search = null;
    public $orderBy = 'id';
    public $orderAsc = true;
    public function render()
    {

        $searchTerm = '%' . $this->search . '%';
        $organization = Organization::where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);
        return view('livewire.organization.dashboard')->with(['organizations' => $organization]);
    }
}
