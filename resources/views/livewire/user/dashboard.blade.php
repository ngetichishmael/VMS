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
                                    <option  value="{{ $org ->code }}"> {{ $org ->name }}</option>
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
                    <div class="col-md-2">
                    <button type="button" class="btn btn-icon btn-outline-success" style="background-color: #1a3258; color:#fff; " data-toggle="modal" id="smallButton" data-target="#modals-slide-in"

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

                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>PhoneNumber</th>
                                    <th>Organization</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Last Login</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>



                            <tbody>
                            @forelse ($users as $key => $user)
                                <tr>


                                    <td> {{ $user ->name }} </td>

                                    <td>{{ $user ->email }}</td>
                                    <td> {{ $user ->phone_number }} </td>

                                    <td>{!! $user->organization()->pluck("name")->implode('')!!} </td>
                                    <td>{!! $user->role()->pluck("name")->implode('')!!} </td>

                                     <td>
                                     <?php if($user->status == '1'){ ?>
                                             <span class="badge badge-pill badge-light-success mr-1">Active</span>

                                     <?php }else{ ?>
                                             <span class="badge badge-pill badge-light-warning mr-1">Disabled</span>

                                      <?php } ?>

                                    </td>
                                    <td>{{ $user->last_login_at ?? 'Never Logged in' }}</td>

                                    <td>
                                        <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                        <a  href="{{ route('OrganizationUsers.edit',$user->id)}}" class="" style="padding-right:20px"   id="smallButton"   data-placement="top" > Edit </a>
                                        <!-- delete link -->
                                        <?php if($user->status == '0'){ ?>
                                
                                         <a wire:ignore.self href="#" wire:click="activate({{ $user->id }})" onclick="return confirm('Are you sure to want to Activate the User?') || event.stopImmediatePropagation();" style="padding-right:20px;">Activate</a>
                                        <?php }else{ ?>
                                        <a wire:ignore.self href="#" wire:click="deactivate({{ $user->id }})"  onclick="return confirm('Are you sure to want to suspend the User?')" style="padding-right:20px; " > Suspend</i> </a>
                                        <?php } ?>

{{--                                        <a wire:ignore.self href="#" wire:click="destroy({{ $user->id }})" onclick="return confirm('Are you sure to want to delete the User?')" > Delete </a>--}}

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

 @include('livewire.user.modal')
