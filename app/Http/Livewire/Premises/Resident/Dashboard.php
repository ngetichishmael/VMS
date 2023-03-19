<?php

namespace App\Http\Livewire\Premises\Resident;

use Livewire\Component;

use App\Models\Resident;
use App\Models\Organization;
use App\Models\Unit;
use App\Models\Block;
use App\Models\Premise;
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

public $selectedPremise = null;
public $selectedBlock = null;
public $selectedUnit = null;
public $blocks = null;
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

        $premises = Premise::all();


        return view('livewire.premises.resident.dashboard', [ 
            'residents' => $residents, 
             'organizations' => $organizations,
              'premises' => $premises,
        ]);
    }

    // public function updatedSelectedBlock($block_id)
    // {
 
    //         $this->units = Unit::where('block_id', $block_id)->get();
          
    // }


  public function updatedSelectedPremise($premise_id)
{
$this->blocks = Block::where('premise_id', $premise_id)->get();
}

public function updatedSelectedBlock($block_id)
{
$this->units = Unit::where('block_id', $block_id)->get();
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