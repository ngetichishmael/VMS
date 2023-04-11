
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
              <input  type="number" name="phone_number"  id="phone_number" class="form-control" required />
                <small class="form-text text-muted"> +254</small>
            </div>
              <div class="form-group">
                  <label class="form-label" for="basic-icon-default-fullname">Physical Address</label>
                  <input  type="text" name="physical_address" id="physical_address"  class="form-control" />
              </div>
              <div class="form-group">
                  <label class="form-label" for="basic-icon-default-fullname">Gender</label>
                  <select id="gender" name="gender" class="select2 form-control form-control-lg" required>
                      <option  value="#"> Select</option>
                      <option  value="male"> Male</option>
                      <option  value="female"> Female</option>
                      <option  value="other"> Other</option>
                  </select>
              </div>

            <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="organization_code" name="organization_code" class="select2 form-control form-control-lg">

                @foreach ($organizations as $organizat)
                    <option  value="{{ $organizat ->code }}"> {{ $organizat ->name }}</option>
                @endforeach
              </select>
            </fieldset>



            <fieldset class="form-group">
              <label class="form-label" for="user-role">Role</label>
              <select id="role_id" name="role_id" class="select2 form-control form-control-lg" required>
              <option  value="#"> Select</option>
                @foreach ($roles as $ros)
                    <option  value="{{ $ros ->id }}"> {{ $ros ->name }}</option>
                @endforeach
              </select>
            </fieldset>

{{--            <div class="form-group">--}}
{{--              <label class="form-label" for="basic-icon-default-fullname">Password</label>--}}
{{--              <input  type="password" name="password"  class="form-control" required />--}}
{{--            </div>--}}

            <button  type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->

     <!-- Modal to Edit user starts-->
     <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-edit-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" >

        {{ csrf_field() }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input  type="text" wire:model="name"  class="form-control" required />

            </div>

            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input  type="email" wire:model="email"  class="form-control" required />

              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input  type="tel" wire:model="phone_number"  class="form-control" required />

            </div>


            <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="organization_code" wire:model="organization_code" class="form-control">
               <option  value="#"> Select</option>
                @foreach ($organizations as $organ)
                    <option  value="{{ $organ ->id }}"> {{ $organ ->name }}</option>
                @endforeach
              </select>
            </fieldset>

            <fieldset class="form-group">
              <label class="form-label" for="user-role">Role</label>
              <select id="role_id" wire:model="role_id" class="form-control" required>
              <option  value="#"> Select</option>
                @foreach ($roles as $roll)
                    <option  value="{{ $roll ->id }}"> {{ $roll ->name }}</option>
                @endforeach
              </select>
            </fieldset>


            <button wire:click="editUserData" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Update') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to Edit user Ends-->

      <!-- Dashboard Ecommerce ends -->
      @push('scripts')
    <script>


        window.addEventListener('show-edit-org-modal', event =>{
            $('#modals-edit-slide-in').modal('show');
        });


    </script>
@endpush




              <!-- Modal to add new user starts-->
              <!-- <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                <div class="modal-dialog">
                  <form class="add-new-user modal-content pt-0" >
                  {{ csrf_field() }}
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                      <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                      <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                        <input  type="text" wire:model="name"  class="form-control" required />

                      </div>

                      <div class="form-group">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <input  type="email" wire:model="email"  class="form-control" required />

                        <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                      </div>
                      <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
                        <input  type="tel" wire:model="phone_number"  class="form-control" required />

                      </div>


                      <fieldset class="form-group">
                        <label class="form-label" for="user-role">Organization</label>
                        <select id="organization_code" wire:model="organization_code" class="form-control">
                         <option  value="#"> Select</option>
                          @foreach ($organizations as $organizat)
                              <option  value="{{ $organizat ->id }}"> {{ $organizat ->name }}</option>
                          @endforeach
                        </select>
                      </fieldset>

                      <fieldset class="form-group">
                        <label class="form-label" for="user-role">Role</label>
                        <select id="role_id" wire:model="role_id" class="form-control" required>
                        <option  value="#"> Select</option>
                          @foreach ($roles as $ros)
                              <option  value="{{ $ros ->id }}"> {{ $ros ->name }}</option>
                          @endforeach
                        </select>
                      </fieldset>



                      <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Password</label>
                        <input  type="password" wire:model="password"  class="form-control" required />
                      </div>

                      <button wire:click="store" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
                      <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                </div>
              </div> -->
              <!-- Modal to add new user Ends-->
