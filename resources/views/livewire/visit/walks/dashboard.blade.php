
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <section>
            <div class="row mb-2">
                <div class="col-md-9">
                    <label for="" style="color: #070707">Search</label>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Enter Product name">
                </div>
                <div class="col-md-3">
                    <label style="color: #070707" for="">Items Per</label>
                    <select wire:model="perPage" class="form-control">`
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="pt-0 card-datatable table-responsive">
                    <div class="card-datatable table-responsive">
                        <table class="table">
                            <thead style="color: #070707">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
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
                            @foreach ($visitors as $key => $visitor)
                                <tr>
                                    <td>{!! $key + 1 !!}</td>
                                    <td>{!! $visitor->firstName . " ". $visitor->lastName!!} </td>
                                    <td>{!! $visitor->site!!}</td>
                                    <td>{!! $visitor->section!!}</td>
                                    <td>{!! $visitor->organization!!}</td>
                                    <td>{!! $visitor->timeIn!!}</td>
                                    @if($visitor->timeOut=='0000-00-00 00:00:00')<td> </td>
                                    @else
                                      <td> {!! $visitor->timeOut!!}</td>
                                    @endif
                                    @if($visitor->timeOut=='0000-00-00 00:00:00')<td style="color: orange;"> Visitor Still in</td>
                                    @else
                                        <td>{!! $visitor->timeOut !!}</td>
                                    @endif
                                    <td >
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="#">View Details</a>
                                                <a href="#">View History</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-1">
                        </div>
                    </div>
                </div>
        </section>
        </div>


{{--        <h2 class="brand-text">TODO ON WALKS IN</h2>--}}
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
{{--                    <li data-jstree='{"icon" : "fab fa-html5"}'>Martin from Advise</li>--}}
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
