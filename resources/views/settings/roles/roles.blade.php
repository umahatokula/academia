@extends('master')
@section('body')
<div class="row">
      
        <div class="col-md-12">
          
          <ul class="nav nav-tabs nav-tabs-justified">
            <li class="active">
              <a href="#1" data-toggle="tab">
                <span class="visible-xs"><i class="fa-home"></i></span>
                <span class="hidden-xs">Roles</span>
              </a>
            </li>
            <li>
              <a href="#2" data-toggle="tab">
                <span class="visible-xs"><i class="fa-bell-o"></i></span>
                <span class="hidden-xs">Permissions</span>
              </a>
            </li>
          </ul>
          
          <div class="tab-content">
            <div class="tab-pane active" id="1">
              
      
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Add new Role</h3>
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
              
                      <!-- <form role="form" class="form-horizontal" role="form"> -->
                       {!! Form::open(array('route' => 'settings.roles.store', 'class' => 'form-horizontal', 'role' => 'form')) !!}
              
                        <div class="form-group">
                          <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                          {!! Form::label('role', 'Role', array('class' => 'col-sm-4 control-label', 'for' => 'role')) !!}
              
                          <div class="col-sm-6">
                            <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                            {!! Form::text('role', null, array('class' => 'form-control', 'id' => 'role')) !!}
                          </div>

                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                          {!! Form::label('assign_permission', 'Assign Permissions', array('class' => 'col-sm-4 control-label', 'for' => 'assign_permission')) !!}
              
                          <div class="col-sm-6">
                          <script type="text/javascript">
                            jQuery(document).ready(function($)
                            {
                              $("#assign_permissions").multiSelect({
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
                          {!! Form::select('assign_permission[]', $permissions, null, array('class' => 'form-control', 'id' => 'assign_permissions', 'multiple' => 'multiple')) !!}
                          </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                          {!! Form::label('assign_permission', ' ', array('class' => 'col-sm-2 control-label', 'for' => 'assign_permission')) !!}
              
                          <div class="col-sm-4">
                          {!! Form::submit('add role', array('class' => 'btn btn-blue')) !!}
                          </div>

                        </div>

                      <!-- </form> -->
                    {!! Form::close() !!}
                    </div>
                  </div>

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
                      
                      <table class="table table-bordered table-striped" id="example-2">
                        <thead>
                          <tr>
                            <th class="no-sorting">
                              <input type="checkbox" class="cbr">
                            </th>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        
                        <tbody class="middle-align">
                        @foreach($roles as $role)
                          <tr>
                            <td>
                              <input type="checkbox" class="cbr">
                            </td>
                            <td>{!! $role->name !!}</td>
                            <td>{!! $role->permissions !!}</td>
                            <td>
                              
                              <a href="#" class="btn btn-info btn-sm btn-icon icon-left">
                                Details
                              </a>
                              <a href="#" class="btn btn-secondary btn-sm btn-icon icon-left">
                                Edit
                              </a>
                              
                              <a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                                Delete
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
                      <h3 class="panel-title">Add new Privilege</h3>
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
              
                      <!-- <form role="form" class="form-horizontal" role="form"> -->
                       {!! Form::open(array('route' => 'settings.privileges.store', 'class' => 'form-horizontal', 'role' => 'form')) !!}
              
                        <div class="form-group">
                          <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                          {!! Form::label('privilege', 'Privilege', array('class' => 'col-sm-2 control-label', 'for' => 'privilege')) !!}
              
                          <div class="col-sm-6">
                            <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                            {!! Form::text('privilege', null, array('class' => 'form-control', 'id' => 'privilege')) !!}
                          </div>

                          <div class="col-sm-4">
                          {!! Form::submit('add privilege', array('class' => 'btn btn-blue')) !!}
                          </div>
                        </div>

                      <!-- </form> -->
                    {!! Form::close() !!}
                    </div>
                  </div>

                  <!-- Removing search and results count filter -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">List of Permissions</h3>
                      
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
                      
                      <table class="table table-bordered table-striped" id="example-2">
                        <thead>
                          <tr>
                            <th class="no-sorting">
                              <input type="checkbox" class="cbr">
                            </th>
                            <th>Permission</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        
                        <tbody class="middle-align">
                          @foreach($allPersmissions as $permission)
                          <tr>
                            <td>
                              <input type="checkbox" class="cbr">
                            </td>
                            <td>{!! $permission->permission !!}</td>
                            <td>{!! $permission->status !!}</td>
                            <td>
                              <a href="#" class="btn btn-secondary btn-sm btn-icon icon-left">
                                Edit
                              </a>
                              
                              <a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                                De-activate
                              </a>
                              
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      
                    </div>
                  </div>
            </div>
          </div>
          
        </div>
      </div>
@stop

@section('page_css')
<!-- Imported styles on this page -->
  <link rel="stylesheet" href="{!! asset('assets/js/daterangepicker/daterangepicker-bs3.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/select2/select2.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/select2/select2-bootstrap.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/js/multiselect/css/multi-select.css') !!}">
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
@stop