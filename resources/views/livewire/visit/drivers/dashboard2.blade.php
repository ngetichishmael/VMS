@php
    use Carbon\Carbon;
@endphp
<div>
<div class="row">
    <label style="color: #070707">
        <h3>Filter By:</h3>
    </label>
    <div class="col-md-5">
        <label style="color: #070707">
            <h5> Visitor Type </h5>
        </label>
        <select class="form-control form-select" wire:model="visitorTypeId">
            <option value="">All </option>
            @foreach ($visitorTypes as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-5">
        <label style="color: #070707">
            <h6> Time </h6>
        </label> &nbsp;&nbsp;
        <select class="form-control form-select" wire:model="timeFilter" wire:change="applyTimeFilter">
            <option value="all">Select Time Duration </option>
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
        </select>
    </div>
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
                        <select class="form-control form-control-sm form-select" id="selectSmall" wire:model="perPage">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="sortTimeAsc">Sort By Time:</label>
                    <select wire:model="sortTimeAsc" class="form-control form-select">
                        <option value="1">Ascending</option>
                        <option value="0">Descending</option>
                    </select>
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
                                <th >Name</th>
                                    <th>Vehicle Reg</th>
                                <th>Site</th>
                                <th>Section</th>
                                <th>Organization</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody style="font-size: small">
                            @forelse($dvisitors as $key => $visitor)
                                <tr>
{{--                                    <td>{{ $visitor->id }}</td>--}}
                                    <td>{!! $visitor->name !!} </td>
                                    <td>{!! $visitor->vehicle()->pluck('registration')->implode('') !!} </td>
                                    <td>{{ $visitor->Resident->unit->block->premise->name ?? ' Not Found' }}</td>
                                    <td>{!! $visitor->Resident->unit->name !!}</td>
                                    <td>{!! $visitor->Resident->unit->block->premise->organization->name ?? 'Not Found' !!}</td>
                                    <td>{!! $visitor->timeLog->entry_time ?? null !!}</td>
                                    @if (!isset($visitor->timeLog->exit_time))
                                        <td>...</td>
                                        <td> <span class="badge badge-pill badge-light-primary mr-1">Visit Active</span> </td>
                                    @else
                                        <td>{!! $visitor->timeLog->exit_time!!}</td>
                                        <td >
                                        <span class="badge badge-pill badge-light-dark mr-1">
                                        {!! Carbon::parse($visitor->timeLog->entry_time ?? now())->diff(Carbon::parse($visitor->timeLog->exit_time ?? now()))->format('%H Hrs %I Mins '); !!}
                                        </span>
                                    </td>

                                    @endif
                                    <td>
{{--                                        <div class="dropdown">--}}
{{--                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"--}}
{{--                                                role="button" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                <i class="fas fa-ellipsis-v"></i>--}}
{{--                                            </a>--}}
{{--                                            <div class="dropdown-menu">--}}
                                                <a href="{{ route('VisitDriveIn.show', ['DriveIn' => $visitor->id ?? '']) }}">
                                                <i class="fa fa-eye" style="color:#808080">  </i></a>
{{--                                                <a href="#">View History</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
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
    </div>
</div>
</div>
<style>
    .option {
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
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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

    th,
    td {
        text-align: left;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
