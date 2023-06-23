  <!-- Modal to add new block starts-->
    <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{!! route('BlockInformation.store') !!}">
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Block</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Block Name</label>
              <input  type="text" name="name"  class="form-control" required />

            </div>
            <fieldset class="form-group">
              <label class="form-label" for="user-role">Premise Name</label>
              <select id="premise_id"  name="premise_id" class="select2 form-control form-control-lg">
                @foreach ($premises as $premise)
                    <option  value="{{ $premise ->id }}"> {{ $premise ->name }}</option>
                @endforeach  
              </select>
            </fieldset>
            
            <button type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new block Ends-->

        