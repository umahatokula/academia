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
                        <a href="{!! route('admin.students.create') !!}" class="btn btn-secondary ">new student</a>
                        <a href="{!! route('admin.students.index') !!}" class="btn btn-purple ">all students</a>
                      </div>
      </div>
  <div class="panel panel panel-flat">
                      <div class="panel-heading">
                        <h3 class="panel-title">{!! $student->fname !!}'s Profile</h3>
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
                <b>Class</b>: 
              </li>
              <li>
                <i class="fa-briefcase"></i>
                <b>Parent</b>:{!! $student->studentParent->fname.' '.$student->studentParent->lname !!}
              </li>
            </ul> 
                
              <hr />
              
              <a href="{!! route('admin.students.edit', array($student->id)) !!}" class="btn btn-secondary btn-xm btn-icon icon-left"  >edit</a>
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
                        <td>{!! $student->fname.' '.$student->mname.' '.$student->lname !!}</td>
                      </tr>
                      <tr>
                        <td>Gender</td>
                        <td>{!! $student->gender->gender !!}</td>
                      </tr>
                      
                      <tr>
                        <td>Email</td>
                        <td></td>
                      </tr>

                      <tr>
                        <td>Phone</td>
                        <td>{!! $student->phone !!}</td>
                      </tr>

                      <tr>
                        <td>Country</td>
                        <td>{!! $student->country->name !!}</td>
                      </tr>
                      
                      <tr>
                        <td>State</td>
                        <td>{!! $student->state->name !!}</td>
                      </tr>
                      
                      <tr>
                        <td>LGA</td>
                        <td>{!! $student->local->local_name !!}</td>
                      </tr>

                      <tr>
                        <td>Address</td>
                        <td>
                          <address>
                          {!! $student->address !!}</td>
                          </address>
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