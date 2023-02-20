<div>
            <div class="card">
                <h5 class="card-header">Search Filter</h5>
                <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
                    <div class="col-md-4 user_role">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search"></i></span>
                            </div>
                            <input wire:model="search" type="text" class="form-control" 
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
                        <button type="button" class="btn btn-icon btn-outline-success" data-toggle="modal" style="background-color: #1877F2; color:#fff;" id="smallButton" data-target="#modals-slide-in" 
                            data-placement="top" >+ Add New Organization 
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
                                 
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Location</th>
                                    <th>Status</th>
                              
                                    <th>Action</th>

                                </tr>
                            </thead>
                            
                            <tbody>
                            @forelse ($organizations as $org)
                                <tr>
                                  
                                    <td>{{ $org ->name }}</td>
                                    <td>{{ $org ->email }}</td>   
                                    <td>{{ $org ->primary_phone }}</td>  
                                    <td>{{ $org ->location }}</td>  
                                    <td>
                                    <?php if($org->status == '1'){ ?>

                                    <a href="#" class="Active" style="color:#73A561;">Active</a>

                                    <?php }else{ ?>

                                    <a href="#" class="inactive" style="color:#8B0000;">Suspended</a>

                                    <?php } ?>

                                    </td>
                              
                                    <td>
                                        <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu">

                                                <!--update link-->
                                        <a  wire:ignore.self href="#" class="" wire:click="editOrganization({{ $org->id }})" style="padding-right:20px"  data-toggle="modal" id="smallButton" data-target="#modals-edit-slide-in"  data-placement="top" > Edit </a>
                                        <!-- delete link -->
                                        <?php if($org->status == '0'){ ?>
                                        <a wire:ignore.self href="#" wire:click="activate({{ $org->id }})"  onclick="return confirm('Are you sure to want to Activate the organization?')" style="padding-right:20px; " > Activate </a>
                                        <?php }else{ ?>
                                        <a wire:ignore.self href="#" wire:click="deactivate({{ $org->id }})"  onclick="return confirm('Are you sure to want to suspend the organization?')" style="padding-right:20px; " > Suspend</i> </a>
                                        <?php } ?>

                                        <a wire:ignore.self href="#" wire:click="destroy({{ $org->id }})" onclick="return confirm('Are you sure to want to delete the organization?')" > Delete </a>

                                        </div>
                                        </div>
                                        </td>
                                </tr>

                                @empty
                                <tr>
                                <td colspan="6" style="text-align: center; color:red;"> No Record Found For Organization </td>
                                </tr>
                            @endforelse
                          
                            </tbody>
                           
                        </table>
                      
                        <div style="margin-left: 80%" class="mt-1">{{ $organizations->links() }}
                </div>
                    </div>
                </div>
            </div>
       
   <!-- Modal to add new organization starts-->
        <div wire:ignore.self  class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
            <div class="modal-dialog">
                <form class="add-new-user modal-content pt-0">
                    @csrf
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">New Organization</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Name</label>
                            <input  type="text" wire:model="name"  class="form-control" required />

                        </div>


                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-email">Email</label>
                            <input  type="text" wire:model="email"  class="form-control" required />

                            <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-email">Phone Number</label>
                            <input  type="text" wire:model="primary_phone"  class="form-control" required />

                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-email">Other Phone Number</label>
                            <input  type="text" wire:model="secondary_phone"  class="form-control"  />

                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Location</label>
                            <input  type="text" wire:model="location"  class="form-control" required />

                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Website URL</label>
                            <input  type="text" wire:model="url"  class="form-control" required />

                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Organization Description</label>
                            <input  type="text" wire:model="description"  class="form-control" required />

                        </div>

                        <button  wire:click="store" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    <!-- Modal to add new organization Ends-->


   <!-- Modal to edit  organization starts-->
   <div wire:ignore.self  class="modal modal-slide-in new-user-modal fade" id="modals-edit-slide-in">
            <div class="modal-dialog">
                <form class="add-new-user modal-content pt-0" >
                
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Organization</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Name</label>
                            <input  type="text" wire:model="name"  class="form-control" required />

                        </div>


                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-email">Email</label>
                            <input  type="text" wire:model="email"  class="form-control" required />

                            <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-email">Phone Number</label>
                            <input  type="text" wire:model="primary_phone"  class="form-control" required />

                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-email">Other Phone Number</label>
                            <input  type="text" wire:model="secondary_phone"  class="form-control" required />

                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Location</label>
                            <input  type="text" wire:model="location"  class="form-control" required />

                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Website URL</label>
                            <input  type="text" wire:model="url"  class="form-control" required />

                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Organization Description</label>
                            <input  type="text" wire:model="description"  class="form-control" required />

                        </div>

                        <button type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Update') }} </button>
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    <!-- Modal to edit organization Ends-->


    <!-- Dashboard Ecommerce ends -->
    @push('scripts')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#addStudentModal').modal('hide');
       
        });

        window.addEventListener('show-edit-org-modal', event =>{
            $('#modals-edit-slide-in').modal('show');
        });

    
    </script>
@endpush