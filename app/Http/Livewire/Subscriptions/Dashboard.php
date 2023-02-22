<?php

namespace App\Http\Livewire\Subscriptions;

use App\Models\Subscription;
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
    public $subscription;

//    public function mount($organization_code)
//    {
//        $this->organization_code = $organization_code;
//    }

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';
        //$subscriptions = Subscription::where('organization_code', $this->organization_code)->get();
        $subscription = Subscription::with('organization')
            ->whereLike(['organization.name'], $searchTerm)
            ->paginate($this->perPage);
        return view('livewire.subscriptions.dashboard', ['subscriptions' => $subscription]);
    }
}
