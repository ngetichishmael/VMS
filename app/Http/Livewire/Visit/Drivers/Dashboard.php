<?php

namespace App\Http\Livewire\Visit\Drivers;

use App\Models\Organization;
use App\Models\TimeLog;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
    public $sortTimeField = 'entry_time';
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

        $this->dvisitors = DriveIn::with(['vehicle', 'timeLogs', 'visitorType','resident.unit.block.premise.organization'] )
            ->where('type', '=', 'DriveIn')->orderBy('visitors.id', 'desc')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('visitors')
                    ->groupBy('user_detail_id');
            })
            ->when($this->visitorTypeId, function ($query) {
                $query->where('visitor_type_id', $this->visitorTypeId);
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
            ->orderBy('visitors.id', $this->sortField === 'id' ? ($this->sortAsc ? 'asc' : 'desc') : '')
            ->paginate($this->perPage);
    }
    public function render()
    {
        $this->applyTimeFilter();
        $visitorTypes = VisitorType::all();

        foreach ($this->dvisitors as $visitor) {
            $entryTime = Carbon::parse($visitor->timeLog->entry_time ?? now());
            $exitTime = Carbon::parse($visitor->timeLog->exit_time ?? now());
            $duration = $entryTime->diff($exitTime);

            $visitor->duration = $duration->format('%H Hours %I Minutes %S Seconds');
        }

        return view('livewire.visit.drivers.dashboard', [
            'dvisitors' => $this->dvisitors,
            'visitorTypes' => $visitorTypes,
        ]);
    }
    public function toJson(): \Illuminate\Support\Collection
    {
        $data = $this->dvisitors->map(function ($visitor) {
            $entryTime = Carbon::parse($visitor->timeLog->entry_time ?? now());
            $exitTime = Carbon::parse($visitor->timeLog->exit_time ?? now());
            $duration = $entryTime->diff($exitTime);

            return [
                'data' => [
                    'name' => $visitor->name,
                    'vehicle.name' => $visitor->vehicle->name,
                    'site' => $visitor->site,
                    'section' => $visitor->section,
                    'organization' => $visitor->organization,
                    'time in' => $visitor->timeLog->entry_time ?? '',
                    'time out' => $visitor->timeLog->exit_time ?? '',
                    'duration' => $duration->format('%H Hours %I Minutes %S Seconds'),
                    'action' => '',
                ],
            ];
        });

        return collect(['data' => $data]);
    }

}
