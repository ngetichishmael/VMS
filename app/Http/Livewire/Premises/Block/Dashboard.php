<?php

namespace App\Http\Livewire\Premises\Block;

use Livewire\Component;
use App\Models\Block;
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
    public $sortField = 'id';
    public $sortAsc = true;
    public ?string $search = null;
    public $orderBy = 'id';
    public $orderAsc = true;
    public $sortTimeField = 'time';
    public $sortTimeAsc = true;

    public $premiseId;

    public function render()
    {

    
            $searchTerm = '%' . $this->search . '%';

            $blocks = Block::with('premise')
                ->when($this->premiseId, function ($query) {
                    $query->where('premise_id', $this->premiseId);
                })
                ->whereLike(['name','premise.name'], $searchTerm)
                ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
                ->paginate($this->perPage);
        return view('livewire.premises.block.dashboard', ['blocks' => $blocks]);
    }


    private function resetInput()
    {
        $this->name = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:2',
        
        ]);
  
        Block::create([
            'name' => $this->name,
        ]);
        $this->resetInput();

        return redirect()->route('Shifts');
    }

    public function editShift($id)
    {
        $shift = Block::where('id', $id)->first();

        $this->shift_edit_id = $id;

        $this->name = $shift->name;
  
        $this->dispatchBrowserEvent('show-edit-shift-modal');
    }

    public function editShiftData()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required|min:2',
        ]);

        $shift = Block::where('id', $this->shift_edit_id)->first();

        $shift->name = $this->name;
 
        $shift->save();

        session()->flash('message', 'Shift has been updated successfully');

      
        return redirect()->route('Shifts');
    }

    public function destroy($id)
    {
        if ($id) {
            $shift = Block::where('id', $id);
            $shift->delete();

            return redirect()->to('/block/information');
        }
    }

    public function activate($id)
    {
       
        Block::whereId($id)->update(
          ['status' => "1"]
       );
       return redirect()->to('/block/information');
    }

    public function deactivate($id)
    {
       
        Block::whereId($id)->update(
          ['status' => "0"]
       );
       return redirect()->to('/block/information');
    }
}
