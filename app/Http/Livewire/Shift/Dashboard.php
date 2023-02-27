<?php

namespace App\Http\Livewire\Shift;

use Livewire\Component;
use App\Models\Shift;
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

        $shifts = Shift::whereLike(['name'], $searchTerm)
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);
        return view('livewire.shift.dashboard', ['shifts' => $shifts]);
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
  
        Shift::create([
            'name' => $this->name,
        ]);
        $this->resetInput();

        return redirect()->route('Shifts');
    }

    public function editShift($id)
    {
        $shift = Shift::where('id', $id)->first();

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

        $shift = Shift::where('id', $this->shift_edit_id)->first();

        $shift->name = $this->name;
 
        $shift->save();

        session()->flash('message', 'Shift has been updated successfully');

      
        return redirect()->route('Shifts');
    }

    public function destroy($id)
    {
        if ($id) {
            $shift = Shift::where('id', $id);
            $shift->delete();

            return redirect()->to('/shifts')->with('error','Shift Deleted successfully!');
        }
    }

    public function activate($id)
    {
       
       Shift::whereId($id)->update(
          ['status' => "1"]
       );
       return redirect()->to('/shifts')->with('success','Shift Enabled successfully!');
    }

    public function deactivate($id)
    {
       
       Shift::whereId($id)->update(
          ['status' => "0"]
       );
       return redirect()->to('/shifts')->with('warning','Shift Disabled successfully!');
    }

}
