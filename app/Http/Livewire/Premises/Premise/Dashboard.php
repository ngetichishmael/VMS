<?php

namespace App\Http\Livewire\Premises\Premise;

use Livewire\Component;
use App\Models\Premise;
use App\Models\Organization;
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

    public $organizationId;

    public $address, $name,  $premise_edit_id, $location, $description;
    public $updateMode = false;

    public function render()
    {

        $searchTerm = '%' . $this->search . '%';

        $premises = Premise::with('organization')
            ->when($this->organizationId, function ($query) {
                $query->where('organization_code', $this->organizationId);
            })
            ->whereLike(['name','organization.name'], $searchTerm)
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);

            $organizations = Organization::where('status', 1) ->get();

        return view('livewire.premises.premise.dashboard', [
            'premises' => $premises,
            'organizations' => $organizations,
          
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:2',

            'organization_code' => 'required',

            'address' => 'required',

            'location' => 'required',
        
        ]);
  
        //Add Student Data
        $premise = new Premise();
   
        $premise->organization_code = $this->organization_code;

        $premise->name = $this->name;

        $premise->address = $this->address;

        $premise->location = $this->location;

        $premise->description = $this->description;
    
        $premise->save();

        return redirect()->route('PremiseInformation');
    }

    public function editPremise($id)
    {
        $premise = Premise::where('id', $id)->first();

        $this->premise_edit_id = $id;

        $this->name = $premise->name;
        $this->organization_code = $premise->organization_code;
        $this->location = $premise->location;
        $this->address = $premise->address;
        $this->description = $premise->name;

        $premises = Premise::with('organization') ->get();
  
        $this->dispatchBrowserEvent('show-edit-premise-modal');
    }

    public function editPremiseData()
    {

        $premise = Premise::where('id', $this->premise_edit_id)->first();

        $premise->name = $this->name;

        $premise->location = $this->location;

        $premise->address = $this->address;

        $premise->organization_code = $this->organization_code;

        $premise->description = $this->description;
 
        $premise->save();
      
        return redirect()->to('/premise/information')->with('success','Premise Updated successfully!');
    }

    public function destroy($id)
    {
        if ($id) {
            $premise = Premise::where('id', $id);
            $premise ->delete();

            return redirect()->to('/premise/information')->with('error','Premise Deleted successfully!');
        }
    }

    public function activate($id)
    {
       
        Premise::whereId($id)->update(
          ['status' => "1"]
       );
       return redirect()->to('/premise/information')->with('success','Premise Enabled successfully!');
    }

    public function deactivate($id)
    {
       
        Premise::whereId($id)->update(
          ['status' => "0"]
       );
       return redirect()->to('/premise/information')->with('warning','Premise Disabled successfully!');
    }
}