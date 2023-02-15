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
                            <input type="text" id="search" class="form-control" name="search"
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
                    <div class="col-md-3">
                        <button type="button" class="btn btn-icon btn-outline-success" data-toggle="modal" id="smallButton" data-target="#modals-slide-in" 
                            data-placement="top" title="New Organazition">
                             + Add New Organization
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
                        <table class="invoice-list-table table" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            
                            <tbody>
                            @forelse ($organizations as $org)
                                <tr>
                                    <td>{{ $org ->id }}</td>
                                    <td>{{ $org ->name }}</td>
                                    <td>{{ $org ->email }}</td>     
                                    <td>{{ $org ->location }}</td>  
                                    <td>
                                    <?php if($org->status == '1'){ ?> 

                                    <a href="#" class="Active" style="color:#00FF00;">Active</a>

                                    <?php }else{ ?> 

                                    <a href="#" class="inactive" style="color:#FF0000;">Suspended</a>

                                    <?php } ?>

                                    </td>                            
                                    <td>{{ $org ->created_at }}</td>
                                    <td>
                                         
                         

                                          <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                              
                                                   <!--update link-->
                                        <a href="{{ url('organization/users/'.$org->id) }}" class="" style="padding-right:20px"  data-toggle="modal" id="smallButton" data-target="#modals-edit-slide-in"  data-placement="top" > Edit   </a>
                                        <!-- delete link -->
                                        <?php if($org->status == '0'){ ?> 
                                        <a href="{{ url('organization/information/suspend/'.$org->id) }}" onclick="return confirm('Are you sure to want to Activate the organization?')" style="padding-right:20px; " > Activate </a>
                                        <?php }else{ ?> 
                                            <a href="{{ url('organization/information/suspend/'.$org->id) }}" onclick="return confirm('Are you sure to want to suspend the organization?')" style="padding-right:20px; " > Suspend</i> </a>
                                        <?php } ?>

                                        <a href="{{ url('organization/information/delete/'.$org->id) }}" onclick="return confirm('Are you sure to want to delete the organization?')" > Delete </a>
                                                    
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="4">No Record Found For Organization </td>
                                </tr>
                            @endforelse
                          
                            </tbody>
                           
                        </table>
                        <div class="mt-1">
                        </div>
                    </div>
                </div>
        </section>
        </div>
  
         <!-- Modal to add new organization starts-->
   <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form wire:submit.prevent="StoreOrganization" class="add-new-user modal-content pt-0"  >
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Organization</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Name</label>
              <input type="text" wire:model="name" 
             
                class="form-control dt-full-name"
          
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>

            
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input
                type="email"
         
                wire:model="email" 
             
                class="form-control dt-email"
           
              />
              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            
            <button type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new organization Ends-->


        <h2 class="brand-text">TODO ON ORGANIZATIONS</h2>
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
                        Action
                        <ul data-jstree='{"icon" : "far fa-folder"}'>
                            <li data-jstree='{"icon" : "far fa-file-image"}'>Suspend</li>
                            <li data-jstree='{"icon" : "far fa-file-image"}'>Others</li>
                        </ul>
                    </li>
                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>
                        Relationship
                        <ul data-jstree='{"icon" : "far fa-folder"}'>
                            <li data-jstree='{"icon" : "far fa-file-image"}'>Users</li>
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
                    <li data-jstree='{"icon" : "fab fa-html5"}'>Martin to Advise</li>
                    <li data-jstree='{"icon" : "fab fa-html5"}'>Isaac to Provide images, and secondary colors</li>
                </ul>
            </div>
        </div>
    </section>