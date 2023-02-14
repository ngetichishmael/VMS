<?php

namespace App\Http\Livewire\IdentificationType;

use App\Models\IdentificationType;
use Livewire\Component;
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
        $searchTerm = '%' . $this->search . '%';
        $types = IdentificationType::whereLike(['name'], $searchTerm)
            ->get();
        return view('livewire.identification-type.dashboard', [
            'types' => $types,
        ]);
    }
}
