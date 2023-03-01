<?php

namespace App\Http\Livewire\Service\Catergory;

use Livewire\Component;
use App\Models\ServiceCategory;
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

    public $data, $name, $category_edit_id;
    public $updateMode = false;

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';

        $categories = ServiceCategory::whereLike(['name'], $searchTerm)
            ->orderBy($this->orderBy, $this->orderAsc ? 'desc' : 'asc')
            ->paginate($this->perPage);

        return view('livewire.service.catergory.dashboard', ['categories' => $categories]);
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
  
        ServiceCategory::create([
            'name' => $this->name,
        ]);
        $this->resetInput();

        return redirect()->route('ServiceCategory');
    }

    public function editCategory($id)
    {
        $category  = ServiceCategory::where('id', $id)->first();

        $this->category_edit_id = $id;

        $this->name = $category ->name;
  
        $this->dispatchBrowserEvent('show-edit-category-modal');
    }

    public function editCategoryData()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required|min:2',
        ]);

        $category  = ServiceCategory::where('id', $this->category_edit_id)->first();

        $category ->name = $this->name;
 
        $category ->save();

        session()->flash('message', 'category  has been updated successfully');

      
        return redirect()->route('ServiceCategory');
    }

    public function destroy($id)
    {
        if ($id) {
            $category = ServiceCategory::where('id', $id);
            $category ->delete();

            return redirect()->to('/service/category');
        }
    }

    public function activate($id)
    {
       
        ServiceCategory::whereId($id)->update(
          ['status' => "1"]
       );
       return redirect()->to('/service/category');
    }

    public function deactivate($id)
    {
       
        ServiceCategory::whereId($id)->update(
          ['status' => "0"]
       );
       return redirect()->to('/service/category');
    }
}
