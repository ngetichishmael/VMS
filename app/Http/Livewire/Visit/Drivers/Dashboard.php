<?php

namespace App\Http\Livewire\Visit\Drivers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DriveIn;

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
//        ->where('organizationid', Auth::user()->organizationId)
//        $organization_id = '%' . Auth::user()->organizationId . '%';
        $dvisitors = DriveIn::where('visitortype', 'drivein')
//           ->whereLike(
//                [
//                    "firstName",
//                    "middlename",
//                    "lastName",
//                    "phoneNumber",
//                    "gender",
//                    "visitortype",
//                    "nationalityId",
//                    "IDNO",
//                    "purpose",
//                    "organizationId",
//                    "premisesId",
//                    "tagId",
//                    "hostName",
//                    "timeIn",
//                    "timeOut",
//                ],
//                $searchTerm
//            )
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);
        return view('livewire.visit.drivers.dashboard')->with(['dvisitors' => $dvisitors]);
    }
}
