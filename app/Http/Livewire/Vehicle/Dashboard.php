<?php

namespace App\Http\Livewire\Vehicle;

use App\Models\VehicleInformation;
use Livewire\Component;
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
        $vehicle = VehicleInformation::with('user')
        ->whereLike(['registration', 'user.name'], $searchTerm)->get();
        return view('livewire.vehicle.dashboard', ['vehicles'=>$vehicle]);
    }
}
