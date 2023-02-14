
    <!-- Dashboard Ecommerce Starts -->
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
    <section id="dashboard-ecommerce">
{{--        <div class="row mb-2">--}}
{{--            <label style="color: #070707" for=""><h4>Filter By:</h4></label>--}}
{{--            <div class="col-md-5" style="width: 50%;" >--}}
{{--                <label style="color: #070707" for=""><h5>Visitor Type</h5></label>--}}
{{--                <select wire:model="selectedVisitorType" style="width: 50%;">--}}
{{--                    <option value="">All</option>--}}

{{--                    @foreach ($visitorTypes as $visitorType)--}}
{{--                        <option value="{{ $visitorType->id }}">{{ $visitorType->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col-md-5">--}}
{{--                <label style="color: #070707" for=""><h5>Verification Type</h5></label>--}}
{{--                <select wire:model="selectedIdentificationType" style="width: 50%;">--}}
{{--                    <option value="">All</option>--}}
{{--                    @foreach ($identificationTypes as $identificationType)--}}
{{--                        <option value="{{ $identificationType->id }}">{{ $identificationType->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}

            <div class="row mb-2" style="margin-left: 35%; padding-left: 35%">
                <div class="col-md-9">
                    <label for="" style="color: #070707">Search</label>
                    <input wire:model="search" type="text" class="form-control" placeholder="Enter visitor name">
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
            </div>
            </div>
            <div class="card">
                <div class="pt-0 card-datatable table-responsive">
                    <div class="card-datatable table-responsive">
                        <table class="table">
                            <thead style="color: #070707">
                            <tr>

                                <th>Vehicle Reg</th>
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
                            <tbody>
                            @foreach ($dvisitors as $key => $visitor)
                                <tr>
{{--                                    <td>{!! $key + 1 !!}</td>--}}
                                    <td>{!! $visitor->vehicle()->pluck("registration")->implode('')!!} </td>
                                    <td>{!! $visitor->name!!} </td>
                                    <td>{{ $visitor->resident()->unit()->block() ? $visitor->resident->unit->block->premise->name : '' }}</td>
                                    <td>{!! $visitor->resident->unit->name !!}</td>
                                    <td>{!! $visitor->resident->unit->block->premise->organization->name !!}</td>
                                    <td>{!! $visitor->timeLogs->entry_time!!}</td>
                                    @if($visitor->timeOut=='0000-00-00 00:00:00' || $visitor->timeOut=='' || $visitor->timeOut==null)<td> </td>
                                    @else
                                        <td> {!! $visitor->timeLogs->exit_time!!}</td>
                                    @endif
                                    @if($visitor->timeLogs->exit_time=='0000-00-00 00:00:00'|| $visitor->timeLogs->exit_time=='' || $visitor->timeLogs->exit_time==null)<td style="color: orange;"> Visitor Still in</td>
                                    @else
                                        <td>
                                            {{ Carbon\Carbon::createFromTimeStamp(strtotime(date("Y-m-d H:i:s", strtotime($visitor->timeLogs->exit_time))) - strtotime(date("Y-m-d H:i:s", strtotime($visitor->timeLogs->exit_time))))->format('H :i :s') }}
                                        </td>
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
                        <div class="mt-1">{!! $dvisitors->links() !!}</div>
                        </div>
                    </div>
                </div>

    </section>
        </div>

{{--        <h2 class="brand-text">TODO ON DRIVE IN</h2>--}}
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
{{--                            <li data-jstree='{"icon" : "far fa-file-image"}'>VEHICLES</li>--}}
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
