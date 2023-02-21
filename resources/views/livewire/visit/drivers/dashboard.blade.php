<div class="row mb-6 m-1">
    <label style="color: #070707" ><h3>Filter By:</h3></label>
    <div class="col-md-5">
        <label  style="color: #070707"><h6> Visitor Type </h6></label>
        <select class="form-select form-control" wire:model="visitorTypeId">
            <option value="">      All       </option>
            @foreach($visitorTypes as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>
{{--    <div class="col-md-5">--}}
{{--        <label  style="color: #070707"><h6>Organization </h6></label> &nbsp;&nbsp;--}}
{{--        <select class="form-select" wire:model="organizationCodeId">--}}
{{--            <option value="">           All                 </option>--}}
{{--            @foreach($organizationCodes as $type)--}}
{{--                <option value="{{ $type->id }}">{{ $type->name }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}
        <div class="col-md-5">
        <label  style="color: #070707"><h6> Time </h6></label> &nbsp;&nbsp;
            <select class="form-control" name="time_filter" id="time_filter" wire:model="timeFilter">
                <option value="">Select Time Filter </option>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>
    </div>
    <hr/>
<div>


    <div class="card">
        <h5 class="card-header">Search Filter</h5>
        <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
            <div class="col-md-4 user_role">
                <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i data-feather="search"></i></span>
                    </div>
                    <input wire:model="search" type="text" id="fname-icon" class="form-control" name="fname-icon"
                           placeholder="Search" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="selectSmall">Select Per Page</label>
                    <select class="form-control form-control-sm" id="selectSmall">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="sort_time">Sort by Time:</label>
                    <select wire:model="sortTimeField" class="form-control form-control-sm" id="sort_time">
                        <option value="time">Ascending</option>
                        <option value="time_desc">Descending</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
    <!-- users filter end -->
    {{-- @include('partials.loaderstyle') --}}
    <!-- list section start -->
    <div class="card">
        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead style="color: #070707">
                    <tr>
                        <th wire:click="sortBy('id')">ID
                            @if($sortField === 'id')
                                @if($sortAsc)
                                    <i class="fas fa-sort-up"></i>
                                @else
                                    <i class="fas fa-sort-down"></i>
                                @endif
                            @endif
                        </th>
                        <th>Vehicle Reg</th>
                        <th wire:click="sortBy('name')">Name
                            @if($sortField === 'name')
                                @if($sortAsc)
                                    <i class="fas fa-sort-up"></i>
                                @else
                                    <i class="fas fa-sort-down"></i>
                                @endif
                            @endif
                        </th>
                        <th>Site</th>
                        <th>Section</th>
                        <th>Organization</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <style>
                        .option{
                            color: #0c0c0c;
                        }

                        .dropdown {
                            display: inline-block;
                            position: relative;
                        }

                        .dropdown-toggle {
                            cursor: pointer;
                            color: darkgray;
                        }

                        .dropdown-menu {
                            position: absolute;
                            top: 100%;
                            right: 0;
                            display: none;
                            background-color: #fff;
                            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                            z-index: 1;
                        }

                        .dropdown-menu a {
                            color: #333;
                            padding: 12px 16px;
                            text-decoration: none;
                            display: block;
                        }

                        .dropdown-menu a:hover {
                            background-color: #f1f1f1;
                        }

                        .dropdown:hover .dropdown-menu {
                            display: block;
                        }
                        th, td {
                            text-align: left;
                        }

                        tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }

                    </style>
                    <tbody style="font-size: small">
                    @forelse($dvisitors as $key => $visitor)
                        <tr>
                            <td>{{ $visitor->id }}</td>
                            <td>{!! $visitor->vehicle()->pluck("registration")->implode('')!!} </td>
                            <td>{!! $visitor->name!!} </td>
                            <td>{{ $visitor->resident->unit->block ? $visitor->resident->unit->block->premise->name : '' }}</td>
                            <td>{!! $visitor->resident->unit->name !!}</td>
                            <td>{!! $visitor->resident->unit->block->premise->organization()->pluck("name")->implode('') !!}</td>
                            <td>{!! $visitor->timeLogs->entry_time !!}</td>
                            @if($visitor->timeLogs->exit_time=='0000-00-00 00:00:00' || $visitor->timeLogs->exit_time=='' || $visitor->timeLogs->exit_time==null)
                                <td>...</td>
                                <td style="color: orange;"> Visitor Still in</td>
                            @else
                                <td>{!! $visitor->timeLogs->exit_time !!}</td>
                                <td style="color: #70ce52;">{!! $visitor->duration !!}</td>
                            @endif
                            <td >
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('VisitDriveIn.show', $visitor->id) }}">View Details</a>
                                        <a href="#">View History</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" style="padding-left: 40%">No Drive In Records Found!... </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="mt-1">{{ $dvisitors->links() }}
                </div>
            </div>
        </div>
    </div>
