<?php

namespace App\Http\Livewire\Visit\Walks;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\WalkIn;
use App\Models\VisitorType;


class Dashboard extends Component
{
//    public $duration = 0;
//
//    public function calculateDuration($timeIn, $timeOut)
//    {
//        $timeIn = Carbon::createFromFormat('Y-m-d H:i:s', $timeIn);
//        $timeOut = Carbon::createFromFormat('Y-m-d H:i:s', $timeOut);
//        $this->duration = $timeOut->diffInSeconds($timeIn);
//    }
    public $selectedVisitorType;
    public $visitorTypes;

    public function mount() {
        $this->visitorTypes = VisitorType::all();
    }
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public function render()
    {

        $searchTerm = '%' . $this->search . '%';
        $visitors = WalkIn::with('organization')
          ->where('type', 'walkin')
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);
        if ($this->selectedVisitorType) {
            $visitors->whereHas('visitorType', function ($visitors) {
                $visitors->where('id', $this->selectedVisitorType);
            });
        }
        return view('livewire.visit.walks.dashboard')->with(['visitors' => $visitors]);
    }
}
