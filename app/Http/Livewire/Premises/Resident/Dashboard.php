<?php

namespace App\Http\Livewire\Premises\Resident;

use Livewire\Component;

use App\Models\Resident;
use App\Models\Organization;
use App\Models\Unit;
use App\Models\Block;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    public $unitId;
    public $userdetailId;

    public  $name, $email, $phone_number, $unit_id, $password, $organization_id;

    public $selectedBlock = null;
    public $selectedUnit = null;
    public $units = null;

    public function render()
    {
    
        $searchTerm = '%' . $this->search . '%';

        $residents = Resident::with('unit','user_detail')
            ->when($this->unitId, function ($query) {
                $query->where('unit_id', $this->unitId);
            })
            ->when($this->userdetailId, function ($query) {
                $query->where('user_detail_id', $this->userdetailId);
            })
            ->whereLike(['name','unit.name','user_detail.name'], $searchTerm)
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);

        $organizations = Organization::all();

        $blocks = Block::all();

        $units = Unit::all();


        return view('livewire.premises.resident.dashboard', [ 
            'residents' => $residents, 
             'organizations' => $organizations,
            //  'units' => $units,
              'blocks' => $blocks,
        ]);
    }

    public function updatedSelectedBlock($block_id)
    {
        $this->units = Unit::where('id', $block_id)->get();
    }


    private function resetInput()
    {
        $this->name = null;
        $this->email = null;
        $this->location = null;
        $this->primary_phone = null;
        $this->secondary_phone = null;
        $this->websiteUrl = null;
        $this->description = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:2',

            'email' => 'required|email|max:255|unique:organizations,email',

            'phone_number'=> 'required|numeric',


        ]);

        $resident = new Resident;

        $resident->name = $this->name;

        $resident->email = $this->email;

        $resident->phone_number  = $this->phone_number;

        $resident->unit_id  = $this->unit_id;


        $resident->save();
  
        $this-> resetInput();

        return redirect()->route('ResidentInformation');
    }

    public function editresident($id)
    {
        
        $resident  = Resident::where('id', $id)->first();

        $this->resident_edit_id = $id;

        $this->name = $resident ->name;

        $this->email = $resident->email;

        $this->phone_number =  $resident->phone_number;

        $this->unit_id = $resident->unit_id;

  

        $this->dispatchBrowserEvent('show-edit-org-modal');
    }

    public function editresidentData()
    {
 
        $resident  = Resident::where('id', $this->resident_edit_id)->first();

        $resident ->name = $this->name;
        $resident->email = $this->email;
        $resident->phone_number = $this->phone_number;
        $resident->unit_id  = $this->unit_id;
      

        $resident->save();

        return redirect()->route('ResidentInformation');
    }

    public function destroy($id)
    {
        if ($id) {
            $resident = Resident::where('id', $id);
            $resident ->delete();

            return redirect()->to('/resident/information')->with('error','Resident Deleted successfully!');
        }
    }

    public function activate($id)
    {
       
        Resident::whereId($id)->update(
          ['status' => "1"]
       );
       return redirect()->to('/resident/information')->with('success','Resident Enabled successfully!');
    }

    public function deactivate($id)
    {
       
       Resident::whereId($id)->update(
          ['status' => "0"]
       );
       return redirect()->to('/resident/information')->with('warning','Resident Disabled successfully!');
    }
}