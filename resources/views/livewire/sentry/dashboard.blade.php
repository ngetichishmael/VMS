<div>
            <div class="card">
                <h5 class="card-header">Search Filter</h5>
                <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
                    <div class="col-md-4 user_role">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search"></i></span>
                            </div>
                            <input  wire:model="search" type="text" id="fname-icon" class="form-control" name="fname-icon"
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
                            <select wire:model="sortAsc" class="form-control form-control-sm" id="selectSmall">
                                <option value="1">Ascending</option>
                                <option value="0">Descending</option>
                            </select>
                        </div>
                    </div>
              
                    <div class="col-md-3">
                    <button type="button" class="btn btn-icon btn-outline-success" style="background-color: #1877F2;color:#fff;"  data-toggle="modal" id="smallButton" data-target="#modals-slide-in" 
                            data-placement="top" title="New User">
                              + Add New Sentry
                               
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
                                  
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>ID Number</th>
                                    <th>Organization</th>
                                    <th>Shift</th>
                                    <th>Device</th>
                                    <th>Last Login</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($sentries as $key => $sentry)
                                <tr>
                                   
                                    <td> {{ $sentry ->name }} </td>
                                    <td>{!! $sentry->user_detail()->pluck("phone_number")->implode('')!!} </td>
                                    <td>{!! $sentry->user_detail()->pluck("ID_number")->implode('')!!} </td>
                                    <td>{!! $sentry->user_detail()->pluck("company")->implode('')!!} </td>
                                    <td>{!! $sentry->shift()->pluck("name")->implode('')!!} </td>
                                    <td>{!! $sentry->device()->pluck("identifier")->implode('')!!} </td>
                                    <td>{{ $sentry ->updated_at }}</td>
                                    <td>
                                    <?php if($sentry->status == '1'){ ?> 

                                        <a href="#" class="Active" style="color:#73A561;">Active</a>

                                        <?php }else{ ?> 

                                        <a href="#" class="inactive" style="color:#8B0000;">Disabled</a>

                                    <?php } ?>

                                    </td>
                               
                                    <td>
                                        <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu">

                                                <!--update link-->
                                        <a  wire:ignore.self href="#" class="" wire:click="editsentryanization({{ $sentry->id }})" style="padding-right:20px"  data-toggle="modal" id="smallButton" data-target="#modals-edit-slide-in"  data-placement="top" > Edit </a>
                                        <!-- delete link -->
                                        <?php if($sentry->status == '0'){ ?>
                                        <a wire:ignore.self href="#" wire:click="activate({{ $sentry->id }})"  onclick="return confirm('Are you sure to want to Activate the sentry?')" style="padding-right:20px; " > Activate </a>
                                        <?php }else{ ?>
                                        <a wire:ignore.self href="#" wire:click="deactivate({{ $sentry->id }})"  onclick="return confirm('Are you sure to want to suspend the sentry?')" style="padding-right:20px; " > Suspend</i> </a>
                                        <?php } ?>

                                        <a wire:ignore.self href="#" wire:click="destroy({{ $sentry->id }})" onclick="return confirm('Are you sure to want to delete the sentry?')" > Delete </a>

                                        </div>
                                        </div>
                                        </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="8" style="text-align: center;"> No Record Found !!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div style="margin-left: 80%"  class="mt-1">{{ $sentries->links() }}
                        </div>
                    </div>
                </div>
    
        </div>

           <!-- Modal to add new user starts-->
    <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" >
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Sentry</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input  type="text" wire:model="name"  class="form-control" required />

            </div>

            
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input  type="text" wire:model="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
       

            <fieldset class="form-group">
              <label class="form-label" for="user-role">Shift</label>
              <select id="role_id" name="shift_id" class="form-control">
                
                @foreach ($shifts as $shift)
                    <option  value="{{ $shift ->id }}"> {{ $shift ->name }}</option>
                @endforeach  
              </select>
            </fieldset>

            <fieldset class="form-group">
              <label class="form-label" for="user-role">Shift</label>
              <select id="role_id" name="device_id" class="form-control">
                
                @foreach ($devices as $device)
                    <option  value="{{ $device ->id }}"> {{ $device ->identifier }}</option>
                @endforeach  
              </select>
            </fieldset>



        
            
            <button wire:click="store" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->

