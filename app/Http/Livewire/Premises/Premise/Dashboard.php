<?php

namespace App\Http\Livewire\Premises\Premise;

use Livewire\Component;
use App\Models\Premise;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\This;

class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public ?string $search = null;
    public $orderBy = 'id';
    public $orderAsc = true;

    public $data, $name, $shift_edit_id;
    public $updateMode = false;

    public function render()
    {

        $searchTerm = '%' . $this->search . '%';

        $premises = Premise::whereLike(['name'], $searchTerm)
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);
        
        return view('livewire.premises.premise.dashboard', ['premises' => $premises]);
    }
}
