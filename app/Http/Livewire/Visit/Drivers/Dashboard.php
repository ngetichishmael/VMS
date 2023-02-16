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
    public $perPage = 40;
    public $sortField = 'id';
    public $sortAsc = true;
    public ?string $search = null;
    public function render()
    {

        $searchTerm = '%' . $this->search . '%';
        $dvisitors = DriveIn::with('organization')
            ->with('vehicle')
            ->where('type', 'drivein')
            ->whereLike('name',  $searchTerm)->get();
        //$types = IdentificationType::whereLike(['name', 'user.email'], $searchTerm)

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
