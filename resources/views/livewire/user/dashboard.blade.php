@extends('layouts.contentLayoutMaster')

@section('title', 'Users')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('fonts/font-awesome/css/font-awesome.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/jstree.min.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}

    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-tree.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <section>
            <!-- users filter start -->
            {{-- message --}}
        {!! Toastr::message() !!}

            <div class="card">
                <h5 class="card-header">Search Filter</h5>
                <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
                    <div class="col-md-4 user_role">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search"></i></span>
                            </div>
                            <input type="search" id="search" class="form-control" name="search"
                              placeholder="Search" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="selectSmall">Select Per Page</label>
                            <select class="form-control form-control-sm" id="selectSmall" id="table1">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="selectSmall">Sort</label>
                            <select class="form-control form-control-sm" id="selectSmall">
                                <option value="1">Ascending</option>
                                <option value="0">Descending</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-icon btn-outline-success" data-toggle="modal" id="smallButton" data-target="#modals-slide-in" 
                            data-placement="top" title="New User">
                            <img src="{{ asset('images/icons/exceal.png') }}"alt="Add" width="20" height="20">
                               
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
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>PhoneNumber</th>
                                    <th>Organization</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Check Out</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                            @foreach ($users as $user)
                                <tr>
                                    <td> {{ $user ->id }} </td>
                                    <td> {{ $user ->name }} </td>
                                    <td> {{ $user ->username }} </td>
                                    <td>{{ $user ->email }}</td>
                                    <td> {{ $user ->phone_number }} </td>
                                    <td>{{ $user ->org_name }} </td>
                                     <td>
                                     <?php if($user->status == '1'){ ?> 

                                        <a href="#" class="Active" style="color:#00FF00;">Active</a>

                                        <?php }else{ ?> 

                                        <a href="#" class="inactive" style="color:#FF0000;">Inactive</a>

                                        <?php } ?>
                                    
                                    </td>
                                    <td>{{ now() }}</td>
                                    <td>{{ now() }}</td>
                                    <td>
                                            <!--update link-->
                                        <a href="{{ url('organization/users/'.$user->id) }}" class=""style="padding-right:20px"  data-toggle="modal" id="smallButton" data-target="#modals-edit-slide-in"  data-placement="top" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <!-- delete link -->
                                    
                                        <a href="{{ url('organization/users/delete/'.$user->id) }}" onclick="return confirm('Are you sure to want to delete the user?')" title="Delete"> <i class="fas fa-trash"></i></a>
                                    
                                 
                                    </td>
                                </tr>
                              
                            @endforeach

                            </tbody>
                            <tbody id="Content" class="searchdata"></tbody>
                        </table>
             

                        <div class="mt-1">
                  
                        </div>
                    </div>
                </div>
        </section>
        </div>

         <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{{ route('OrganizationUsers.store') }}">
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New User</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input
                type="text"
                name="name" 
                :value="old('name')"
                class="form-control dt-full-name"
                id="basic-icon-default-fullname"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-uname">Username</label>
              <input
                type="text"
                name="username" 
                :value="old('username')"
                class="form-control dt-uname"
                aria-describedby="basic-icon-default-uname2"
                name="user-name"
              />
            </div>
            
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input
                type="email"
                name="email" 
                :value="old('email')"
                class="form-control dt-email"
                aria-describedby="basic-icon-default-email2"
                name="user-email"
              />
              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input
                type="tel"
                class="form-control dt-full-name"
                name="phone_number" 
                :value="old('phone_number')"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>



            <fieldset class="form-group">
              <label class="form-label" for="user-role">Organization</label>
              <select id="org" name="org" class="form-control">
                
                @foreach ($organizations as $organizations)
                    <option id="org" name="org" value="{{ $organizations ->id }}"> {{ $organizations ->org_name }}</option>
                @endforeach  
              </select>
            </fieldset>




            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Password</label>
              <input
                type="password"
                class="form-control dt-full-name"
                name="password" 
                :value="old('password')"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>
            
            <button type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->

    <!-- Modal to edit user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-edit-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" method="POST" action="{{ route('OrganizationUsers.store') }}">
        {{ csrf_field() }} 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input
                type="text"
                name="name" 
                value="{{ $data[0]->name }}"
                class="form-control dt-full-name"
                id="basic-icon-default-fullname"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-uname">Username</label>
              <input
                type="text"
                name="username" 
                value="{{ $data[0]->username }}"
                class="form-control dt-uname"
                aria-describedby="basic-icon-default-uname2"
                name="user-name"
              />
            </div>
            
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input
                type="email"
                name="email" 
                value="{{ $data[0]->email }}"
                class="form-control dt-email"
                aria-describedby="basic-icon-default-email2"
                name="user-email"
              />
              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Phone Number</label>
              <input
                type="tel"
                class="form-control dt-full-name"
                name="phone_number" 
                value="{{ $data[0]->phone_number }}"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>



            <fieldset class="form-group">
              <label class="form-label" for="user-role">Status</label>
              <select id="org" name="org" class="form-control">
                
              <option id="org" name="org" value="1"> Active</option>
              <option id="org" name="org" value="1"> Inactive</option>
            </select>
            </fieldset>



            
            <button type="submit" class="btn btn-primary mr-1 data-submit">     {{ __('Register') }} </button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to edit user Ends-->

        <h2 class="brand-text">TODO ON USERS</h2>
        <div class="card-body">
            <div id="jstree-basic">
                <ul>
                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>
                        CRUD
                        <ul>
                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Create</li>
                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Read</li>
                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Updated</li>
                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Delete</li>
                        </ul>
                    </li>
                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>
                        Relationship
                        <ul data-jstree='{"icon" : "far fa-folder"}'>
                            <li data-jstree='{"icon" : "far fa-file-image"}'>Organization</li>
                            <li data-jstree='{"icon" : "far fa-file-image"}'>Hierarchy under Organization</li>
                        </ul>
                    </li>
                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>
                        Table
                        <ul>
                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Filter</li>
                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Pagination</li>
                            <li data-jstree='{"icon" : "fab fa-node-js"}'>Search by *</li>
                        </ul>
                    </li>
                    <li data-jstree='{"icon" : "fab fa-html5"}'>Any Other</li>
                    <li data-jstree='{"icon" : "fab fa-html5"}'>Martin from Advise</li>
                    <li data-jstree='{"icon" : "fab fa-html5"}'>Isaac to Provide images, and secondary colors</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->

    
@endsection



@section('vendor-script')


<script type="text/javascript">
      
      $('#search').on('keyup',function()
      {
       $value=$(this).val();
       
       if($value)
       {
        $('.alldata').hide();
        $('.searchdata').show();
       }
       else{
        $('.alldata').show();
        $('.searchdata').hide();
       }
       $.ajax({

            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'search':$value},
           
     success:function(data)
     {
            $('#Content').html(data);
    }
    });
    })
    </script>



    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/jstree.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/simple-datatables.js')) }}"></script>

    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-tree.js')) }}"></script>
@endsection
