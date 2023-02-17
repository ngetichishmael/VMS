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

    public $data, $name, $IdentificationType_edit_id;
    public $updateMode = false;

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';
        $types = IdentificationType::whereLike(['name', 'user.email'], $searchTerm)
            ->get();
        return view('livewire.identification-type.dashboard', ['types' => $types]);
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
  
        //Add Student Data
        $identificationType = new IdentificationType();
   
        $identificationType->name = $this->name;
    
        $identificationType->save();

        return redirect()->to('/identification/type');
    }

    public function editIdentityType($id)
    {
        $identificationType = IdentificationType::where('id', $id)->first();

        $this->IdentificationType_edit_id = $id;

        $this->name = $identificationType->name;
  
        $this->dispatchBrowserEvent('show-edit-identitype-modal');
    }

    public function editIdentityTypeData()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required|min:2',
        ]);

        $identificationType = IdentificationType::where('id', $this->IdentificationType_edit_id)->first();

        $identificationType->name = $this->name;
 
        $identificationType->save();

        session()->flash('message', 'Identification Type has been updated successfully');

      
        return redirect()->to('/identification/type');
    }

    public function destroy($id)
    {
        if ($id) {
            $identificationType = IdentificationType::where('id', $id);
            $identificationType ->delete();

            return redirect()->to('/identification/type');
        }
    }

    public function activate($id)
    {
       
        IdentificationType::whereId($id)->update(
          ['status' => "1"]
       );
       return redirect()->to('/identification/type');
    }

    public function deactivate($id)
    {
       
        IdentificationType::whereId($id)->update(
          ['status' => "0"]
       );
       return redirect()->to('/identification/type');
    }
}
