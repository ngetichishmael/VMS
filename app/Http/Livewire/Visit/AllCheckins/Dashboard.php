<?php

namespace App\Http\Livewire\Visit\AllCheckins;

use App\Models\DriveIn;
use App\Models\Visitor;
use App\Models\VisitorType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

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
    public $sortTimeField = 'entry_time';
    public $sortTimeAsc = true;
    public $timeFilter = 'all';
    protected $visitors;
    public $checkinType = null;

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

        $this->visitors = DriveIn::with( ['vehicle', 'timeLogs', 'resident.unit.block.premise.organization'] )
            ->orderBy('visitors.id', 'desc')
            ->whereIn('visitors.id', function ($query) {
                $query->select(DB::raw('MAX(visitors.id)'))
                    ->from('visitors')
                    ->groupBy('user_detail_id');
            })
            ->when($this->visitorTypeId, function ($query) {
                $query->where('visitor_type_id', $this->visitorTypeId);
            })
            ->when($this->checkinType, function ($query) {
                $query->where('type', $this->checkinType);
            })
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
            ->search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    public function render()
    {
        $this->applyTimeFilter();
        $visitorTypes = VisitorType::all();
//        foreach ($this->visitors as $visitor) {
//            $entryTime = Carbon::parse($visitor->timeLogs->entry_time ?? now());
//            $exitTime = Carbon::parse($visitor->timeLogs->exit_time ?? now());
//            $duration = $entryTime->diff($exitTime);
//
//            $visitor->duration = $duration->format('%H Hours %I Minutes %S Seconds');
//        }
        return view('livewire.visit.all-checkins.dashboard', [
            'visitors' => $this->visitors,
            'visitorTypes' => $visitorTypes,
        ]);
    }
}
