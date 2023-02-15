
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <section>
            <!-- users filter start -->
            <div class="card">
                <h5 class="card-header">Search Filter</h5>
                <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
                    <div class="col-md-4 user_role">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search"></i></span>
                            </div>
                            <input type="text" id="fname-icon" class="form-control" name="fname-icon"
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
                            <label for="selectSmall">Sort</label>
                            <select class="form-control form-control-sm" id="selectSmall">
                                <option value="1">Ascending</option>
                                <option value="0">Descending</option>
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
                            <thead>
                                <tr>
{{--                                    <th>#</th>--}}
                                    <th>Registration Number</th>
                                    <th>User Name</th>
                                    <th>Vehicle Type</th>
                                    <th>Vehicle Color</th>
                                    <th>Vehicle Model</th>
                                    <th>Last Login</th>
                                    <th>Check Out</th>
                                </tr>
                            </thead>
                            <style>

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
                            <tbody>
                            @forelse ( $vehicles as $vehicle)
                                <tr>
{{--                                    <td>1</td>--}}
                                    <td>{!! $vehicle-> registration!!}</td>
                                    <td>{!! $vehicle->user->name !!}</td>
                                    <td>{!! $vehicle->type !!}</td>
                                    <td>{!! $vehicle->color !!}</td>
                                    <td>{!! $vehicle->model !!}</td>
                                    <td>{!! $vehicle->updated_at!!}</td>
                                    <td>{!! $vehicle->updated_at!!}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" style="align-content: center">No Records Found!... </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
{{--                        <div class="mt-1">{!! $vehicles->links() !!}</div>--}}
                        </div>
                    </div>
                </div>
        </section>
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
    </section>
    <!-- Dashboard Ecommerce ends -->

