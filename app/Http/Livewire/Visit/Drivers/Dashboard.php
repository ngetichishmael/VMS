<?php

namespace App\Http\Livewire\Visit\Drivers;

use App\Models\Organization;
use App\Models\TimeLog;
use App\Models\Visitor;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DriveIn;
use App\Models\VisitorType;

class Dashboard extends Component
{
    use WithPagination;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public ?string $search = null;
    public $visitorTypeId;
    public $sortTimeField='entry_time';
    public $sortTimeAsc = true;
    public $timeFilter = 'all';
    protected $dvisitors;

    public function sortBy($field)
    {
        if ($field === $this->sortField) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortField = $field;
            $this->sortAsc = true;
        }
    }
    public function sortByTime($field)
    {
        if ($field === $this->sortTimeField) {
            $this->sortTimeAsc = !$this->sortTimeAsc;
        } else {
            $this->sortTimeField = $field;
            $this->sortTimeAsc = true;
        }
    }
    public function applyTimeFilter()
    {
        $searchTerm = '%' . $this->search . '%';
        $this->resetPage();

        $this->dvisitors = DriveIn::with('organization', 'vehicle', 'timeLogs', 'Resident.unit.block.premise.organization')
            ->when($this->visitorTypeId, function ($query) {
                $query->where('visitor_type_id', $this->visitorTypeId);
            })
            ->where('type', 'drivein')
            ->when($this->timeFilter != 'all', function ($query) {
                $query->whereHas('timeLogs', function ($subQuery) {
                    if ($this->timeFilter == 'daily') {
                        $subQuery->whereDate('entry_time', Carbon::now()->toDateString());
                    } else if ($this->timeFilter == 'weekly') {
                        $subQuery->whereBetween('entry_time', [
                            Carbon::now()->startOfWeek()->toDateTimeString(),
                            Carbon::now()->endOfWeek()->toDateTimeString(),
                        ]);
                    } else if ($this->timeFilter == 'monthly') {
                        $subQuery->whereYear('entry_time', Carbon::now()->year)
                            ->whereMonth('entry_time', Carbon::now()->month);
                    }
                });
            })
            ->whereLike(['name', 'vehicle.registration'], $searchTerm)->orWhereHas('Resident.unit.block.premise.organization', function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            })->orWhereHas('Resident.unit.block.premise', function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            })->orWhereHas('Resident.unit.block', function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            })->orWhereHas('Resident.unit', function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            })
            ->leftJoin('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->orderBy('time_logs.entry_time', $this->sortTimeAsc ? 'asc' : 'desc')
            ->orderBy('visitors.id', $this->sortField === 'id' ? ($this->sortAsc ? 'asc' : 'desc') : '')
            ->paginate($this->perPage);
    }
    public function render()
    {
        $this->applyTimeFilter();
        $visitorTypes = VisitorType::all();
        foreach ($this->dvisitors as $visitor) {
            $entryTime = Carbon::parse($visitor->timeLogs->entry_time);
            $exitTime = Carbon::parse($visitor->timeLogs->exit_time);
            $duration = $entryTime->diff($exitTime);

            $visitor->duration = $duration->format('%H Hours %I Minutes %S Seconds');
        }
        return view('livewire.visit.drivers.dashboard', [
            'dvisitors' => $this->dvisitors,
            'visitorTypes' => $visitorTypes,
        ]);
    }



}
