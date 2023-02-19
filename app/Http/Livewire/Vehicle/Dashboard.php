<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\VehicleInformation;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public ?string $search = null;
    public $sortTimeAsc = true;
    public function render()
    {
        $searchTerm = '%' . $this->search . '%';
        $vehicle = VehicleInformation::with('user')
        ->whereLike(['registration', 'user.name', 'model', 'color','type'], $searchTerm)
            ->paginate($this->perPage);
        return view('livewire.vehicle.dashboard', ['vehicles'=>$vehicle]);
    }
}
