@extends('master')
@section('body')
<div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Page Nav</h3>
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
            <a href="{!! route('billing.fee_elements.create') !!}"  class="btn btn-secondary btn-sx">add element</a>
          </div>
          </div>
        </div>
      </div>
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Fee Elements</h3>
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
                    $("#example-1").dataTable({
                      aLengthMenu: [
                        [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                      ]
                    });
                  });
                  </script>
            <table class="table table-bordered table-stripped" id="example-1">
              <thead>
                <tr>
                  <td style="text-align:center">S/N</td>
                  <td style="text-align:center">Code</td>
                  <td style="text-align:center">Name</td>
                  <td style="text-align:center">Description</td>
                  <td style="text-align:center">Status</td>
                  <td style="text-align:center">Actions</td>
                </tr>
              </thead>
              <tbody><?php $counter=1 ?>
                @foreach($fee_elements as $fee_element)
                <tr>
                  <td style="text-align:center">{!! $counter !!}</td>
                  <td>{!! $fee_element->code !!}</td>
                  <td>{!! $fee_element->name !!}</td>
                  <td>{!! $fee_element->description !!}</td>
                  <td>
                    <div class="label {{ $fee_element->status_id == 1? 'label-success': '' }}{{ $fee_element->status_id == 2? 'label-danger': '' }}">
                      {!! $fee_element->status->status !!}
                    </div>
                  </td>
                  <td style="text-align:center">
                    <div class="btn-group right-dropdown">
                            <button type="button" class="btn btn-blue btn-sm">List of Actions</button>
                            <button type="button" class="btn btn-blue dropdown-toggle btn-sm" data-toggle="dropdown">
                              <span class="caret"></span>
                            </button>
                            
                            <ul class="dropdown-menu dropdown-blue" role="menu">
                              <li><a href="{!! route('billing.fee_elements.edit', array($fee_element->id)) !!}">Edit</a>
                              </li>
                              <li>
                              <?php if($fee_element->status_id == 1){ ?>
                                <a href="{!! route('billing.fee_elements.deactivate', array($fee_element->id)) !!}">Deactivate</a>
                              <?php } if($fee_element->status_id == 2){ ?>
                                <a href="{!! route('billing.fee_elements.activate', array($fee_element->id)) !!}">Activate</a>
                              <?php }  ?>
                              </li>
                            </ul>
                          </div>
                  </td>
                </tr>
                <?php $counter++ ?>
                @endforeach
              </tbody>
            </table>
            </div>
          </div>
      
        </div>
</div>
@stop
@section('page_css')
  <!-- Imported styles on this page -->
  <link rel="stylesheet" href="{!! asset('assets/js/datatables/dataTables.bootstrap.css') !!}">
@stop
@section('page_js')
  <!-- Imported styles on this page -->
  <script src="{!! asset('assets/js/daterangepicker/daterangepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/datepicker/bootstrap-datepicker.js') !!}"></script>
  <script src="{!! asset('assets/js/timepicker/bootstrap-timepicker.min.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/js/jquery.dataTables.min.js') !!}"></script>
  <script src="{!! asset('assets/js/rwd-table/js/rwd-table.min.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/dataTables.bootstrap.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}"></script>
  <script src="{!! asset('assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}"></script>
@stop