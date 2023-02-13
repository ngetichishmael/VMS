<?php

namespace App\Http\Livewire\Visit\Drivers;

use App\Models\Visitor;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DriveIn;
use App\Models\VisitorType;
use App\Models\IdentificationType;

class Dashboard extends Component
{
//    public $visitorTypes;
//    public $selectedVisitorType;
//    public $selectedIdentificationType;
//
//    public function mount() {
//        $this->visitorTypes = VisitorType::all();
//        $this->identificationTypes = IdentificationType::all();
//    }
    public $fvisitors;

    public function mount()
    {
        $this->fvisitors = Visitor::all();
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
                $query->where('name', 'like', $searchTerm);
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);
//
//        if ($this->selectedVisitorType) {
//            $dvisitors->whereHas('visitorType', function ($dvisitors) {
//                $dvisitors->where('id', $this->selectedVisitorType);
//            });
//        }
//        if ($this->selectedIdentificationType) {
//           $dvisitors->whereHas('identificationType', function ($dvisitors) {
//               dd( $dvisitors->where('id', $this->selectedIdentificationType));
//            });
//        }
        return view('livewire.visit.drivers.dashboard')->with(['dvisitors' => $dvisitors]);
    }
    public function visitorTypeIdSelected($selectedVisitorTypeId)
    {
        dd($selectedVisitorTypeId);

        if ($selectedVisitorTypeId == 0) {
            $this->visitors = Visitor::all();
        } else {
            $this->visitors = Visitor::where('visitor_type_id', $selectedVisitorTypeId)->get();
        }
    }
    public function identificationTypeIdSelected($selectedIdentificationTypeId)
    {
        if ($selectedIdentificationTypeId == 0) {
            $this->visitors = Visitor::all();
        } else {
            $this->visitors = Visitor::where('identification_type_id', $selectedIdentificationTypeId)->get();
        }
    }
}
