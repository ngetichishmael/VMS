
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
{{-- @include('partials.loaderstyle') --}}
<!-- list section start -->
<div class="card">
    <div class="pt-0 card-datatable table-responsive">
        <div class="card-datatable table-responsive">
            <table class="table">
                <thead style="color: #070707">
                <tr>
                    <th>Organization</th>
                    <th>ID Check-in</th>
                    <th>Automatic ID Check-in</th>
                    <th>SMS Check-in</th>
                    <th>IPass Check-in</th>
                    <th>Action</th>
                </tr>
                </thead>
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
                <tbody style="font-size: small">
                @forelse($settings as $setting)
                    <tr>
                        <td>{!! $setting->organization->name ?? null !!} </td>
                        <td style="color: {{ $setting->id_checkin == 1 ? 'green' : 'orange' }}">
                            {{ $setting->id_checkin == 1 ? 'subscribed' : 'not subscribed' }}
                        </td>
                        <td style="color: {{ $setting->automatic_id_checkin == 1 ? 'green' : 'orange' }}">
                            {{ $setting->automatic_id_checkin == 1 ? 'subscribed' : 'not subscribed' }}
                        </td>
                        <td style="color: {{ $setting->sms_checkin == 1 ? 'green' : 'orange' }}">
                            {{ $setting->sms_checkin == 1 ? 'subscribed' : 'not subscribed' }}
                        </td>
                        <td style="color: {{ $setting->ipass_checkin == 1 ? 'green' : 'orange' }}">
                            {{ $setting->ipass_checkin == 1 ? 'subscribed' : 'not subscribed' }}
                        </td>
                        <td>
                            <a href="{{ route('OrganizationSetting.edit', ['setting' => $setting->organization_code ?? '']) }}"><i class="fa fa-edit"> &nbsp Edit</i></a>
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
