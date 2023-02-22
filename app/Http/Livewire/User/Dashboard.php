<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Organization;
use App\Models\Role;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

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
    public $location;
    public $primary_phone;
    public $secondary_phone;
    public $websiteUrl;
    public $description;
    public $roleId;
    public $organizationId;
    public $organization_edit_id;

    public  $name, $email, $phone_number, $role_id, $password, $organization_id;


    public function render()
    {

        $searchTerm = '%' . $this->search . '%';

        $users = User::with('organization', 'role')
            ->when($this->organizationId, function ($query) {
                $query->where('organization_id', $this->organizationId);
            })
            ->when($this->roleId, function ($query) {
                $query->where('role_id', $this->roleId);
            })
            ->whereLike(['name', 'organization.name', 'role.name'], $searchTerm)
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);

        $organizations = Organization::all();

        $roles = Role::all();


        return view('livewire.user.dashboard', [
            'users' => $users,
            'organizations' => $organizations,
            'roles' => $roles,
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

            'phone_number' => 'required|numeric',

            'organization_id' => 'required|numeric',

            'role_id' => 'required|numeric',

        ]);

        // if ($this->validator->fails()) {
        //     return response()->json(['error' => $this->validator->errors()], 400);
        // }

        $user = new User;

        $user->name = $this->name;

        $user->email = $this->email;

        $user->phone_number  = $this->phone_number;

        $user->organization_id  = $this->organization_id;

        $user->role_id  = $this->role_id;

        $user->password = Hash::make($this->password);


        $user->save();

        $this->resetInput();

        return redirect()->route('OrganizationUsers');
    }

    public function editOrganization($id)
    {

        $organization  = Organization::where('id', $id)->first();

        $this->organization_edit_id = $id;

        $this->name = $organization->name;

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
            'primary_phone' => 'required|numeric',
            'location' => 'required',
        ]);

        $organization  = Organization::where('id', $this->organization_edit_id)->first();

        $organization->name = $this->name;
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
            $user = User::where('id', $id);
            $user->delete();

            return redirect()->to('/organization/users');
        }
    }

    public function activate($id)
    {

        User::whereId($id)->update(
            ['status' => "1"]
        );
        return redirect()->to('/organization/users');
    }

    public function deactivate($id)
    {

        User::whereId($id)->update(
            ['status' => "0"]
        );
        return redirect()->to('/organization/users');
    }
}
