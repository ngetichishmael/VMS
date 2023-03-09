@php
    use Carbon\Carbon;
@endphp

<div>

            <div class="card" >


                <h5 class="card-header">Search Filter</h5>
                <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">

                <div class="col-md-5">
                        <div class="form-group">
                            <label for="selectSmall"> Visitor Type </label>
                            <select  wire:model="visitorTypeId" class="form-control form-control-sm" >
                                <option value="">  All  </option>
                                @foreach($visitorTypes as $type)
                                  <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="selectSmall">Time</label>
                            <select wire:model="timeFilter" wire:change="applyTimeFilter" class="form-control form-control-sm" >
                              <option value="all">Select Time Duration </option>
                              <option value="daily">Daily</option>
                              <option value="weekly">Weekly</option>
                              <option value="monthly">Monthly</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 user_role">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search"></i></span>
                            </div>
                            <input wire:model.debounce.300ms="search"  type="search" id="search" class="form-control" name="search"
                              placeholder="Search" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="selectSmall">Select Per Page</label>
                            <select wire:model="perPage" class="form-control form-control-sm" id="selectSmall" id="table1">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- users filter end -->
            {{-- @include('partials.loaderstyle') --}}


            @include('livewire.Notification.flash-message')

            <!-- list section start -->
            <div class="card">

                <div class="pt-0 card-datatable table-responsive">
                    <div class="card-datatable table-responsive">



                    <table class="table">
                    <thead>
                            <tr>
{{--                                <th wire:click="sortBy('id')">ID--}}
{{--                                    @if ($sortField === 'id')--}}
{{--                                        @if ($sortAsc)--}}
{{--                                            <i class="fas fa-sort-up"></i>--}}
{{--                                        @else--}}
{{--                                            <i class="fas fa-sort-down"></i>--}}
{{--                                        @endif--}}
{{--                                    @endif--}}
{{--                                </th>--}}

                                <th>Name</th>
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
                                    <td>{!! $visitor->timeLog->entry_time ?? '-' !!}</td>
                                    @if (!isset($visitor->timeLog->exit_time))
                                        <td>...</td>
                                        <td> <span class="mr-1 badge badge-pill badge-light-primary">Visit Active</span> </td>
                                    @else
                                        <td>{!! $visitor->timeLog->exit_time!!}</td>
                                        <td >
                                        <span class="mr-1 badge badge-pill badge-light-dark">
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

                        <div style="margin-left: 80%"  class="mt-1">{{ $dvisitors->links() }}
                        </div>

                    </div>
                </div>

        </div>






