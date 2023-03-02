<?php

namespace App\Http\Livewire\Activity;

use App\Models\Activity;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 25;
    public $sortField = 'id';
    public $sortAsc = true;
    public ?string $search = null;
    public function render()
    {

        $searchTerm = '%' . $this->search . '%';
        $activities = Activity::whereLike(
            ['name', 'organization', 'target'],
            $searchTerm
        )
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.activity.dashboard', [
            'activities' => $activities
        ]);
    }
}
