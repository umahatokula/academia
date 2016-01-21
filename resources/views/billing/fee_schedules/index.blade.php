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
            <a href="{!! route('billing.fee_schedules.create') !!}"  class="btn btn-secondary btn-sx">add schedule</a>
          </div>
          </div>
        </div>
      </div>
<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Fee Schedules</h3>
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
                  <td style="text-align:center">Class</td>
                  <td style="text-align:center">Term</td>
                  <td style="text-align:center">Session</td>
                  <td style="text-align:center">Amount</td>
                  <td style="text-align:center">Status</td>
                  <td style="text-align:center">Actions</td>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <td style="text-align:center">S/N</td>
                  <td style="text-align:center">Class</td>
                  <td style="text-align:center">Term</td>
                  <td style="text-align:center">Session</td>
                  <td style="text-align:center">Amount</td>
                  <td style="text-align:center">Status</td>
                  <td style="text-align:center">Actions</td>
                </tr>
              </tfoot>
              <tbody><?php $counter=1;  ?>
                <?php //dd($fee_schedules); ?>
                @foreach($fee_schedules as $fee_schedule)
                <?php //dd($fee_schedule->session); ?>
                <tr>
                  <td style="text-align:center">{!! $counter !!}</td>
                  <td>{!! $fee_schedule->studentClass->name !!}</td>
                  <td style="text-align:center">{!! $fee_schedule->term->term !!}</td>
                  <td style="text-align:center">{!! $fee_schedule->session !!}</td>
                  <td style="text-align:right">{!! number_format(\App\Helpers\Helper::getFeeScheduleTotal($fee_schedule->fee_schedule_code), 2) !!}</td>
                                <td style="text-align:center">
                                  <div class="label {{ $fee_schedule->status_id == 1? 'label-success': '' }}{{ $fee_schedule->status_id == 8? 'label-purple disabled': '' }}">
                                    {!! $fee_schedule->status->status !!}
                                  </div>
                                </td>
                  <td style="text-align:center">
                    <div class="btn-group right-dropdown">
                      <button type="button" class="btn btn-blue btn-sm">List of Actions</button>
                      <button type="button" class="btn btn-blue dropdown-toggle btn-sm" data-toggle="dropdown">
                        <span class="caret"></span>
                      </button>
                            
                      <ul class="dropdown-menu dropdown-blue" role="menu">
                        <li>
                          <a href="{!! route('billing.fee_schedules.show', array($fee_schedule->fee_schedule_code)) !!}" data-target="#responsiveModal" data-toggle="modal">Details</a>
                        </li>
                        <li>
                          <a href="{!! route('billing.fee_schedules.edit', array($fee_schedule->fee_schedule_code)) !!}" data-target="#responsiveModal" data-toggle="modal" class="{{ $fee_schedule->status_id == 8? 'disabled': '' }}">Edit</a>
                        </li>
                        <!-- <li>
                          <a href="">Deactivate</a>
                        </li> -->
                      </ul>
                    </div>
                    <a href="{!! route('billing.invoices.bill_class', array($fee_schedule->fee_schedule_code)) !!}" class="btn btn-sm btn-secondary {{ $fee_schedule->status_id == 8? 'disabled': '' }}">Bill Class</a>
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