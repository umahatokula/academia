@extends('master')
@section('body')
<div class="row">
  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Page Navigation</h3>
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
                        <a href="{!! route('admin.staff.create') !!}" class="btn btn-secondary ">new staff</a>
                        <a href="{!! route('admin.staff.index') !!}" class="btn btn-purple ">all staff</a>
                      </div>
      </div>
  <div class="panel panel panel-flat">
                      <div class="panel-heading">
                        <h3 class="panel-title">{!! $staff->fname !!}'s Profile</h3>
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
          <div class="col-sm-3">
            <div class="panel panel-default panel-border panel-shadow">
            
            <!-- User Info Sidebar -->
            <div class="user-info-sidebar">
              
              <center>
                <a href="#" class="user-img">
                  <img src="{!! asset('assets/images/user-4.png') !!}" alt="user-img" class="img-cirlce img-responsive img-thumbnail" />
                </a>
              </center>
              
              <hr />
              
              <ul class="list-unstyled user-info-list">
              <li>
                <i class="fa-home"></i>
                Staff Type: {!! $staff->staffType->staff_type !!}
              </li>
              <li>
                <i class="fa-briefcase"></i>
                Grade Level:
              </li>
            </ul> 
                
              <hr />
              
              <a href="{!! route('admin.staff.edit', array($staff->id)) !!}" class="btn btn-secondary btn-xm btn-icon icon-left"  >Edit</a>
            </div>
            </div>
          </div>
          
          <div class="col-sm-9">
            <div class="panel panel-default panel-border panel-shadow">
            <div class="panel-body"><?php //dd($profile->gender); ?>
              <table class="table table-condensed  table-hover">
                    <tbody>
                      <tr>
                        <td style="width:25%">Name</td>
                        <td>{!! $staff->fname.' '.$staff->mname.' '.$staff->lname !!}</td>
                      </tr>
                      <tr>
                        <td>Gender</td>
                        <td>{!! $staff->gender->gender !!}</td>
                      </tr>
                      
                      <tr>
                        <td>Email</td>
                        <td>{!! $staff->email !!}</td>
                      </tr>

                      <tr>
                        <td>Phone</td>
                        <td>{!! $staff->phone !!}</td>
                      </tr>

                      <tr>
                        <td>Country</td>
                        <td>{!! $staff->country->name !!}</td>
                      </tr>
                      
                      <tr>
                        <td>State</td>
                        <td>{!! $staff->state->name !!}</td>
                      </tr>
                      
                      <tr>
                        <td>LGA</td>
                        <td>{!! $staff->local->local_name !!}</td>
                      </tr>

                      <tr>
                        <td>Address</td>
                        <td>
                          <address>
                          {!! $staff->address !!}</td>
                          </address>
                        </td>
                      </tr>
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
@stop


@section('page_js')

@stop