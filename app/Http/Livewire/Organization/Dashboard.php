<?php

namespace App\Http\Livewire\Organization;

use Livewire\Component;
use App\Models\Organization;
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
      
        $searchTerm = '%' . $this->search . '%';

        $organizations = Organization::whereLike(['name'], $searchTerm)

        ->get();
   
        return view('livewire.organization.dashboard', [
            'organizations' => $organizations ,
        ]);
    }

    public  $name, $email;

    public function StoreOrganization()
    {
        //on form submit validation
        $this->validate([
          
            'name' => 'required',
            'email' => 'required|email',
         
        ]);

        //Add org Data
        $organization = new Organization();
    
        $organization->name = $this->name;
        $organization->email = $this->email;

        $organizationt->save();

        session()->flash('message', 'New Organization has been added successfully');

     
        $this->name = '';
        $this->email = '';
     

        // //For hide modal after add  success
        // $this->dispatchBrowserEvent('close-modal');
        return redirect()->to('/organization/information');

    }
}
