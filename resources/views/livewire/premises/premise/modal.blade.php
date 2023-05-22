 <!-- Modal to add new premise starts-->

          <div wire:ignore.self  class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{!! route('PremiseInformation.store') !!}">
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Premise</h5>
          </div>
          <div class="modal-body flex-grow-1">

          <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="organization_code" name="organization_code" class="select2 form-control form-control-lg">
               <option  value="#"> Select</option>
                @foreach ($organizations as $organizat)
                    <option  value="{{ $organizat ->code }}"> {{ $organizat ->name }}</option>
                @endforeach  
              </select>
            </fieldset>
            
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Name</label>
              <input  type="text" name="name"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Address</label>
              <input  type="text" name="address"  class="form-control" required />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Location</label>
              <input  type="text" name="location"  class="form-control" required />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Description</label>
              <input  type="text" name="description"  class="form-control" required />
            </div>

            
            
            <button type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>

<!--     
   <div wire:ignore.self  class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" >
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Premise</h5>
          </div>
          <div class="modal-body flex-grow-1">

          <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="organization_code" wire:model="organization_code" class="form-control">
           
              </select>
            </fieldset>
            
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Name</label>
              <input  type="text" wire:model="name"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Address</label>
              <input  type="text" wire:model="address"  class="form-control" required />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Location</label>
              <input  type="text" wire:model="location"  class="form-control" required />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Description</label>
              <input  type="text" wire:model="description"  class="form-control" required />
            </div>

            
            
            <button wire:click="store" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div> -->
    <!-- Modal to add new premise Ends-->



         <!-- Modal to edit premise starts-->
   <div wire:ignore.self  class="modal modal-slide-in new-user-modal fade" id="modals-edit-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" >
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Edit Premise</h5>
          </div>
          <div class="modal-body flex-grow-1">
     
          <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="organization_code" wire:model="organization_code" class="form-control">
               <option  value="#"> Select</option>
                @foreach ($organizations as $organ)
                    <option  value="{{ $organ ->id }}"> {{ $organ ->name }}</option>
                @endforeach  
              </select>
            </fieldset>
  
            
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Name</label>
              <input  type="text" wire:model="name"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Address</label>
              <input  type="text" wire:model="address"  class="form-control" required />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Location</label>
              <input  type="text" wire:model="location"  class="form-control" required />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Description</label>
              <input  type="text" wire:model="description"  class="form-control" required />
            </div>

            <button wire:click="editPremiseData" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Update') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to Edit premise Ends-->


    @push('scripts')
    <script>
  

        window.addEventListener('show-edit-premise-modal', event =>{
            $('#modals-edit-slide-in').modal('show');
        });

    
    </script>
@endpush