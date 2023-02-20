<?php

namespace App\Http\Livewire\Sentry;

use Livewire\Component;
use App\Models\Sentry;
use App\Models\Device;
use App\Models\Organization;
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

    public  $name, $email, $phone_number, $role_id, $password, $organization_id;



    public function render()
    {
  

        $searchTerm = '%' . $this->search . '%';

        $sentries = Sentry::with('user_detail','shift','device')
            ->when($this->userDetailsId, function ($query) {
                $query->where('user_detail_id', $this->userDetailsId);
            })
            ->when($this->shiftId, function ($query) {
                $query->where('shift_id', $this->shiftId);
            })
            ->whereLike(['name','user_detail.ID_number','user_detail.phone_number', 'user_detail.company','shift.name','device.identifier'], $searchTerm)
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);

        $organizations = Organization::all();

        $shifts = Shift::all();

        $devices = Device::all();

        return view('livewire.sentry.dashboard', [
            'sentries' => $sentries,
            'organizations' => $organizations,
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

            'email' => 'required|email|max:255|unique:organizations,email',

            'phone_number'=> 'required|numeric',

            ''=> 'required|numeric',

            'organization_id' => 'required',

            'role_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $code = Str::random(20);

        $user = new User;

        $user->name = $this->name;

        $user->email = $this->email;

        $user->phone_number  = $this->phone_number;

        $user->organization_id  = $this->organization_id;

        $user->role_id  = $this->role_id;

        $user->password = Hash::make($this->password);

      if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $user->save();
  

        return redirect()->route('OrganizationUsers');
    }

    public function editOrganization($id)
    {
        
        $organization  = Organization::where('id', $id)->first();

        $this->organization_edit_id = $id;

        $this->name = $organization ->name;

        $this->location = $organization->location;

        $this->email =  $organization->email;

        $this->primary_phone = $organization->primary_phone;

        $this->secondary_phone = $organization->secondary_phone;

        $this->websiteUrl = $organization->websiteUrl;

        $this->description = $organization->description; 

        $this->dispatchBrowserEvent('show-edit-org-modal');
    }

    public function editOrganizationData()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|max:255|unique:organizations,email',
            'primary_phone'=> 'required|numeric',
            'location' => 'required',
        ]);

        $organization  = Organization::where('id', $this->organization_edit_id)->first();

        $organization ->name = $this->name;
        $organization->location = $this->location;
        $organization->email = $this->email;
        $organization->primary_phone  = $this->primary_phone;
        $organization->secondary_phone  = $this->secondary_phone;
        $organization->websiteUrl  = $this->websiteUrl;
        $organization->description = $this->description;
        $organization->save();

        session()->flash('message', 'Organization has been updated successfully');

      
        return redirect()->route('OrganizationUsers');
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
