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
            <!-- <a href="{!! route('billing.fee_elements.create') !!}"  class="btn btn-secondary btn-sx">add element</a> -->
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
                  // jQuery(document).ready(function($)
                  // {
                  //   $("#example-1").dataTable({
                  //     aLengthMenu: [
                  //       [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                  //     ]
                  //   });
                  // });
                  </script>
            <table class="table table-bordered table-hovered table-stripped table-condensed" id="example-1">
              <thead>
                <tr>
                  <td style="text-align:center">S/N</td>
                  <td style="text-align:center">Policy</td>
                  <td style="text-align:center">Actions</td>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <td style="text-align:center">S/N</td>
                  <td style="text-align:center">Policy</td>
                  <td style="text-align:center">Actions</td>
                </tr>
              </tfoot>
              <tbody>
              <tr>
                <td style="text-align:center">1</td>
                <td>Parent</td>
                <td style="text-align:center">
                  <a href="{!! route('billing.discount_policies.edit_parent_policy') !!}" class="btn btn-turquoise" data-target="#responsiveModal" data-toggle="modal">View/Modify</a>
                </td>
              </tr>
              <tr>
                <td style="text-align:center">2</td>
                <td>Staff</td>
                <td style="text-align:center">
                  <a href="{!! route('billing.discount_policies.edit_staff_policy') !!}" class="btn btn-turquoise" data-target="#responsiveModal" data-toggle="modal">View/Modify</a>
                </td>
              </tr>
              <tr>
                <td style="text-align:center">3</td>
                <td>Scholarship</td>
                <td style="text-align:center">
                  <a href="{!! route('billing.discount_policies.edit_scholarship_policy') !!}" class="btn btn-turquoise" data-target="#responsiveModal" data-toggle="modal">View/Modify</a>
                </td>
              </tr>
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