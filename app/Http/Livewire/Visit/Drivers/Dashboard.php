<?php

namespace App\Http\Livewire\Visit\Drivers;

use App\Models\Visitor;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DriveIn;
use App\Models\VisitorType;
use App\Models\IdentificationType;

class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public ?string $search = null;
    public $visitorTypeId;
    public $identificationTypeId;
    public $sortTimeField = 'time';
    public $sortTimeAsc = true;
    public function sortBy($field)
    {
        if ($field === $this->sortField) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortField = $field;
            $this->sortAsc = true;
        }
    }
    public function render()
    {
        $searchTerm = '%' . $this->search . '%';
        $dvisitors = DriveIn::with('organization','vehicle', 'timeLogs')
            ->when($this->visitorTypeId, function ($query) {
                $query->where('visitor_type_id', $this->visitorTypeId);
            })
            ->when($this->identificationTypeId, function ($query) {
                $query->where('identification_type_id', $this->identificationTypeId);
            })
            ->where('type', 'drivein')
            ->whereLike(['vehicle.registration', 'name','user.email','purpose.name', 'premises.name','organization1.name', 'unit.name'], $searchTerm)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        $visitorTypes = VisitorType::all();
        $identificationTypes = IdentificationType::all();
        foreach ($dvisitors as $visitor) {
            $entryTime = Carbon::parse($visitor->timeLogs->entry_time);
            $exitTime = Carbon::parse($visitor->timeLogs->exit_time);
            $duration = $entryTime->diff($exitTime);

            $visitor->duration = $duration->format('%H Hours %I Minutes %S Seconds');
        }
        return view('livewire.visit.drivers.dashboard', [
            'dvisitors' => $dvisitors,
            'visitorTypes' => $visitorTypes,
            'identificationTypes' => $identificationTypes,
            ]);
    }


}
