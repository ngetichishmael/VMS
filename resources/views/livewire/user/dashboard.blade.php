<div>
            <div class="card">
                <h5 class="card-header">Search Filter</h5>
                <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
                    <div class="col-md-4 user_role">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search"></i></span>
                            </div>
                            <input wire:model.debounce.300ms="search"  type="search" id="search" class="form-control" name="search"
                              placeholder="Search" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="selectSmall">Organization</label>
                            <select wire:model="organizationId" class="form-control form-control-sm" >
                                <option value="">  All  </option>
                                @foreach ($organizations as $org)
                                    <option  value="{{ $org ->id }}"> {{ $org ->name }}</option>
                                @endforeach  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="selectSmall">Role</label>
                            <select wire:model="roleId" class="form-control form-control-sm" id="selectSmall">
                                <option value="">All</option>
                                @foreach ($roles as $rol)
                                    <option  value="{{ $rol ->id }}"> {{ $rol ->name }}</option>
                                @endforeach  
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


            @include('livewire.Notification.flash-message')

            <!-- list section start -->
            <div class="card">
  
                <div class="pt-0 card-datatable table-responsive">
                    <div class="card-datatable table-responsive">
                        <table class="table" >
                            <thead>
                                <tr>
                                     <th>#</th>
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
                            @forelse ($users as $key => $user)
                                <tr>
                                    <td>{!! $key + 1 !!}</td>

                                    <td> {{ $user ->name }} </td>

                                    <td>{{ $user ->email }}</td>
                                    <td> {{ $user ->phone_number }} </td>
                                 
                                    <td>{!! $user->organization()->pluck("name")->implode('')!!} </td>
                                    <td>{!! $user->role()->pluck("name")->implode('')!!} </td>
                                  
                                     <td>
                                     <?php if($user->status == '1'){ ?> 

                                        <a href="#" class="Active" style="color:#73A561;">Active</a>

                                        <?php }else{ ?> 

                                        <a href="#" class="inactive" style="color:#8B0000;">Disabled</a>

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

                                                <!--update link-->
<<<<<<< HEAD
                                        <a  href="{{ route('OrganizationUsers.edit',$user->id)}}" class="" style="padding-right:20px"   id="smallButton" data-target="#modals-edit-slide-in"  data-placement="top" > Edit </a>
=======
                                        <a  wire:ignore.self href="#" class="" wire:click="edituser({{ $user->id }})" style="padding-right:20px"  data-toggle="modal" id="smallButton" data-target="#modals-edit-slide-in"  data-placement="top" > Edit </a>
>>>>>>> origin/ish
                                        <!-- delete link -->
                                        <?php if($user->status == '0'){ ?>
                                        <a wire:ignore.self href="#" wire:click="activate({{ $user->id }})"  onclick="return confirm('Are you sure to want to Activate the User?')" style="padding-right:20px; " > Activate </a>
                                        <?php }else{ ?>
                                        <a wire:ignore.self href="#" wire:click="deactivate({{ $user->id }})"  onclick="return confirm('Are you sure to want to suspend the User?')" style="padding-right:20px; " > Suspend</i> </a>
                                        <?php } ?>

                                        <a wire:ignore.self href="#" wire:click="destroy({{ $user->id }})" onclick="return confirm('Are you sure to want to delete the User?')" > Delete </a>

                                        </div>
                                        </div>
                                        </td>
                                </tr>
                              
                         
                                @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; ">No Record Found</td>
                                </tr>
                            @endforelse
                       
                            </tbody>
                          
                        </table>
             
                        <div style="margin-left: 80%"  class="mt-1">{{ $users->links() }}
                        </div>
                    </div>
                </div>
   
        </div>

    
              <!-- Modal to add new user starts-->
    <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{!! route('OrganizationUsers.store') !!}">
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New User</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input  type="text" name="name"  class="form-control" required />

            </div>
   
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input  type="email" name="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input  type="tel" name="phone_number"  class="form-control" required />

            </div>


            <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="organization_code" name="organization_code" class="form-control">
               <option  value="#"> Select</option>
                @foreach ($organizations as $organizat)
                    <option  value="{{ $organizat ->id }}"> {{ $organizat ->name }}</option>
                @endforeach  
              </select>
            </fieldset>

            <fieldset class="form-group">
              <label class="form-label" for="user-role">Role</label>
              <select id="role_id" name="role_id" class="form-control" required>
              <option  value="#"> Select</option>
                @foreach ($roles as $ros)
                    <option  value="{{ $ros ->id }}"> {{ $ros ->name }}</option>
                @endforeach  
              </select>
            </fieldset>



            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Password</label>
              <input  type="password" name="password"  class="form-control" required />
            </div>
            
            <button  type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->

     <!-- Modal to Edit user starts-->
     <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-edit-slide-in">
      <div class="modal-dialog">
<<<<<<< HEAD
        <form class="add-new-user modal-content pt-0"  >
=======
        <form class="add-new-user modal-content pt-0" >
>>>>>>> origin/ish
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input  type="text" wire:model="name"  class="form-control" required />

            </div>
   
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input  type="email" wire:model="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input  type="tel" wire:model="phone_number"  class="form-control" required />

            </div>


            <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="organization_code" wire:model="organization_code" class="form-control">
               <option  value="#"> Select</option>
                @foreach ($organizations as $organ)
                    <option  value="{{ $organ ->id }}"> {{ $organ ->name }}</option>
                @endforeach  
              </select>
            </fieldset>

            <fieldset class="form-group">
              <label class="form-label" for="user-role">Role</label>
              <select id="role_id" wire:model="role_id" class="form-control" required>
              <option  value="#"> Select</option>
                @foreach ($roles as $roll)
                    <option  value="{{ $roll ->id }}"> {{ $roll ->name }}</option>
                @endforeach  
              </select>
            </fieldset>

            
            <button wire:click="editUserData" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Update') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
<<<<<<< HEAD



    
=======
>>>>>>> origin/ish
    <!-- Modal to Edit user Ends-->

      <!-- Dashboard Ecommerce ends -->
      @push('scripts')
    <script>


        window.addEventListener('show-edit-org-modal', event =>{
            $('#modals-edit-slide-in').modal('show');
        });

    
    </script>
@endpush




              <!-- Modal to add new user starts-->
              <!-- <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                <div class="modal-dialog">
                  <form class="add-new-user modal-content pt-0" >
                  {{ csrf_field() }} 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                      <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                      <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                        <input  type="text" wire:model="name"  class="form-control" required />
          
                      </div>
             
                      <div class="form-group">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <input  type="email" wire:model="email"  class="form-control" required />
          
                        <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                      </div>
                      <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
                        <input  type="tel" wire:model="phone_number"  class="form-control" required />
          
                      </div>
          
          
                      <fieldset class="form-group">
                        <label class="form-label" for="user-role">Organization</label>
                        <select id="organization_code" wire:model="organization_code" class="form-control">
                         <option  value="#"> Select</option>
                          @foreach ($organizations as $organizat)
                              <option  value="{{ $organizat ->id }}"> {{ $organizat ->name }}</option>
                          @endforeach  
                        </select>
                      </fieldset>
          
                      <fieldset class="form-group">
                        <label class="form-label" for="user-role">Role</label>
                        <select id="role_id" wire:model="role_id" class="form-control" required>
                        <option  value="#"> Select</option>
                          @foreach ($roles as $ros)
                              <option  value="{{ $ros ->id }}"> {{ $ros ->name }}</option>
                          @endforeach  
                        </select>
                      </fieldset>
          
          
          
                      <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Password</label>
                        <input  type="password" wire:model="password"  class="form-control" required />
                      </div>
                      
                      <button wire:click="store" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
                      <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                </div>
              </div> -->
              <!-- Modal to add new user Ends-->
          