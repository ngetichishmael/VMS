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

                    <div class="col-md-2">
                    <button type="button" class="btn btn-icon btn-outline-success" style="background-color:  #1a3258; color:#fff;" data-toggle="modal" id="smallButton" data-target="#modals-slide-in"

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
                                                <a  href="{{ route('OrganizationInformation.edit',$org->id)}}" class="" style="padding-right:20px"   id="smallButton"   data-placement="top" > Edit </a>                     
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


        @include('livewire.organization.modal')

        