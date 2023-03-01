<?php

namespace App\Http\Livewire\Premises\Unit;

use Livewire\Component;
use App\Models\Unit;
use App\Models\Block;
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

    public $blockId, $name, $block_id, $unit_edit_id;

    public function render()
    {

    
            $searchTerm = '%' . $this->search . '%';

            $units = Unit::with('block')
                ->when($this->blockId, function ($query) {
                    $query->where('block_id', $this->blockId);
                })
                ->whereLike(['name','block.name'], $searchTerm)
                ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
                ->paginate($this->perPage);

            $blocks = Block::all();

        return view('livewire.premises.unit.dashboard', ['units' => $units, 'blocks' => $blocks]);
    }


    private function resetInput()
    {
        $this->name = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:2',
            'block_id' => 'required',
        ]);
  
        //Add Student Data
        $unit = new Unit();
    
        $unit->name = $this->name;

        $unit->block_id = $this->block_id;

        $unit->save();

        return redirect()->route('UnitInformation');

        $this->resetInput();

    }

    public function editUnit($id)
    {
        $unit = Unit::where('id', $id)->first();

        $this->unit_edit_id = $id;

        $this->name = $unit->name;
  
        $this->dispatchBrowserEvent('show-edit-unit-modal');
    }

    public function editUnitData()
    {
     

        $unit = Unit::where('id', $this->unit_edit_id)->first();

        $unit->name = $this->name;

        $unit->block_id = $this->block_id;
 
        $unit->save();

        return redirect()->route('UnitInformation');

        $this->resetInput();
    }

    public function destroy($id)
    {
        if ($id) {
            $unit = Unit::where('id', $id);
            $unit->delete();

            return redirect()->to('/unit/information')->with('error','Unit Deleted successfully!');
        }
    }

    public function activate($id)
    {
       
        Unit::whereId($id)->update(
          ['status' => "1"]
       );
       return redirect()->to('/unit/information')->with('success','Unit Enabled successfully!');
    }

    public function deactivate($id)
    {
       
        Unit::whereId($id)->update(
          ['status' => "0"]
       );
       return redirect()->to('/unit/information')->with('warning',' Unit Disabled successfully!');
    }
}