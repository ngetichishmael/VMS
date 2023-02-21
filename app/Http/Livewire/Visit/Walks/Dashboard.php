<?php

namespace App\Http\Livewire\Visit\Walks;

use App\Models\Organization;
use App\Models\TimeLog;
use App\Models\Visitor;
use App\Models\WalkIn;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
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
    public $organizationCodeId;
    public $sortTimeField='entry_time';
    public $sortTimeAsc = true;
    public $timeFilter = 'all';
    protected $visitors;

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
        $this->resetPage();

        $this->visitors = WalkIn::with('organization', 'timeLogs')
            ->when($this->visitorTypeId, function ($query) {
                $query->where('visitor_type_id', $this->visitorTypeId);
            })
            ->when($this->organizationCodeId, function ($query) {
                $query->where('resident.unit.block.premise.organization.code', $this->organizationCodeId);
            })
            ->where('type', 'walkin')
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
            ->leftJoin('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->orderBy('time_logs.entry_time', $this->sortTimeAsc ? 'asc' : 'desc')
            ->orderBy('visitors.id', $this->sortField === 'id' ? ($this->sortAsc ? 'asc' : 'desc') : '')
            ->paginate($this->perPage);
    }
    public function render()
    {
        $searchTerm = '%' . $this->search . '%';
        $this->applyTimeFilter();
        $visitorTypes = VisitorType::all();
        $organizationCodes = Organization::all();
        foreach ($this->visitors as $visitor) {
            $entryTime = Carbon::parse($visitor->timeLogs->entry_time);
            $exitTime = Carbon::parse($visitor->timeLogs->exit_time);
            $duration = $entryTime->diff($exitTime);

            $visitor->duration = $duration->format('%H Hours %I Minutes %S Seconds');
        }
        return view('livewire.visit.walks.dashboard', [
            'visitors' => $this->visitors,
            'visitorTypes' => $visitorTypes,
//        'organizationCodes' => $organizationCodes,
        ]);
    }
}
