<?php

namespace App\Http\Livewire\Visit\Walks;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\WalkIn;
use App\Models\VisitorType;


class Dashboard extends Component
{
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
            ->with('timeLogs')
          ->where('type', 'walkin')
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);
//        if ($this->selectedVisitorType) {
//            $visitors->whereHas('visitorType', function ($visitors) {
//                $visitors->where('id', $this->selectedVisitorType);
//            });
//        }
        return view('livewire.visit.walks.dashboard')->with(['visitors' => $visitors]);
    }
}
