<?php

namespace App\Http\Livewire\Visit\Drivers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DriveIn;
use App\Models\VisitorType;

class Dashboard extends Component
{
    public $visitorTypes;
    public $selectedVisitorType;

    public function mount() {
        $this->visitorTypes = VisitorType::all();
    }
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public ?string $search = null;
    public $orderBy = 'id';
    public $orderAsc = true;
    public function render()
    {

        $searchTerm = '%' . $this->search . '%';
        $dvisitors = DriveIn::with('dorganization')
            ->with('vehicle')
        ->where('type', 'drivein')
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('site', 'like', $searchTerm)
                    ->orWhere('section', 'like', $searchTerm)
                    ->orWhere('timeIn', 'like', $searchTerm)
                    ->orWhere('timeOut', 'like', $searchTerm);
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);
        if ($this->selectedVisitorType) {
            $dvisitors->whereHas('visitorType', function ($dvisitors) {
                $dvisitors->where('id', $this->selectedVisitorType);
            });
        }
        return view('livewire.visit.drivers.dashboard')->with(['dvisitors' => $dvisitors]);
    }
}
