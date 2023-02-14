

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

                    <div class="col-ms-3">
                        <label style="color: #070707" for="">Items Per</label>
                        <select wire:model="perPage" class="form-control">`
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
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
                    <div class="col-md-3">
                        <button type="button" class="btn btn-icon btn-outline-success" data-toggle="tooltip"
                            data-placement="top" title="New Booking">
                            <img src="{{ asset('images/icons/excel.png') }}"alt="Add" width="20" height="20"
                                data-toggle="tooltip" data-placement="top" title="Export Excel">
                        </button>
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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Location</th>
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

                            </style>
                            <tbody>
                            @foreach ($organizations as $key => $organization)
                                <tr>
                                    <td>{!! $key + 1 !!}</td>
                                    <td>{!! $organization->name !!}</td>
                                    <td>{!! $organization->email !!}</td>
                                    <td>{!! $organization->location !!}</td>
                                    <td>
                                    <div class="dropdown-menu">
                                        <a href="#">View Details</a>
                                        <a href="#">View History</a>
                                    </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-1">{!! $organizations->links() !!}</div>
                        <div class="mt-1">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>

{{--        <h2 class="brand-text">TODO ON ORGANIZATIONS</h2>--}}
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
{{--                        Action--}}
{{--                        <ul data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                            <li data-jstree='{"icon" : "far fa-file-image"}'>Suspend</li>--}}
{{--                            <li data-jstree='{"icon" : "far fa-file-image"}'>Others</li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                        Relationship--}}
{{--                        <ul data-jstree='{"icon" : "far fa-folder"}'>--}}
{{--                            <li data-jstree='{"icon" : "far fa-file-image"}'>Users</li>--}}
{{--                            <li data-jstree='{"icon" : "far fa-file-image"}'>Organization</li>--}}
{{--                            <li data-jstree='{"icon" : "far fa-file-image"}'>Hierarchy under Organization</li>--}}
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
{{--                    <li data-jstree='{"icon" : "fab fa-html5"}'>Martin to Advise</li>--}}
{{--                    <li data-jstree='{"icon" : "fab fa-html5"}'>Isaac to Provide images, and secondary colors</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
        <script type="application/javascript">
            $(document).on('click', '.dropdown-toggle', function(e) {
                e.preventDefault();
                $(this).next('.dropdown-menu').toggle();
            });
            $(document).on('mouse-enter', '.dropdown-toggle', function(e) {
                e.preventDefault();
                $(this).next('.dropdown-menu').toggle();
            });
        </script>
    </section>
    <!-- Dashboard Ecommerce ends -->

