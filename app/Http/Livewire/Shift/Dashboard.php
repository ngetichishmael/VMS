<?php

namespace App\Http\Livewire\Shift;

use Livewire\Component;
use App\Models\Shift;
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

        $shifts = Shift::whereLike(['name'], $searchTerm)
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);
        return view('livewire.shift.dashboard', ['shifts' => $shifts]);
    }
}
