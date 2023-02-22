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
                            <label for="selectSmall">Block</label>
                            <select wire:model="blockId" class="form-control form-control-sm" >
                                <option value="">  All  </option>
                                @foreach ($blocks as $bro)
                                    <option  value="{{ $bro ->id }}"> {{ $bro ->name }}</option>
                                @endforeach  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="selectSmall">Select Per Page</label>
                            <select wire:model="perPage" class="form-control form-control-sm" id="selectSmall">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                    <button type="button" class="btn btn-icon btn-outline-success" style="background-color: #1877F2; color:#fff;"  data-toggle="modal" id="smallButton" data-target="#modals-slide-in" 
                            data-placement="top" > + Add Unit   
                        </button>
                    </div>
                </div>
            </div>
            <!-- users filter end -->
            {{-- @include('partials.loaderstyle') --}}
            <!-- list section start -->
            <div class="card">
                <div class="pt-0 card-datatable table-responsive">
                    <div class="card-datatable table-responsive">
                        <table class="table">
                            <thead>
                                <tr>        
                                   <th>Unit Name</th>
                                   <th>Block</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($units as $unit)
                                <tr>
                                   
                                    <td> {{ $unit ->name }} </td>
                                    <td>{!! $unit->block()->pluck("name")->implode('')!!} </td>
                                    <td>{{ $unit ->created_at }}</td>
                                    <td>
                                     <?php if($unit->status == '1'){ ?> 

                                        <a href="#" class="Active" style="color:#73A561;">Active</a>

                                        <?php }else{ ?> 

                                        <a href="#" class="inactive" style="color:#8B0000;">Disabled</a>

                                        <?php } ?>
                                    
                                    </td>
                                   
                                    <td>
<div class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-ellipsis-v"></i>
</a>
<div class="dropdown-menu">

        <!--update link-->
<a  wire:ignore.self href="#" class="" wire:click="editUnit({{ $unit->id }})" style="padding-right:20px"  data-toggle="modal" id="smallButton" data-target="#modals-edit-slide-in"  data-placement="top" > Edit </a>
<!-- delete link -->
<?php if($unit->status == '0'){ ?>
<a wire:ignore.self href="#" wire:click="activate({{ $unit->id }})"  onclick="return confirm('Are you sure to want to Activate the unit?')" style="padding-right:20px; " > Activate </a>
<?php }else{ ?>
<a wire:ignore.self href="#" wire:click="deactivate({{ $unit->id }})"  onclick="return confirm('Are you sure to want to suspend the unit?')" style="padding-right:20px; " > Suspend</i> </a>
<?php } ?>

<a wire:ignore.self href="#" wire:click="destroy({{ $unit->id }})" onclick="return confirm('Are you sure to want to delete the unit?')" > Delete </a>

</div>
</div>
</td>
                                </tr>

                                @empty
                                <tr>
                                <td colspan="4" style="text-align: center;"> No Record Found </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div style="margin-left: 80%"  class="mt-1">{{ $units->links() }}
                        </div>
                    </div>
                </div>
 
        </div>



         <!-- Modal to add new unit starts-->
    <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" >
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Unit</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Unit Name</label>
              <input  type="text" wire:model="name"  class="form-control" required />

            </div>
            <fieldset class="form-group">
              <label class="form-label" for="user-role">Premise Name</label>
              <select id="block_id"  wire:model="block_id" class="form-control">
                
                @foreach ($blocks as $block)
                    <option  value="{{ $block ->id }}"> {{ $block ->name }}</option>
                @endforeach  
              </select>
            </fieldset>
            
            <button wire:click="store" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new unit Ends-->

          <!-- Modal to edit unit starts-->
          <div wire:ignore.self class="modal modal-slide-in new-user-modal fade" id="modals-edit-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" >
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Edit Unit</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">unit Name</label>
              <input  type="text" wire:model="name"  class="form-control" required />

            </div>
            <fieldset class="form-group">
              <label class="form-label" for="user-role">Premise Name</label>
              <select id="block_id"  wire:model="block_id" class="form-control">
                
                @foreach ($blocks as $bloc)
                    <option  value="{{ $bloc ->id }}"> {{ $bloc ->name }}</option>
                @endforeach  
              </select>
            </fieldset>
            
            <button wire:click="editUnitData" type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Update') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new unit Ends-->



    @push('scripts')
    <script>
  

        window.addEventListener('show-edit-unit-modal', event =>{
            $('#modals-edit-slide-in').modal('show');
        });

    
    </script>
@endpush