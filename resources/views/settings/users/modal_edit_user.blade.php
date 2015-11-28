<div class="row">
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
                        {!! Form::model($user, array('route' => array('settings.users.update', $user->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form')) !!}

                          <div class="form-group">
                            <!-- <label class="col-sm-2 control-label" for="field-1">Input text field</label> -->
                            {!! Form::label('user', 'User', array('class' => 'col-sm-4 control-label', 'for' => 'user')) !!}

                            <div class="col-sm-6">
                              <!-- <input type="text" class="form-control" id="field-1" placeholder="Placeholder"> -->
                              {!! Form::select('user', $staff, $user->staff_id, array('class' => 'form-control', 'id' => 'user', 'required')) !!}
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
                            {!! Form::select('assign_roles[]', $roles, $user_roles, array('class' => 'form-control', 'id' => 'assign_roles', 'multiple' => 'multiple', 'required')) !!}
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
                            {!! Form::submit('Edit User', array('class' => 'btn btn-blue', 'id' => 'add-user')) !!}
                            </div>

                          </div>

                        <!-- </form> -->
                      {!! Form::close() !!}
                      </div>
</div>