
         <!-- Modal to add new shift starts-->
         <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
            <div class="modal-dialog">
                <form class="add-new-user modal-content pt-0" method="POST" action="{!! route('shifts.store') !!}">
                {{ csrf_field() }} 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">New Shift</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="form-group">
                    <label class="form-label" for="basic-icon-default-fullname">Shift Name</label>
                    <input  type="text" name="name"  class="form-control" required />
                    </div>
                    
                    <button  type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>


@push('scripts')
    <script>

        window.addEventListener('show-edit-shift-modal', event =>{
            $('#modals-edit-slide-in').modal('show');
        });

    
    </script>
@endpush