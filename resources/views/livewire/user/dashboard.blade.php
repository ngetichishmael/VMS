<div>
            <div class="card">
                <h5 class="card-header">Search Filter</h5>
                <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
                    <div class="col-md-4 user_role">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search"></i></span>
                            </div>
                            <input wire:model="search" type="search" id="search" class="form-control" name="search"
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
                    <button type="button" class="btn btn-icon btn-outline-success" style="background-color: #1877F2; color:#fff;"  data-toggle="modal" id="smallButton" data-target="#modals-slide-in" 
                            data-placement="top" title="New User">
                          + Add New User
                               
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

                         

                            <tbody>
                            @forelse ($users as $user)
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
                                            <a href="{{ url('OrganizationUsers.suspend'.$user->id) }}" onclick="return confirm('Are you sure to want to suspend the User?')"  title="Suspend" style="padding-right:6px"> Suspend </a>
                                        <?php } ?>

                                        <a href="{{ url('organization/users/delete/'.$user->id) }}" onclick="return confirm('Are you sure to want to delete the user?')" title="Delete"> Delete </a>
                                   
                                            </div>
                                        </div>
                                        
  
                                    </td>
                                </tr>
                              
                         
                                @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; color:red;">No User Found</td>
                                </tr>
                            @endforelse
                       
                            </tbody>
                          
                        </table>
             

                        <div class="mt-1">
                  
                        </div>
                    </div>
                </div>
   
        </div>

    
         <!-- Modal to add new user starts-->
         <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{{ route('OrganizationUsers.store') }}">
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New User</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input
                type="text"
                name="name" 
                :value="old('name')"
                class="form-control dt-full-name"
                id="basic-icon-default-fullname"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>

            
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input
                type="email"
                name="email" 
                :value="old('email')"
                class="form-control dt-email"
                aria-describedby="basic-icon-default-email2"
                name="user-email"
              />
              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input
                type="tel"
                class="form-control dt-full-name"
                name="phone_number" 
                :value="old('phone_number')"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>



            <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="organization_id" name="organization_id" class="form-control">
                
                @foreach ($organizations as $organizations)
                    <option  value="{{ $organizations ->id }}"> {{ $organizations ->name }}</option>
                @endforeach  
              </select>
            </fieldset>

            <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="role_id" name="role_id" class="form-control">
                
                @foreach ($roles as $role)
                    <option  value="{{ $role ->id }}"> {{ $role ->name }}</option>
                @endforeach  
              </select>
            </fieldset>




            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Password</label>
              <input
                type="password"
                class="form-control dt-full-name"
                name="password" 
                :value="old('password')"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>
            
            <button type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->

  

        <h2 class="brand-text">TODO ON USERS</h2>
        <div class="card-body">
            <div id="jstree-basic">
                <ul>
                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>
                        CRUD
                        <ul>
                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Create</li>
                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Read</li>
                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Updated</li>
                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Delete</li>
                        </ul>
                    </li>
                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>
                        Relationship
                        <ul data-jstree='{"icon" : "far fa-folder"}'>
                            <li data-jstree='{"icon" : "far fa-file-image"}'>Organization</li>
                            <li data-jstree='{"icon" : "far fa-file-image"}'>Hierarchy under Organization</li>
                        </ul>
                    </li>
                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>
                        Table
                        <ul>
                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Filter</li>
                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Pagination</li>
                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Search by *</li>
                        </ul>
                    </li>
                    <li data-jstree='{"icon" : "fab fa-html5"}'>Any Other</li>
                    <li data-jstree='{"icon" : "fab fa-html5"}'>Martin from Advise</li>
                    <li data-jstree='{"icon" : "fab fa-html5"}'>Isaac to Provide images, and secondary colors</li>
                </ul>
            </div>
        </div>
    </section>
