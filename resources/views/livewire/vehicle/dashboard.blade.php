<div>
    <!-- Dashboard Ecommerce Starts -->
            <!-- users filter start -->
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
                            <select class="form-control form-control-sm" id="selectSmall" wire:model="perPage">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
{{--                    <div class="col-md-2">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="sort_time">Sort by Time:</label>--}}
{{--                            <select wire:model="sortTimeField" class="form-control form-control-sm" id="sort_time">--}}
{{--                                <option value="time">Ascending</option>--}}
{{--                                <option value="time_desc">Descending</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>

            <!-- users filter end -->
            {{-- @include('partials.loaderstyle') --}}
            <!-- list section start -->
            <div class="card">
                <div class="pt-0 card-datatable table-responsive">
                    <div class="card-datatable table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
{{--                                    <th>#</th>--}}
                                    <th>Registration Number</th>
                                    <th>User Name</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @forelse ( $vehicles as $vehicle)
                                <tr>
{{--                                    <td>1</td>--}}
                                    <td>{!! $vehicle-> registration!!}</td>
                                    <td>{!! $vehicle->visitor()->pluck("name")->implode('') !!} </td>
                                    <td>{!! $vehicle->visitor->timeLogs->entry_time ?? null!!}</td>
                                    <td>{!! $vehicle->visitor->timeLogs->exit_time ?? null!!}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" style="padding-left: 40%"> No Records Found!... </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="mt-1">{!! $vehicles->links() !!}</div>
                        </div>
                    </div>
                </div>
</div>
{{--        <h2 class="brand-text">TODO ON USERS</h2>--}}
{{--        <div class="card-body">--}}
{{--            <div id="jstree-basic">--}}
{{--                <ul>--}}
{{--                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                        CRUD--}}
{{--                        <ul>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Create</li>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Read</li>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Updated</li>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Delete</li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                        Relationship--}}
{{--                        <ul data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                            <li data-jstree='{"icon" : "far fa-file-image"}'>Drive In</li>--}}
{{--                            <li data-jstree='{"icon" : "far fa-file-image"}'>Zone</li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                        Table--}}
{{--                        <ul>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Filter</li>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Pagination</li>--}}
{{--                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Search by *</li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li data-jstree='{"icon" : "fab fa-html5"}'>Any Other</li>--}}
{{--                    <li data-jstree='{"icon" : "fab fa-html5"}'>Martin from Advise</li>--}}
{{--                    <li data-jstree='{"icon" : "fab fa-html5"}'>Isaac to Provide images, and secondary colors</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}

    <!-- Dashboard Ecommerce ends -->

