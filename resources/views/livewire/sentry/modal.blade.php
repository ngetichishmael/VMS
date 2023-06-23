
    <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
        <div class="modal-dialog">
            <form class="add-new-user modal-content pt-0" method="POST" action="{!! route('Sentry.store') !!}">
                {{ csrf_field() }}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">New Sentry</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Name</label>
                        <input type="text" name="name" class="form-control" required />

                    </div>


                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-email">Phone Number</label>
                        <input type="tel" name="phone_number" class="form-control" required />

                        <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="user-role">ID Number</label>
                            <input type="number" id="ID_number" name="ID_number" class="form-control"  required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="user-role">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"  required/>
                    </div>

                    <div class="form-group">
                            <label class="form-label" for="user-role">Gender</label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="user-role">Physical Address</label>
                            <input type="text" id="physical_address" name="physical_address" class="form-control" required  />
                    </div>

                      <fieldset class="form-group">
                        <label class="form-label" for="user-role">Premise</label>
                        <select id="premise_id" name="premise_id" class="select2 form-control form-control-lg" required >
                            @foreach ($premises as $pre)
                                <option value="{{ $pre->id }}"> {{ $pre->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                    <fieldset class="form-group">
                        <label class="form-label" for="user-role">Shift</label>
                        <select id="shift_id" name="shift_id" class="select2 form-control form-control-lg">
                            @foreach ($shifts as $shift)
                                <option value="{{ $shift->id }}"> {{ $shift->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>


                    <button type="submit" class="btn btn-primary mr-1 data-submit"> {{ __('Register') }} </button>
                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal to add new sentry Ends-->
