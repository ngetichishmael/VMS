<?php

namespace App\Http\Livewire\Settings;
use App\Models\Setting;
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
    public $setting;

//    public function mount($organization_code)
//    {
//        $this->organization_code = $organization_code;
//    }

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';
        //$settings = Setting::where('organization_code', $this->organization_code)->get();
        $setting = Setting::with('organization')
            ->whereLike(['organization.name'], $searchTerm)
            ->paginate($this->perPage);
        return view('livewire.settings.dashboard', ['settings' => $setting]);
    }
}
