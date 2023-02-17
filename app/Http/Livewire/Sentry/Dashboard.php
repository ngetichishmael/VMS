<?php

namespace App\Http\Livewire\Sentry;

use Livewire\Component;
use App\Models\Sentry;
use App\Models\Organization;
use App\Models\Shift;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 40;
    public $sortField = 'id';
    public $sortAsc = true;
    public ?string $search = null;
    public function render()
    {
        $this->sentries = Sentry::join('user_details', 'sentries.user_detail_id', '=', 'user_details.id')
       
        ->join('shifts', 'sentries.shift_id', '=', 'shifts.id')

        ->select('sentries.*', 'user_details.ID_number','user_details.phone_number', 'user_details.company','shifts.name AS shiftname')
        
        ->get();

        $searchTerm = '%' . $this->search . '%';

        $sentries = Sentry::whereLike(['name', ], $searchTerm)

        ->get();

        $organizations = Organization::select(['id','name'])

        ->get();

        $shifts = Shift::select(['id','name'])

        ->get();

        return view('livewire.sentry.dashboard', [
            'sentries' => $sentries,
            'organizations' => $organizations,
            'shifts' => $shifts,
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
