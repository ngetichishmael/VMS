<div>
            <div class="card">
                <h5 class="card-header">Search Filter</h5>
                <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
                    <div class="col-md-4 user_role">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search"></i></span>
                            </div>
                            <input wire:model="search" type="text" id="fname-icon" class="form-control" name="fname-icon"
                                placeholder="Search" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="selectSmall">Select Per Page</label>
                            <select  wire:model="perPage"  class="form-control form-control-sm" id="selectSmall">
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
                            data-placement="top" title="New Organazition">+ Add New Shift
                           
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
                        <table class="table">
                            <thead>
                                <tr>
                                      <th>#</th>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($shifts as $key => $shift)
                                <tr>
                                    <td>{!! $key + 1 !!}</td>
                                    <td>{{ $shift ->name }}</td>
                                    
                                    <td>{{ $shift ->created_at }}</td>  
                                    <td>
                                     <?php if($shift->status == '1'){ ?> 
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
                                                   <a  href="{{ route('shifts.edit',$shift->id)}}" class="" style="padding-right:20px"   id="smallButton"   data-placement="top" > Edit </a> 
                                        <!-- delete link -->
                                        <?php if($shift->status == '0'){ ?>
                                        <a wire:ignore.self href="#" wire:click="activate({{ $shift->id }})"  onclick="return confirm('Are you sure to want to Activate the Shift?')" style="padding-right:20px; " > Activate </a>
                                        <?php }else{ ?>
                                            <a wire:ignore.self href="#" wire:click="deactivate({{ $shift->id }})"  onclick="return confirm('Are you sure to want to Disable the Shift?')" style="padding-right:20px; " > Disable</i> </a>
                                        <?php } ?>

                                        <a wire:ignore.self href="#" wire:click="destroy({{ $shift->id }})" onclick="return confirm('Are you sure to want to delete the Shift?')" > Delete </a>

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
                        <div style="margin-left: 80%"  class="mt-1">{{ $shifts->links() }}
                </div>
                    </div>
                </div>
        </div>

         @include('livewire.shift.modal')