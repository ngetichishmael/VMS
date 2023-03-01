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
                            <select wire:model="perPage" class="form-control form-control-sm" id="selectSmall" id="table1">
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
                            <select wire:click.prevent="sortBy('name')" class="form-control form-control-sm" id="selectSmall">
                          
                            <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                    <button type="button" class="btn btn-icon btn-outline-success" style="background-color: #1877F2; color:#fff;"  data-toggle="modal" id="smallButton" data-target="#modals-slide-in" 
                            data-placement="top" title="New User">
                          + Add Organization
                               
                        </button>
                    </div>
                </div>
            </div>
            <!-- users filter end -->
            {{-- @include('partials.loaderstyle') --}}

            @include('livewire.Notification.flash-message')

            <!-- list section start -->
            <div class="card">
                <div class="pt-0 card-datatable table-responsive">
                    <div class="card-datatable table-responsive">
                        <table class="table" >
                            <thead>
                                <tr>
                                     <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Location</th>
                                    <th>No.of Users</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                         

                            <tbody>
                            @forelse ($organization as $org)
                                <tr>
                                  
                                    <td>{{ $org ->name }}</td>
                                    <td>{{ $org ->email }}</td>   
                                    <td>{{ $org ->primary_phone }}</td>  
                                    <td>{{ $org ->location }}</td>  
                                    <td>{{ $org ->user->count() }}</td>  
                                    <td>
                                     <?php if($org->status == '1'){ ?> 
                                             <span class="badge badge-pill badge-light-success mr-1">Active</span>
                                    
                                     <?php }else{ ?> 
                                             <span class="badge badge-pill badge-light-warning mr-1">Disabled</span>

                                      <?php } ?>
                                    
                                    </td>
                              
                                    <td>
                                        <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu">

                                                <!--update link-->
                                                <a  href="{{ route('OrganizationInformation.edit',$org->id)}}" class="" style="padding-right:20px"   id="smallButton"   data-placement="top" > Edit </a>                                        <!-- delete link -->
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
                                <td colspan="6" style="text-align: center;"> No Record Found </td>
                                </tr>
                            @endforelse
                       
                            </tbody>
                          
                        </table>
             
                        <div style="margin-left: 80%" class="mt-1">{{ $organization->links() }}
                        </div>
                    </div>
                </div>
   
        </div>

    
              <!-- Modal to add new organzation starts-->
    <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{!! route('OrganizationInformation.store') !!}">
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Organization</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Name</label>
              <input  type="text" name="name"  class="form-control" required />

            </div>
   
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input  type="email" name="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input  type="tel" name="primary_phone"  class="form-control" required />

            </div>

            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Alternative Phone Number</label>
              <input  type="tel" name="secondary_phone"  class="form-control" placeholder="Optional ...." />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Location</label>
              <input  type="text" name="location"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Website Url</label>
              <input  type="text" name="websiteUrl"  class="form-control"  />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Description</label>
              <input  type="text" name="description"  class="form-control"  />

            </div>

            <button  type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>



    <!-- <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" >
        {{ csrf_field() }} 
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
              <input  type="email" wire:model="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input  type="tel" wire:model="primary_phone"  class="form-control" required />

            </div>

            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Alternative Phone Number</label>
              <input  type="tel" wire:model="secondary_phone"  class="form-control" placeholder="Optional ...." required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Location</label>
              <input  type="text" wire:model="location"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Website Url</label>
              <input  type="text" wire:model="websiteUrl"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Description</label>
              <input  type="text" wire:model="description"  class="form-control" required />

            </div>

            <button wire:click="store" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div> -->

    <!-- Modal to add new organzation Ends-->

     <!-- Modal to Edit organzation starts-->
     <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-edit-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" >
        {{ csrf_field() }} 
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
              <input  type="email" wire:model="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input  type="tel" wire:model="primary_phone"  class="form-control" required />

            </div>

            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Alternative Phone Number</label>
              <input  type="tel" wire:model="secondary_phone"  class="form-control" placeholder="Optional ...." />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Location</label>
              <input  type="text" wire:model="location"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Website Url</label>
              <input  type="text" wire:model="websiteUrl"  class="form-control"  />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Description</label>
              <input  type="text" wire:model="description"  class="form-control" />

            </div>


     
            
            <button wire:click="editOrganizationData" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Update') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to Edit user Ends-->

      <!-- Dashboard Ecommerce ends -->
      @push('scripts')
    <script>


        window.addEventListener('show-edit-org-modal', event =>{
            $('#modals-edit-slide-in').modal('show');
        });

    
    </script>
@endpush

