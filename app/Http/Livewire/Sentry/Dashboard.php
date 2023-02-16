<?php

namespace App\Http\Livewire\Sentry;

use Livewire\Component;
use App\Models\Sentry;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 40;
    public $sortField = 'id';
    public $sortAsc = true;
    public ?string $search = null;
    public function render()
    {
        $this->sentries = Sentry::join('user_details', 'sentries.user_detail_id', '=', 'user_details.id')
       
        ->join('shifts', 'sentries.shift_id', '=', 'shifts.id')

        ->select('sentries.*', 'user_details.ID_number','user_details.phone_number', 'user_details.company','shifts.name AS shiftname')
        
        ->get();

        $searchTerm = '%' . $this->search . '%';

        $sentries = Sentry::whereLike(['name', ], $searchTerm)

        ->get();

        return view('livewire.sentry.dashboard', [
            'sentries' => $sentries,
        ]);
    }
}
