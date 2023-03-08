<!-- Modal to add new user starts-->
              <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{!! route('OrganizationUsers.store') !!}">
        {{ csrf_field() }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New User</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input  type="text" name="name"  class="form-control" required />

            </div>

            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input  type="email" name="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input  type="tel" name="phone_number"  class="form-control" required />

            </div>

            <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="organization_code" name="organization_code" class="form-control">
               <option  value="#"> Select</option>
                @foreach ($organizations as $organizat)
                    <option  value="{{ $organizat ->code }}"> {{ $organizat ->name }}</option>
                @endforeach
              </select>
            </fieldset>

            <fieldset class="form-group">
              <label class="form-label" for="user-role">Role</label>
              <select id="role_id" name="role_id" class="form-control" required>
              <option  value="#"> Select</option>
                @foreach ($roles as $ros)
                    <option  value="{{ $ros ->id }}"> {{ $ros ->name }}</option>
                @endforeach
              </select>
            </fieldset>

            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Password</label>
              <input  type="password" name="password"  class="form-control" required />
            </div>

            <button  type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->



