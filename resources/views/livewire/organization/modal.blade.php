
              <!-- Modal to add new organzation starts-->
    <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{!! route('OrganizationInformation.store') !!}">
        {{ csrf_field() }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Organization</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Name</label>
              <input  type="text" name="name"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input  type="email" name="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input  type="tel" name="primary_phone"  class="form-control" required />

            </div>

            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Alternative Phone Number</label>
              <input  type="tel" name="secondary_phone"  class="form-control" placeholder="Optional ...." />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Location</label>
              <input  type="text" name="location"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Website Url</label>
              <input  type="text" name="websiteUrl"  class="form-control"  />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Description</label>
              <input  type="text" name="description"  class="form-control"  />

            </div>

            <button  type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>



    <!-- <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" >
        {{ csrf_field() }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Organization</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Name</label>
              <input  type="text" wire:model="name"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input  type="email" wire:model="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input  type="tel" wire:model="primary_phone"  class="form-control" required />

            </div>

            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Alternative Phone Number</label>
              <input  type="tel" wire:model="secondary_phone"  class="form-control" placeholder="Optional ...." required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Location</label>
              <input  type="text" wire:model="location"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Website Url</label>
              <input  type="text" wire:model="websiteUrl"  class="form-control" required />

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

    <!-- Modal to add new organzation Ends-->

     <!-- Modal to Edit organzation starts-->
     <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-edit-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" >
        {{ csrf_field() }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Edit Organization</h5>
          </div>
          <div class="modal-body flex-grow-1">
          <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Name</label>
              <input  type="text" wire:model="name"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input  type="email" wire:model="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input  type="tel" wire:model="primary_phone"  class="form-control" required />

            </div>

            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Alternative Phone Number</label>
              <input  type="tel" wire:model="secondary_phone"  class="form-control" placeholder="Optional ...." />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Location</label>
              <input  type="text" wire:model="location"  class="form-control" required />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Website Url</label>
              <input  type="text" wire:model="websiteUrl"  class="form-control"  />

            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Description</label>
              <input  type="text" wire:model="description"  class="form-control" />

            </div>

            <button wire:click="editOrganizationData" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Update') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to Edit user Ends-->


