<?php

namespace App\Http\Livewire\Visit\Walks;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Walkin;

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
        $visitors =  visitor_information::with('visitortype')
            ->where('visitortype', 'walkin')
            ->whereLike(
                [
                    "firstName",
                    "middlename",
                    "lastName",
                    "phoneNumber",
                    "gender",
                    "visitortype",
                    "nationalityId",
                    "IDNO",
                    "purpose",
                    "organizationId",
                    "premisesId",
                    "tagId",
                    "hostName",
                    "timeIn",
                    "timeOut",
                ],
                $searchTerm
            )
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);

        return view('livewire.visit.walks.dashboard', compact('visitors'));
    }
}
