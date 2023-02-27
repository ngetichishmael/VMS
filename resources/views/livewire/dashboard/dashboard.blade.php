<section class="app-user-list">
    <div class="card">
        <h5 class="card-header">All Latest Drive-Ins</h5>
        <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="selectSmall">Select Per Page</label>
                    <select wire:model='perPageAll' class="form-control form-control-sm" id="selectSmall">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead style="color: #070707">
                        <tr>
                            <th>Name</th>
                            <th>Resident Name</th>
                            <th>Guard</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: small">
                        @forelse($allTypes as $key => $visitor)
                            <tr>
                                <td>{!! $visitor->name !!} </td>
                                <td>{!! $visitor->resident2->name !!} </td>
                                <td>{!! $visitor->sentry->name !!} </td>
                                <td>{!! $visitor->timeLog->exit_time ?? 'Null' !!} </td>
                                <td>{!! $visitor->timeLog->entry_time ?? 'Still Within' !!} </td>
                                @if ($visitor->timeLog->entry_time === null)
                                    @php
                                        $duration = 'Visitor Still Within the Premise';
                                    @endphp
                                @else
                                    @php
                                        
                                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->exit_time);
                                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->entry_time);
                                        $duration = $to->longAbsoluteDiffForHumans($from);
                                    @endphp
                                @endif
                                <td>
                                    {{ $duration }}
                                </td>
                                <td>
                                    <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}"><i
                                            class="fa fa-eye">&nbsp;Details</i></a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="padding-left: 40%">No Records Found!... </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-1">
                    {{ $allTypes->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<section class="app-user-list">
    <div class="card">
        <h5 class="card-header">Latest Drive-Ins</h5>
        <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="selectSmall">Select Per Page</label>
                    <select wire:model='perPageDriveInAll' class="form-control form-control-sm" id="selectSmall">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead style="color: #070707">
                        <tr>
                            <th>Name</th>
                            <th>Resident Name</th>
                            <th>Guard</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: small">
                        @forelse($DriveIn as $key => $visitor)
                            <tr>
                                <td>{!! $visitor->name !!} </td>
                                <td>{!! $visitor->resident2->name !!} </td>
                                <td>{!! $visitor->sentry->name !!} </td>
                                <td>{!! $visitor->timeLog->exit_time ?? 'Null' !!} </td>
                                <td>{!! $visitor->timeLog->entry_time ?? 'Still Within' !!} </td>
                                @if ($visitor->timeLog->entry_time === null)
                                    @php
                                        $duration = 'Visitor Still Within the Premise';
                                    @endphp
                                @else
                                    @php
                                        
                                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->exit_time);
                                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->entry_time);
                                        $duration = $to->longAbsoluteDiffForHumans($from);
                                    @endphp
                                @endif
                                <td>
                                    {{ $duration }}
                                </td>
                                <td>
                                    <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}"><i
                                            class="fa fa-eye">&nbsp;Details</i></a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="padding-left: 40%">No Records Found!... </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-1">
                    {{ $allTypes->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<section class="app-user-list">
    <div class="card">
        <h5 class="card-header">Latest Walk-Ins</h5>
        <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="selectSmall">Select Per Page</label>
                    <select wire:model='perPageWalkInAll' class="form-control form-control-sm" id="selectSmall">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead style="color: #070707">
                        <tr>
                            <th>Name</th>
                            <th>Resident Name</th>
                            <th>Guard</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: small">
                        @forelse($WalkIn as $key => $visitor)
                            <tr>
                                <td>{!! $visitor->name !!} </td>
                                <td>{!! $visitor->resident2->name !!} </td>
                                <td>{!! $visitor->sentry->name !!} </td>
                                <td>{!! $visitor->timeLog->exit_time ?? 'Null' !!} </td>
                                <td>{!! $visitor->timeLog->entry_time ?? 'Still Within' !!} </td>
                                @if ($visitor->timeLog->entry_time === null)
                                    @php
                                        $duration = 'Visitor Still Within the Premise';
                                    @endphp
                                @else
                                    @php
                                        
                                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->exit_time);
                                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->entry_time);
                                        $duration = $to->longAbsoluteDiffForHumans($from);
                                    @endphp
                                @endif
                                <td>
                                    {{ $duration }}
                                </td>
                                <td>
                                    <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}"><i
                                            class="fa fa-eye">&nbsp;Details</i></a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="padding-left: 40%">No Records Found!... </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-1">
                    {{ $WalkIn->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<section class="app-user-list">
    <div class="card">
        <h5 class="card-header">Latest SMS-Ins</h5>
        <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="selectSmall">Select Per Page</label>
                    <select wire:model='perPageSmsAll' class="form-control form-control-sm" id="selectSmall">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead style="color: #070707">
                        <tr>
                            <th>Name</th>
                            <th>Resident Name</th>
                            <th>Guard</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: small">
                        @forelse($Sms as $key => $visitor)
                            <tr>
                                <td>{!! $visitor->name !!} </td>
                                <td>{!! $visitor->resident2->name !!} </td>
                                <td>{!! $visitor->sentry->name !!} </td>
                                <td>{!! $visitor->timeLog->exit_time ?? 'Null' !!} </td>
                                <td>{!! $visitor->timeLog->entry_time ?? 'Still Within' !!} </td>
                                @if ($visitor->timeLog->entry_time === null)
                                    @php
                                        $duration = 'Visitor Still Within the Premise';
                                    @endphp
                                @else
                                    @php
                                        
                                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->exit_time);
                                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->entry_time);
                                        $duration = $to->longAbsoluteDiffForHumans($from);
                                    @endphp
                                @endif
                                <td>
                                    {{ $duration }}
                                </td>
                                <td>
                                    <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}"><i
                                            class="fa fa-eye">&nbsp;Details</i></a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="padding-left: 40%">No Records Found!... </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-1">
                    {{ $Sms->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<section class="app-user-list">
    <div class="card">
        <h5 class="card-header">Latest ID Check-Ins</h5>
        <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="selectSmall">Select Per Page</label>
                    <select wire:model='perPageAll' class="form-control form-control-sm" id="selectSmall">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead style="color: #070707">
                        <tr>
                            <th>Name</th>
                            <th>Resident Name</th>
                            <th>Guard</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: small">
                        @forelse($Id as $key => $visitor)
                            <tr>
                                <td>{!! $visitor->name !!} </td>
                                <td>{!! $visitor->resident2->name !!} </td>
                                <td>{!! $visitor->sentry->name !!} </td>
                                <td>{!! $visitor->timeLog->exit_time ?? 'Null' !!} </td>
                                <td>{!! $visitor->timeLog->entry_time ?? 'Still Within' !!} </td>
                                @if ($visitor->timeLog->entry_time === null)
                                    @php
                                        $duration = 'Visitor Still Within the Premise';
                                    @endphp
                                @else
                                    @php
                                        
                                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->exit_time);
                                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->entry_time);
                                        $duration = $to->longAbsoluteDiffForHumans($from);
                                    @endphp
                                @endif
                                <td>
                                    {{ $duration }}
                                </td>
                                <td>
                                    <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}"><i
                                            class="fa fa-eye">&nbsp;Details</i></a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="padding-left: 40%">No Records Found!... </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-1">
                    {{ $Id->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<section class="app-user-list">
    <div class="card">
        <h5 class="card-header">Latest IPass</h5>
        <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="selectSmall">Select Per Page</label>
                    <select wire:model='perPageAll' class="form-control form-control-sm" id="selectSmall">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead style="color: #070707">
                        <tr>
                            <th>Name</th>
                            <th>Resident Name</th>
                            <th>Guard</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: small">
                        @forelse($allTypes as $key => $visitor)
                            <tr>
                                <td>{!! $visitor->name !!} </td>
                                <td>{!! $visitor->resident2->name !!} </td>
                                <td>{!! $visitor->sentry->name !!} </td>
                                <td>{!! $visitor->timeLog->exit_time ?? 'Null' !!} </td>
                                <td>{!! $visitor->timeLog->entry_time ?? 'Still Within' !!} </td>
                                @if ($visitor->timeLog->entry_time === null)
                                    @php
                                        $duration = 'Visitor Still Within the Premise';
                                    @endphp
                                @else
                                    @php
                                        
                                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->exit_time);
                                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->entry_time);
                                        $duration = $to->longAbsoluteDiffForHumans($from);
                                    @endphp
                                @endif
                                <td>
                                    {{ $duration }}
                                </td>
                                <td>
                                    <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}"><i
                                            class="fa fa-eye">&nbsp;Details</i></a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="padding-left: 40%">No Records Found!... </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-1">
                    {{ $allTypes->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
