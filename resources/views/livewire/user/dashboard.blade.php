<section>
            <!-- users filter start -->
            {{-- message --}}
        {!! Toastr::message() !!}

            <div class="card">
                <h5 class="card-header">Search Filter</h5>
                <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
                    <div class="col-md-4 user_role">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search"></i></span>
                            </div>
                            <input type="search" id="search" class="form-control" name="search"
                              placeholder="Search" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="selectSmall">Select Per Page</label>
                            <select class="form-control form-control-sm" id="selectSmall" id="table1">
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
                    <div class="col-md-3">
                    <button type="button" class="btn btn-icon btn-outline-success" style="width:60%;background-color: #1877F2;"  data-toggle="modal" id="smallButton" data-target="#modals-slide-in" 
                            data-placement="top" title="New User">
                            <img src="{{ asset('images/icons/exceal.png') }}"alt="+ Add New User" width="60" height="20" style="color: #fff;">
                               
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
                        <table class="table" >
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>Name</th>

                                    <th>Email</th>
                                    <th>PhoneNumber</th>
                                    <th>Organization</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Check Out</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                         

                            <tbody class="alldata">
                            @foreach ($users as $user)
                                <tr>
                                    <!-- <td> {{ $user ->id }} </td> -->
                                    <td> {{ $user ->name }} </td>

                                    <td>{{ $user ->email }}</td>
                                    <td> {{ $user ->phone_number }} </td>
                                    <td>{{ $user ->org_name }} </td>
                                    
                                    <td>{{ $user ->role_name }} </td>
                                     <td>
                                     <?php if($user->status == '1'){ ?> 

                                        <a href="#" class="Active" style="color:#00FF00;">Active</a>

                                        <?php }else{ ?> 

                                        <a href="#" class="inactive" style="color:#FF0000;">Disabled</a>

                                        <?php } ?>
                                    
                                    </td>
                                    <td>{{ now() }}</td>
                                    <td>{{ now() }}</td>
                                    <td>

                                    <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                              
                                                <a href="{{ url('organization/users/edit/'.$user->id) }}" class="" style="padding-right:6px"   data-placement="top" > Edit </a>
                                               
                                                                        <!-- delete link -->
                                        <?php if($user->status == '0'){ ?> 
                                        <a href="{{ url('organization/users/suspend/'.$user->id) }}" onclick="return confirm('Are you sure to want to Activate the User?')"  title="Unsuspend" style="padding-right:6px" > Unsuspend</i> </a>
                                        <?php }else{ ?> 
                                            <a href="{{ url('organization/users/suspend/'.$user->id) }}" onclick="return confirm('Are you sure to want to suspend the User?')"  title="Suspend" style="padding-right:6px"> Suspend </a>
                                        <?php } ?>

                                        <a href="{{ url('organization/users/delete/'.$user->id) }}" onclick="return confirm('Are you sure to want to delete the user?')" title="Delete"> Delete </a>
                                   
                                            </div>
                                        </div>
                                        
  
                                    </td>
                                </tr>
                              
                            @endforeach

                            </tbody>
                            <tbody id="Content" class="searchdata"></tbody>
                        </table>
             

                        <div class="mt-1">
                  
                        </div>
                    </div>
                </div>
        </section>