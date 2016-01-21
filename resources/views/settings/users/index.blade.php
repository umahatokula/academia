@extends('master')
@section('body')
<div class="row">
      
    <div class="col-md-12">

      <ul class="nav nav-tabs nav-tabs-justified">
        <li class="active">
          <a href="#1" data-toggle="tab">
            <span class="visible-xs"><i class="fa-home"></i></span>
            <span class="hidden-xs">List of Users</span>
          </a>
        </li>
        <li>
          <a href="#2" data-toggle="tab">
            <span class="visible-xs"><i class="fa-bell-o"></i></span>
            <span class="hidden-xs">Add new User</span>
          </a>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="1">
              <!-- Removing search and results count filter -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">List of Roles</h3>

                  <div class="panel-options">
                    <a href="#" data-toggle="panel">
                      <span class="collapse-icon">&ndash;</span>
                      <span class="expand-icon">+</span>
                    </a>
                    <a href="#" data-toggle="remove">
                      &times;
                    </a>
                  </div>
                </div>
                <div class="panel-body">

                  <script type="text/javascript">
                  jQuery(document).ready(function($)
                  {

                    // Replace checkboxes when they appear
                    var $state = $("#example-2 thead input[type='checkbox']");

                    $("#example-2").on('draw.dt', function()
                    {
                      cbr_replace();

                      $state.trigger('change');
                    });

                    // Script to select all checkboxes
                    $state.on('change', function(ev)
                    {
                      var $chcks = $("#example-2 tbody input[type='checkbox']");

                      if($state.is(':checked'))
                      {
                        $chcks.prop('checked', true).trigger('change');
                      }
                      else
                      {
                        $chcks.prop('checked', false).trigger('change');
                      }
                    });

                    $("#example-2").dataTable({
                      aLengthMenu: [
                        [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                      ]
                    });
                  });
                  </script>

                  <table class="table table-bordered table-striped" id="example-2">
                    <thead>
                      <tr>
                        <th class="no-sorting">
                          <input type="checkbox" class="cbr">
                        </th>
                        <th>Name</th>
                        <th>Role(s)</th>
                        <th>Email</th>
                        <th>Actions</th>
                      </tr>
                    </thead>

                    <tbody class="middle-align"><?php //dd($users->person); ?>
                    @foreach($users as $user)
                      <tr>
                        <td>
                          <input type="checkbox" class="cbr">
                        </td>
                        <td>{!! ($user->staff->fname.' '.$user->staff->lname) !!}</td>
                        <td>
                          @foreach($user->roles  as $role)
                            {!! $role->name  !!}<br>
                          @endforeach
                        </td>
                        <td>{!! $user->email !!}</td>
                        <td>
                          <a href="{!! route('settings.users.edit', array($user->id)) !!}" data-target="#responsiveModal" data-toggle="modal" class="btn btn-secondary btn-sm btn-icon icon-left">
                            Edit
                          </a>

                          <a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                            Delete
                          </a>

                          <a href="{!! route('admin.staff.show', array(Sentinel::getUser()->staff_id )) !!}" class="btn btn-info btn-sm btn-icon icon-left">
                            Profile
                          </a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>

                </div>
              </div>
        </div>
        <div class="tab-pane" id="2">
              <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Add new User</h3>
                        <div class="panel-options">
                          <a href="#" data-toggle="panel">
                            <span class="collapse-icon">&ndash;</span>
                            <span class="expand-icon">+</span>
                          </a>
                          <a href="#" data-toggle="remove">
                            &times;
                          </a>
                        </div>
                      </div>
                      <div class="panel-body"> 
                      @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif

                        <!-- <form role="form" class="form-horizontal" role="form"> -->
                         {!! Form::open(array('route' => 'settings.users.store', 'class' => 'form-horizontal', 'role' => 'form')) !!}

                          <div class="form-group">
                            <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                            {!! Form::label('user', 'User', array('class' => 'col-sm-4 control-label', 'for' => 'user')) !!}

                            <div class="col-sm-6">
                              <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                              {!! Form::select('user', $staff, null, array('class' => 'form-control', 'id' => 'user', 'required')) !!}
                            </div>

                          </div>

                          <div class="form-group-separator"></div>

                          <div class="form-group">
                            <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                            {!! Form::label('password', 'Password', array('class' => 'col-sm-4 control-label', 'for' => 'password')) !!}

                            <div class="col-sm-6">
                              <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                              {!! Form::password('password', array('class' => 'form-control', 'id' => 'password', 'required')) !!}
                            </div>

                          </div>

                          <div class="form-group-separator"></div>

                          <div class="form-group">
                            {!! Form::label('roles', 'Assign Role(s)', array('class' => 'col-sm-4 control-label', 'for' => 'assign_permission')) !!}

                            <div class="col-sm-6">
                            <script type="text/javascript">
                              jQuery(document).ready(function($)
                              {
                                $("#assign_roleszzz").multiSelect({
                                  afterInit: function()
                                  {
                                    // Add alternative scrollbar to list
                                    this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar();
                                  },
                                  afterSelect: function()
                                  {
                                    // Update scrollbar size
                                    this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar('update');
                                  }
                                });
                              });
                            </script>
                            {!! Form::select('assign_roles[]', $roles, null, array('class' => 'form-control', 'id' => 'assign_roles', 'multiple' => 'multiple', 'required')) !!}
                            </div>
                          </div>

                          <div class="form-group-separator"></div>

                          <div class="form-group">
                            {!! Form::label('assign_permission', 'Exempt Permissions', array('class' => 'col-sm-4 control-label', 'for' => 'assign_permission')) !!}

                            <div class="col-sm-6">
                            <script type="text/javascript">
                              jQuery(document).ready(function($)
                              {
                                $("#exempt_permissionzzz").multiSelect({
                                  afterInit: function()
                                  {
                                    // Add alternative scrollbar to list
                                    this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar();
                                  },
                                  afterSelect: function()
                                  {
                                    // Update scrollbar size
                                    this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar('update');
                                  }
                                });
                              });
                            </script>
                            {!! Form::select('exempt_permission[]', $permissions, null, array('class' => 'form-control', 'id' => 'exempt_permission', 'multiple' => 'multiple')) !!}
                            </div>
                          </div>

                          <div class="form-group-separator"></div>

                          <div class="form-group">
                            {!! Form::label('assign_permission', ' ', array('class' => 'col-sm-2 control-label', 'for' => 'assign_permission')) !!}

                            <div class="col-sm-4">
                            {!! Form::submit('Add User', array('class' => 'btn btn-blue', 'id' => 'add-user')) !!}
                            </div>

                          </div>

                        <!-- </form> -->
                      {!! Form::close() !!}
                      </div>
              </div>
        </div>
      </div>

    </div>
</div>
<div id="stage"></div>
@stop

@section('page_css')
<!-- Imported styles on this page -->
  <link rel="stylesheet" href="{!! asset('assets/js/daterangepicker/daterangepicker-bs3.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/select2/select2.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/select2/select2-bootstrap.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/multiselect/css/multi-select.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/datatables/dataTables.bootstrap.css') !!}">
@stop


@section('page_js')
  <script src="{!! asset('assets/js/daterangepicker/daterangepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/datepicker/bootstrap-datepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/timepicker/bootstrap-timepicker.min.js') !!}"></script>
  <script src="{!! asset('assets/js/colorpicker/bootstrap-colorpicker.min.js') !!}"></script>
  <script src="{!! asset('assets/js/select2/select2.min.js') !!}"></script>
  <script src="{!! asset('assets/js/jquery-ui/jquery-ui.min.js') !!}"></script>
  <script src="{!! asset('assets/js/selectboxit/jquery.selectBoxIt.min.js') !!}"></script>
  <script src="{!! asset('assets/js/tagsinput/bootstrap-tagsinput.min.js') !!}"></script>
  <script src="{!! asset('assets/js/typeahead.bundle.js') !!}"></script>
  <script src="{!! asset('assets/js/handlebars.min.js') !!}"></script>
  <script src="{!! asset('assets/js/multiselect/js/jquery.multi-select.js') !!}"></script>
  <!-- Imported styles on this page -->
  <script src="{!! asset('assets/js/daterangepicker/daterangepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/datepicker/bootstrap-datepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/timepicker/bootstrap-timepicker.min.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/js/jquery.dataTables.min.js') !!}"></script>
  <script src="{!! asset('assets/js/rwd-table/js/rwd-table.min.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/dataTables.bootstrap.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}"></script>
      <script type="text/javascript" language="javascript">
         $(document).ready(function() {
            $("#assign_roles").change(function(event){
            //   // alert('sfjie');
            //    $('#exempt_permission').load('{!! url('settings/ajax/userPermissions') !!}', function(responseText, statusText, xhr){
            //       if(statusText == "success")
            //             // alert("Successfully loaded the content!");
            //             $('#exempt_permission').html(responseText.options);
            //             console.log(responseText);
            //       if(statusText == "error")
            //             alert("An error occurred: " + xhr.status + " - " + xhr.statusText);
            //    });
                var role_ids    = $('#assign_roles').val();
            if(role_ids){
              // console.log(role_ids);
                window.permissions = [];
                  jQuery.each(role_ids, function(index, role_id) {
                     // console.log(role_id);
                     $.ajax({
                      url         : "{{ url('settings/ajax/rolePermissions') }}",
                      type        : 'POST',
                      cache       : false,
                      data        : { 'role_id' : role_id },
                      datatype    : 'json',
                      beforeSend: function() {
                          //something before send
                      },
                      success: function(responseText) {
                          // console.log(responseText.options);

                          //call makeOptions function
                          // var permissions = makeOptions(responseText.options);
                          //   console.log(responseText.options)
                          //   $("#exempt_permission").html(permissions);
                          console.log(responseText.options);

                          var options = '<option value="0"> </option>';
                          jQuery.each(responseText.options, function(index, option) {
                            options += '<option value="' + index+1 + '">' + option + '</option>';
                          });

                          $("#exempt_permission").html(options);

                          // jQuery.each(responseText.options, function(index, permission) {
                          //   permissions.push(permission);
                          // });
                          // console.log(permissions);
                          // jQuery('#processFranchiseItems').modal('show', {backdrop: 'fade'});
                      },
                      error: function(xhr,textStatus,thrownError) {
                          console.log(xhr);
                          console.log(textStatus);
                          console.log(thrownError);
                      }
                    });
                          // console.log(permissions);
                  });
                          // console.log(permissions);
                          $('#stage').html(permissions);
            }else{
                $("#exempt_permission").html(' ');
            }
            });

          
         });
      </script>
@stop