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