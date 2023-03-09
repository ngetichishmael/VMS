
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
    </div>
</div>

<!-- users filter end -->

@include('livewire.Notification.flash-message')

{{-- @include('partials.loaderstyle') --}}
<!-- list section start -->
<div class="card">
    <div class="pt-0 card-datatable table-responsive">
        <div class="card-datatable table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Organization</th>
                    <th>ID </th>
                    <th>Automatic ID </th>
                    <th>SMS </th>
                    <th>iPass </th>
                    <th>Returning Visitor</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse($settings as $setting)
                    <tr>
                        <td>{!! $setting->organization->name ?? null !!} </td>
                        <td style="color: {{ $setting->id_checkin == 1 ? '#4BB543' : '#ff9966' }}">

                            @if ($setting->id_checkin == 1)
                                 <i class="fas fa-check-circle"></i>
                            @else
                                 <i class="fas fa-times-circle " ></i>
                            @endif

                        </td>
                        <td style="color: {{ $setting->automatic_id_checkin == 1 ? '#4BB543' : '#ff9966'  }}">

                            @if ($setting->automatic_id_checkin == 1)
                                 <i class="fas fa-check-circle"></i>
                            @else
                                 <i class="fas fa-times-circle"></i>
                            @endif
                        </td>
                        <td style="color: {{ $setting->sms_checkin == 1 ? '#4BB543' : '#ff9966'  }}">

                            @if ($setting->sms_checkin == 1)
                                 <i class="fas fa-check-circle"></i>
                            @else
                                 <i class="fas fa-times-circle"></i>
                            @endif
                        </td>
                        <td style="color: {{ $setting->ipass_checkin == 1 ? '#4BB543' : '#ff9966'  }}">

                            @if ($setting->ipass_checkin == 1)
                                 <i class="fas fa-check-circle"></i>
                            @else
                                 <i class="fas fa-times-circle"></i>
                            @endif
                        </td>
                        <td style="color: {{ $setting->returning_visitor == 1 ? '#4BB543' : '#ff9966'  }}">

                            @if ($setting->returning_visitor == 1)
                                 <i class="fas fa-check-circle"></i>
                            @else
                                 <i class="fas fa-times-circle"></i>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('OrganizationSetting.edit', ['setting' => $setting->organization_code ?? '']) }}">   <i class="fas fa-edit" style="color:#808080"> </i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" style="padding-left: 40%">No setting(s) In Records Found!... </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-1">{{ $settings->links() }}
            </div>
        </div>
    </div>
</div>
</div>
