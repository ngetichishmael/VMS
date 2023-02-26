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

    public $premiseId, $name, $premise_id, $block_edit_id;

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

            $premises = Premise::all();

        return view('livewire.premises.block.dashboard', ['blocks' => $blocks, 'premises' => $premises]);
    }


    private function resetInput()
    {
        $this->name = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:2',
            'premise_id' => 'required',
        ]);
  
        //Add Student Data
        $block = new Block();
    
        $block->name = $this->name;

        $block->premise_id = $this->premise_id;

        $block->save();

        return redirect()->route('BlockInformation');

        $this->resetInput();

    }

    public function editBlock($id)
    {
        $block = Block::where('id', $id)->first();

        $this->block_edit_id = $id;

        $this->name = $block->name;
  
        $this->dispatchBrowserEvent('show-edit-block-modal');
    }

    public function editBlockData()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required|min:2',
            'premise_id' => 'required',
        ]);

        $block = Block::where('id', $this->block_edit_id)->first();

        $block->name = $this->name;

        $block->premise_id = $this->premise_id;
 
        $block->save();

        return redirect()->route('BlockInformation');

        $this->resetInput();
    }

    public function destroy($id)
    {
        if ($id) {
            $block = Block::where('id', $id);
            $block->delete();

            return redirect()->to('/block/information')->with('error','Block Deleted successfully!');
        }
    }

    public function activate($id)
    {
       
        Block::whereId($id)->update(
          ['status' => "1"]
       );
       return redirect()->to('/block/information')->with('success','Block Enabled successfully!');
    }

    public function deactivate($id)
    {
       
        Block::whereId($id)->update(
          ['status' => "0"]
       );
       return redirect()->to('/block/information')->with('warning','Block Disabled successfully!');
    }
}