<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\DriveIn;
use App\Models\Visitor;
use App\Models\WalkIn;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $userAccountType = $user->role_id;
        if ($userAccountType===1) {
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
        elseif ($userAccountType===2) {
            $organization_code = Auth::user()->organization_code;
            $allTypes = DriveIn::whereHas('resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                $query->where('code', $organization_code);
            })->orderBy('id', 'desc')->paginate($this->perPageAll);
            $WalkIn = WalkIn::select("*")->where('type', 'WalkIn')
                ->whereHas('resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                    $query->where('code', $organization_code);
                })
                ->orderBy('id', 'desc')->paginate($this->perPageWalkInAll);
            $DriveIn =DriveIn::select("*")->where('type', 'DriveIn')
                ->whereHas('resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                    $query->where('code', $organization_code);
                })
                ->orderBy('id', 'desc')->paginate($this->perPageDriveInAll);
            $Sms = DriveIn::select("*")->where('type', 'Sms')
                ->whereHas('resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                    $query->where('code', $organization_code);
                })
                ->orderBy('id', 'desc')->paginate($this->perPageSmsAll);
            $Id = DriveIn::select("*")->where('type', 'ID')
                ->whereHas('resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                    $query->where('code', $organization_code);
                })
                ->orderBy('id', 'desc')->paginate($this->perPageSmsAll);
            //        $female = Visitor::where('user_details.gender', 'female')->count();
            //        $male = Visitor::where('user_details.gender', 'male')->count();

//            $allTypes = Visitor::with(['vehicle', 'timeLogs', 'resident.unit.block.premise.organization'])
//                ->join('resident', 'visitors.resident_id', '=', 'residents.id')
//                ->join('units', 'residents.unit_id', '=', 'units.id')
//                ->join('blocks', 'units.block_id', '=', 'blocks.id')
//                ->join('premises', 'blocks.premise_id', '=', 'premises.id')
//                ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
//                ->where('organizations.code', $organization_code)
//                ->orderBy('visitors.id', 'desc')
//                ->paginate($this->perPageAll);
//
//            $WalkIn = WalkIn::with(['vehicle', 'timeLogs', 'resident.unit.block.premise.organization'])
//                ->join('residents', 'visitors.resident_id', '=', 'residents.id')
//                ->join('units', 'residents.unit_id', '=', 'units.id')
//                ->join('blocks', 'units.block_id', '=', 'blocks.id')
//                ->join('premises', 'blocks.premise_id', '=', 'premises.id')
//                ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
//                ->where('organizations.code', $organization_code)
//                ->where('type', 'WalkIn')
//                ->orderBy('visitors.id', 'desc')
//                ->paginate($this->perPageWalkInAll);
//
//            $DriveIn = DriveIn::with(['vehicle', 'timeLogs', 'resident.unit.block.premise.organization'])
//                ->join('residents', 'visitors.resident_id', '=', 'residents.id')
//                ->join('units', 'residents.unit_id', '=', 'units.id')
//                ->join('blocks', 'units.block_id', '=', 'blocks.id')
//                ->join('premises', 'blocks.premise_id', '=', 'premises.id')
//                ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
//                ->where('organizations.code', $organization_code)
//                ->where('type', 'DriveIn')
//                ->orderBy('visitors.id', 'desc')
//                ->paginate($this->perPageDriveInAll);
//
//            $Sms = Visitor::with(['vehicle', 'timeLogs', 'resident.unit.block.premise.organization'])
//                ->join('residents', 'visitors.resident_id', '=', 'residents.id')
//                ->join('units', 'residents.unit_id', '=', 'units.id')
//                ->join('blocks', 'units.block_id', '=', 'blocks.id')
//                ->join('premises', 'blocks.premise_id', '=', 'premises.id')
//                ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
//                ->where('organizations.code', $organization_code)
//                ->where('type', 'Sms')
//                ->orderBy('visitors.id', 'desc')
//                ->paginate($this->perPageSmsAll);
//            $Id = Visitor::with(['vehicle', 'timeLogs', 'resident.unit.block.premise.organization'])
//                ->join('residents', 'visitors.resident_id', '=', 'residents.id')
//                ->join('units', 'residents.unit_id', '=', 'units.id')
//                ->join('blocks', 'units.block_id', '=', 'blocks.id')
//                ->join('premises', 'blocks.premise_id', '=', 'premises.id')
//                ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
//                ->where('organizations.code', $organization_code)
//                ->where('type', 'ID')
//                ->orderBy('visitors.id', 'desc')
//                ->paginate($this->perPageSmsAll);

            return view('livewire.dashboard.dashboard', [
                'allTypes' => $allTypes,
                "WalkIn" => $WalkIn,
                "DriveIn" => $DriveIn,
                "Sms" => $Sms,
                "Id" => $Id,
            ]);
        }
        }
}
