<?php

namespace App\Http\Livewire\Sentry;

use Livewire\Component;
use App\Models\Sentry;
use App\Models\Device;
use App\Models\Premise;
use App\Models\Shift;
use Livewire\WithPagination;

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

    public $userDetailsId;
    public $shiftId;

    public  $name, $email, $phone_number, $shift_id, $device_id, $premise_id;



    public function render()
    {
  

        $searchTerm = '%' . $this->search . '%';

        $sentries = Sentry::with('user_detail','shift','device','premise')
            ->when($this->userDetailsId, function ($query) {
                $query->where('user_detail_id', $this->userDetailsId);
            })
            ->when($this->shiftId, function ($query) {
                $query->where('shift_id', $this->shiftId);
            })
            ->whereLike(['name','user_detail.ID_number','user_detail.phone_number', 'user_detail.company','shift.name','device.identifier','premise.name'], $searchTerm)
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);

        $premises = Premise::all();

        $shifts = Shift::all();

        $devices = Device::all();

        return view('livewire.sentry.dashboard', [
            'sentries' => $sentries,
            'premises' => $premises,
            'shifts' => $shifts,
            'devices' => $devices,
        ]);
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

        

            'device_id'=> 'required',

            'premise_id' => 'required',

            'shift_id' => 'required',

        ]);


   
        $sentry = new Sentry;

        $sentry->name = $this->name;

   

        $sentry->premise_id  = $this->premise_id;

        $sentry->shift_id  = $this->shift_id;

        $sentry->device_id  = $this->device_id;

        $sentry->save();
  

        return redirect()->route('Sentry');
    }

    public function editSentry($id)
    {
        
        $sentry  = Sentry::where('id', $id)->first();

        $this->sentry_edit_id = $id;

        $this->name = $sentry ->name;

        $this->premise_id = $sentry->premise_id;

        $this->shift_id =  $sentry->shift_id;

        $this->device_id = $sentry->device_id;

        $this->dispatchBrowserEvent('show-edit-sentry-modal');
    }

    public function editsentryData()
    {

        $sentry  = Sentry::where('id', $this->sentry_edit_id)->first();

        $sentry ->name = $this->name;
        $sentry->premise_id = $this->premise_id;
        $sentry->shift_id = $this->shift_id;
        $sentry->device_id  = $this->device_id;
 
        $sentry->save();

        return redirect()->route('Sentry');
    }

    public function destroy($id)
    {
        if ($id) {
            $sentry = Sentry::where('id', $id);
            $senry ->delete();

            return redirect()->to('/users/sentries');
        }
    }

    public function activate($id)
    {
       
       Sentry::whereId($id)->update(
          ['status' => "1"]
       );
       return redirect()->to('/users/sentries');
    }

    public function deactivate($id)
    {
       
       Sentry::whereId($id)->update(
          ['status' => "0"]
       );
       return redirect()->to('/users/sentries');
    }

}
