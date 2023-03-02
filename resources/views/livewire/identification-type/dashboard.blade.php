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
                            data-placement="top" title="New Organazition">+ Add New Indentification
                           
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
                            @forelse ($types as $key => $type)
                                <tr>
                                     <td>{!! $key + 1 !!}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->updated_at }}</td>
                                    <td>
                                     <?php if($type->status == '1'){ ?> 
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
                                                <a  href="{{ route('IdentificationType.edit',$type->id)}}" class="" style="padding-right:20px"   id="smallButton"   data-placement="top" > Edit </a>  
                                        <!-- delete link -->
                                        <?php if($type->status == '0'){ ?>
                                        <a wire:ignore.self href="#" wire:click="activate({{ $type->id }})"  onclick="return confirm('Are you sure to want to Activate the Identification Type?')" style="padding-right:20px; " > Activate </a>
                                        <?php }else{ ?>
                                        <a wire:ignore.self href="#" wire:click="deactivate({{ $type->id }})"  onclick="return confirm('Are you sure to want to suspend the Identification Type?')" style="padding-right:20px; " > Suspend</i> </a>
                                        <?php } ?>

                                        <a wire:ignore.self href="#" wire:click="destroy({{ $type->id }})" onclick="return confirm('Are you sure to want to delete the Identification Type?')" > Delete </a>

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
                    <div style="margin-left: 80%"  class="mt-1">{{ $types->links() }}
                </div>
                </div>
            </div>
        </div>

        <!-- Modal to add new Indentification starts-->
        <div wire:ignore.self  class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
            <div class="modal-dialog">
                <form  class="add-new-user modal-content pt-0" method="POST" action="{!! route('IdentificationType.store') !!}">
                {{ csrf_field() }} 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">New Indentification Type</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Name</label>
                            <input  type="text" name="name"  class="form-control" required />
                        </div>


                        <button   type="submit"  class="btn btn-primary mr-1 data-submit"> Register </button>
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- <div wire:ignore.self  class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
            <div class="modal-dialog">
                <form wire:click="store" class="add-new-user modal-content pt-0"  >
              
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">New Indentification Type</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Name</label>
                            <input  type="text" wire:model="name"  class="form-control" required />
                        </div>


                        <button   type="submit"  class="btn btn-primary mr-1 data-submit"> Register </button>
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div> -->
    <!-- Modal to add new identification types Ends-->

         <!-- Modal to edit identification types  starts-->
         <div wire:ignore.self  class="modal modal-slide-in new-user-modal fade" id="modals-edit-slide-in">
            <div class="modal-dialog">
                <form  class="add-new-user modal-content pt-0"  >
              
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Identification Type</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Name</label>
                            <input  type="text" wire:model="name"  class="form-control" required />
                        </div>


                        <button wire:click="editIdentityTypeData"  type="submit"  class="btn btn-primary mr-1 data-submit"> Update </button>
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    <!-- Modal to edit identification types  Ends-->

    @push('scripts')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#addStudentModal').modal('hide');
            $('#editStudentModal').modal('hide');
            $('#deleteStudentModal').modal('hide');
        });

        window.addEventListener('show-edit-identitype-modal', event =>{
            $('#modals-edit-slide-in').modal('show');
        });

    
    </script>
@endpush