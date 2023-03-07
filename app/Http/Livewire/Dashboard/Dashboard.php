<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Visitor;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPageAll = 10;
    public $perPageWalkInAll = 10;
    public $perPageDriveInAll = 10;
    public $perPageIdAll = 10;
    public $perPageSmsAll = 10;
    public function render()
    {
        $allTypes = Visitor::orderBy('id', 'desc')->paginate($this->perPageAll);
        $WalkIn = Visitor::select("*")->where('type', 'WalkIn')->orderBy('id', 'desc')->paginate($this->perPageWalkInAll);
        $DriveIn = Visitor::select("*")->where('type', 'DriveIn')->orderBy('id', 'desc')->paginate($this->perPageDriveInAll);
        $Sms = Visitor::select("*")->where('type', 'Sms')->orderBy('id', 'desc')->paginate($this->perPageSmsAll);
        $Id = Visitor::select("*")->where('type', 'ID')->orderBy('id', 'desc')->paginate($this->perPageSmsAll);
        //        $female = Visitor::where('user_details.gender', 'female')->count();
        //        $male = Visitor::where('user_details.gender', 'male')->count();
        return view('livewire.dashboard.dashboard', [
            'allTypes' => $allTypes,
            "WalkIn" => $WalkIn,
            "DriveIn" => $DriveIn,
            "Sms" => $Sms,
            "Id" => $Id,
        ]);
    }
}
