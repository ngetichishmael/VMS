
         <!-- Modal to add new unit starts-->
    <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{!! route('UnitInformation.store') !!}">
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Unit</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Unit Name</label>
              <input  type="text" name="name"  class="form-control" required />

            </div>

            <fieldset class="form-group">
              <label class="form-label" for="user-role">Premise Name</label>
              <select id="block_id"  name="block_id" class="select2 form-control form-control-lg">
                @foreach ($blocks as $block)
                    <option  value="{{ $block ->id }}"> {{ $block ->name }}</option>
                @endforeach  
              </select>
            </fieldset>
            
            <button type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new unit Ends-->
