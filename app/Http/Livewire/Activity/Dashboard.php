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
    public $sortField = 'created_at';
    public $sortAsc = true;
    public ?string $search = null;
    public function render()
    {

        $searchTerm = '%' . $this->search . '%';
        $activities = Activity::orderBy($this->sortField, $this->sortAsc ? 'desc' : 'asc')
            ->whereLike(
            ['name', 'organization', 'target'],
            $searchTerm
        )
            ->paginate($this->perPage);

        return view('livewire.activity.dashboard', [
            'activities' => $activities
        ]);
    }
}
