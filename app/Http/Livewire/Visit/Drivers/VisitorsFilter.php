<?php

namespace App\Http\Livewire\Visit\Drivers;

use App\Models\IdentificationType;
use App\Models\VisitorType;
use Livewire\Component;

class VisitorsFilter extends Component
{
    public $selectedVisitorTypeId;
    public $selectedIdentificationTypeId;

    public function mount()
    {
        $this->selectedVisitorTypeId = 0;
        $this->selectedIdentificationTypeId = 0;
    }

    public function render()
    {
        return view('livewire.visit.drivers.visitors-filter', [
            'visitorTypes' => VisitorType::all(),
            'identificationTypes' => IdentificationType::all()
        ]);
    }

    public function updatedSelectedVisitorTypeId()
    {
        $this->emit('visitorTypeIdSelected', $this->selectedVisitorTypeId);
    }

    public function updatedSelectedIdentificationTypeId()
    {
        $this->emit('identificationTypeIdSelected', $this->selectedIdentificationTypeId);
    }

}
