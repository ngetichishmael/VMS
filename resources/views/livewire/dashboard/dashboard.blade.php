<section class="app-user-list">
    <div class="card">
        <h5 class="card-header">All Latest Drive-Ins</h5>

        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead>
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
                    <tbody>
                        @forelse($allTypes as $key => $visitor)
                        <tr>
                            <td>{!! $visitor->name !!} </td>
                            <td>{!! $visitor->resident2->name ?? '' !!} </td>
                            <td>{!! $visitor->sentry->name ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->entry_time ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->exit_time ?? 'Visitor Within the Premise' !!} </td>
                            @if ($visitor->timeLog->exit_time === null)
                            @php
                            $duration = 'Visitor Still Within the Premise';
                            @endphp
                            @else
                            @php
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->exit_time);
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $visitor->timeLog->exit_time);
                            $duration = $to->longAbsoluteDiffForHumans($from);
                            @endphp
                            @endif
                            <td>
                                <span class="badge badge-pill badge-light-dark mr-1">
                                    {{ $duration }}
                                </span>


                            </td>
                            <td>
                                <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}">
                                    <i class="fa fa-eye" style="color:#808080"> </i></a>
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


        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead>
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
                    <tbody>
                        @forelse($DriveIn as $key => $visitor)
                        <tr>
                            <td>{!! $visitor->name !!} </td>
                            <td>{!! $visitor->resident2->name ?? '' !!} </td>
                            <td>{!! $visitor->sentry->name ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->entry_time ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->exit_time ?? 'Visitor Within the Premise' !!} </td>
                            @if ($visitor->timeLog->exit_time === null)
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
                                <span class="badge badge-pill badge-light-dark mr-1">
                                    {{ $duration }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}">
                                    <i class="fa fa-eye" style="color:#808080"> </i></a>
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


        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead>
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
                    <tbody>
                        @forelse($WalkIn as $key => $visitor)
                        <tr>
                            <td>{!! $visitor->name !!} </td>
                            <td>{!! $visitor->resident2->name ?? '' !!} </td>
                            <td>{!! $visitor->sentry->name ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->entry_time ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->exit_time ?? 'Visitor Within the Premise' !!} </td>
                            @if ($visitor->timeLog->exit_time === null)
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
                                <span class="badge badge-pill badge-light-dark mr-1">
                                    {{ $duration }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}">
                                    <i class="fa fa-eye" style="color:#808080"> </i></a>
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


        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead>
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
                    <tbody>
                        @forelse($Sms as $key => $visitor)
                        <tr>
                            <td>{!! $visitor->name !!} </td>
                            <td>{!! $visitor->resident2->name ?? '' !!} </td>
                            <td>{!! $visitor->sentry->name ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->entry_time ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->exit_time ?? 'Visitor Within the Premise' !!} </td>
                            @if ($visitor->timeLog->exit_time === null)
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
                                <span class="badge badge-pill badge-light-dark mr-1">
                                    {{ $duration }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}">
                                    <i class="fa fa-eye" style="color:#808080"> </i></a>
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

        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead>
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
                    <tbody>
                        @forelse($Id as $key => $visitor)
                        <tr>
                            <td>{!! $visitor->name !!} </td>
                            <td>{!! $visitor->resident2->name ?? '' !!} </td>
                            <td>{!! $visitor->sentry->name ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->entry_time ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->exit_time ?? 'Visitor Within the Premise' !!} </td>
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
                                <span class="badge badge-pill badge-light-dark mr-1">
                                    {{ $duration }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}">
                                    <i class="fa fa-eye" style="color:#808080"> </i></a>
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

        <div class="pt-0 card-datatable table-responsive">
            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead>
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
                    <tbody>
                        @forelse($allTypes as $key => $visitor)
                        <tr>
                            <td>{!! $visitor->name !!} </td>
                            <td>{!! $visitor->resident2->name ?? '' !!} </td>
                            <td>{!! $visitor->sentry->name ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->entry_time ?? '' !!} </td>
                            <td>{!! $visitor->timeLog->exit_time ?? 'Visitor Within the Premise' !!} </td>
                            @if ($visitor->timeLog->exit_time === null)
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
                                <span class="badge badge-pill badge-light-dark mr-1">
                                    {{ $duration }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('VisitAllCheckIn.show', $visitor->id) }}">
                                    <i class="fa fa-eye" style="color:#808080"> </i></a>
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
