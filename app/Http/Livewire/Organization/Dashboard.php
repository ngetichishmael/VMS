<?php

namespace App\Http\Livewire\Organization;


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

        $organization = Organization::whereLike(['name'], $searchTerm)
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);
        return view('livewire.organization.dashboard', ['organizations' => $organization]);
    }



}
