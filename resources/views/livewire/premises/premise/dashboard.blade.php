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
                    <!-- <div class="col-md-2">
                        <div class="form-group">
                            <label for="selectSmall">Organization</label>
                            <select wire:model="organizationId" class="form-control form-control-sm" >
                                <option value="">  All  </option>
                              
                            </select>
                        </div>
                    </div> -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="selectSmall">Select Per Page</label>
                            <select wire:model="perPage"  class="form-control form-control-sm" id="selectSmall">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
               
                    <div class="col-md-2">
                    <button type="button" class="btn btn-icon btn-outline-success" style="background-color:  #1a3258; color:#fff;" data-toggle="modal" id="smallButton" data-target="#modals-slide-in"

                            data-placement="top" title="New User">
                              + Add Premise            
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
                                  
                                    <th>Premise Name</th>
                                    <th>Organization</th>
                                    <th>Location</th>
                                    <th>Address</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($premises as $key => $prem)
                                <tr>
                                   
                                    <td> {{ $prem ->name }} </td>

                                    <td>{!! $prem->organization()->pluck("name")->implode('')!!} </td>
                                    <td> {{ $prem ->location }} </td>
                                    <td> {{ $prem ->address }} </td>
                                    <td>{{ $prem ->updated_at }}</td>
                                    <td>
                                     <?php if($prem->status == '1'){ ?> 
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
                                                <a  href="{{ route('PremiseInformation.edit',$prem->id)}}" class="" style="padding-right:20px"   id="smallButton"   data-placement="top" > Edit </a>  
                                        <!-- delete link -->
                                        <?php if($prem->status == '0'){ ?>
                                        <a wire:ignore.self href="#" wire:click="activate({{ $prem->id }})"  onclick="return confirm('Are you sure to want to Activate the premise?')" style="padding-right:20px; " > Activate </a>
                                        <?php }else{ ?>
                                        <a wire:ignore.self href="#" wire:click="deactivate({{ $prem->id }})"  onclick="return confirm('Are you sure to want to suspend the premise?')" style="padding-right:20px; " > Suspend</i> </a>
                                        <?php } ?>

                                        <a wire:ignore.self href="#" wire:click="destroy({{ $prem->id }})" onclick="return confirm('Are you sure to want to delete the premise?')" > Delete </a>

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
                        <div style="margin-left: 80%"  class="mt-1">{{ $premises->links() }}

                    </div>
                </div>
      
        </div>


         @include('livewire.premises.premise.modal')