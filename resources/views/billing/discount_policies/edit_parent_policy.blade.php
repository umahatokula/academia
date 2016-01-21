<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Parent Discount Policy Settings</h3>
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
              {!! Form::model($discount_policy, array('route' => array('billing.discount_policies.update_parent_policy', $discount_policy->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form')) !!}
               <table class="table table-bordered table-hover table-condensed">
                 <thead>
                   <tr>
                     <td colspan="2" style="text-align:center">Parent Scholarship</td>
                   </tr>
                 </thead>
                 <tr id="children_tr">
                   <td>
                    {!! Form::label('children_number', 'Required No of wards', array('class' => 'control-label', 'for' => 'children_number')) !!}
                  </td>
                  <td>
                    {!! Form::input('number', 'children_number', null, array('class' => 'col-sm-2 form-control', 'id' => 'children_number')) !!}
                  </td>
                 </tr>
                 <tr id="all_wards_tr">
                   <td>
                    {!! Form::label('all_wards', 'Divide & spread across all Wards?', array('class' => ' control-label', 'for' => 'type')) !!}
                  </td>
                  <td>
                    <input value="1" name="all_wards" class="all_wards" id="all_wards_1" type="radio" <?php if($discount_policy->all_wards == 1){echo "checked";} ?> /> Yes
                    <input value="0" name="all_wards" class="all_wards" id="all_wards_0" type="radio" <?php if($discount_policy->all_wards == 0){echo "checked";} ?> /> No
                  </td>
                 </tr>
                 <tr id="dont_divide_tr">
                  <td>
                    {!! Form::label('dont_divide', 'Don\'t divide but spread across all wards?', array('class' => ' control-label', 'for' => 'dont_divide')) !!}
                  </td>
                  <td>
                    <input value="1" name="dont_divide" class="dont_divide" id="dont_divide_1" type="radio" <?php if($discount_policy->dont_divide == 1){echo "checked";} ?> /> Yes
                    <input value="0" name="dont_divide" class="dont_divide" id="dont_divide_0" type="radio" <?php if($discount_policy->dont_divide == 0){echo "checked";} ?> /> No
                  </td>
                 </tr>
                 <tr id="ward_to_deduct_tr">
                  <td>
                  {!! Form::label('ward_to_deduct', 'If no, which of the Wards to benefit', array('class' => ' control-label', 'for' => 'ward_to_deduct')) !!}
                  </td>
                  <td>
                    <input name="ward_to_deduct" value="{!! $discount_policy->ward_to_deduct !!}" type="number" class="col-sm-2 form-control ward_to_deduct" id="ward_to_deduct" />
                  </td>
                 </tr>
                 <tr id="type_tr">
                   <td>
                    {!! Form::label('type', 'Type', array('class' => ' control-label', 'for' => 'type')) !!}
                  </td>
                  <td>
                    <input value="percentage" name="type" class="type" id="type_percentage" type="radio" <?php if($discount_policy->type == 'percentage'){echo "checked";} ?> /> Percentage
                    <input value="sum" name="type" class="type" id="type_sum" type="radio" <?php if($discount_policy->type == 'sum'){echo "checked";} ?> /> Lump Sum
                  </td>
                 </tr>
                 <tr id="discount_duration_tr">
                   <td>
                    {!! Form::label('discount_duration', 'Discount Duration', array('class' => 'control-label', 'for' => 'type')) !!}
                  </td>
                  <td>
                    {!! Form::select('discount_duration', $discount_durations, null, array('class' => 'col-sm-2 form-control', 'id' => 'discount_duration')) !!}
                  </td>
                 </tr>
                 <tfoot>
                   <td colspan="2" style="text-align:right">
                    {!! Form::submit('save', array('class' => 'btn btn-blue')) !!}
                   </td>
                 </tfoot>
               </table>
              <!-- </form> -->
              {!! Form::close() !!}
            </div>
          </div>
      
        </div>
</div>
  <script type="text/javascript">

//  JQUERY FOR SPREADING SCHOLARSHIP ACROSS ALL IDS OF SAME PARENT OR JUST ONE 

    $('#all_wards_0').click(function(){
      $('.dont_divide').prop('checked',true); 
      $('.dont_divide').prop('disabled',false);

      // $('input.ward_to_deduct').removeAttr('value');
      $('.ward_to_deduct').prop('disabled',false);
    });


    $('#all_wards_1').click(function(){
      $('.dont_divide').prop('checked',false); 
      $('.dont_divide').prop('disabled',true);

      $('.ward_to_deduct').val(' '); 
      $('.ward_to_deduct').prop('disabled',true); 
    });

    $('#dont_divide_0').click(function(){
      $('.ward_to_deduct').prop('disabled',false);
    });


    $('#dont_divide_1').click(function(){ 
      $('.ward_to_deduct').prop('disabled',true);
    });
//JQUERY FOR SPREADING SCHOLARSHIP ACROSS ALL IDS OF SAME PARENT OR JUST ONE 





//  JQUERY FOR TRANSACTION ID

          var array = {!! json_encode($fee_elements) !!}
          var affected_elements_array = {!! json_encode($discount_policy->affected_elements) !!}

          var html = [];
          html.push('<select id="affected_elements" class="form-control" name="affected_elements[]" multiple="multiple">');
          jQuery.each(array, function(index, value){
            if(jQuery.inArray(index, affected_elements_array) !== -1){
              html.push('<option value="'+index+'" selected>'+value+'</option>');
            }else{
              html.push('<option value="'+index+'">'+value+'</option>');
            }
          });
          html.push('</select>');


            if($('#type_percentage').prop('checked')){
              $('#percentage_value').remove();
              $('#sum_value').remove();
              $('#affected_elements').remove();
              $( "#type_tr" ).after(' <tr id="percentage_value"><td><label class="control-label" for="percentage_value">Percentage Value</label></td><td><input name="percentage_value" value="{!! $discount_policy->percentage_value !!}" type="number" class="col-sm-2 form-control" id="" /></td></tr>\
                                      <tr id="affected_elements"><td><label class="control-label" for="sum_value">Elements to affect</label></td><td>'+html.join('')+'</td></tr>');
            }

            if($('#type_sum').prop('checked')){
              $('#percentage_value').remove();
              $('#sum_value').remove();
              $('#affected_elements').remove();
              $( "#type_tr" ).after('<tr id="sum_value"><td><label class="control-label" for="sum_value">Sum Value</label></td><td><input name="sum_value" value="" type="number" class="col-sm-2 form-control" id="" /></td></tr>');
            }

    $('.type').click(function(){
            
            if($(this).val() == 'percentage'){
              $('#percentage_value').remove();
              $('#sum_value').remove();
              $('#affected_elements').remove();
              $( "#type_tr" ).after('<tr id="percentage_value"><td><label class="control-label" for="percentage_value">Percentage Value</label></td><td><input name="percentage_value" value="{!! $discount_policy->percentage_value !!}" type="number" class="col-sm-2 form-control" id="" /></td></tr>\
                                  <tr id="affected_elements"><td><label class="control-label" for="sum_value">Elements to affect</label></td><td>'+html.join('')+'</td></tr>');
            }

            if($(this).val() == 'sum'){
              $('#percentage_value').remove();
              $('#sum_value').remove();
              $('#affected_elements').remove();
              $( "#type_tr" ).after('<tr id="sum_value"><td><label class="control-label" for="sum_value">Sum Value</label></td><td><input name="sum_value" value="" type="number" class="col-sm-2 form-control" id="" /></td></tr>');
            }
    });
//END OF TRANSACTION ID
  </script>