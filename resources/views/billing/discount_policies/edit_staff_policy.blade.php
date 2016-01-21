<div class="row">
        <div class="col-sm-12">
      
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Staff Discount Policy Settings</h3>
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
              {!! Form::model($discount_policy, array('route' => array('billing.discount_policies.update_staff_policy', $discount_policy->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form')) !!}
               <table class="table table-bordered table-hover table-condensed">
                 <thead>
                   <tr>
                     <td colspan="2" style="text-align:center">Staff Scholarship</td>
                   </tr>
                 </thead>
                 <tr id="children">
                   <td>
                    {!! Form::label('children_number', 'Required No of wards', array('class' => 'control-label', 'for' => 'children_number')) !!}
                  </td>
                  <td>
                    {!! Form::input('number', 'children_number', null, array('class' => 'col-sm-2 form-control', 'id' => 'children_number')) !!}
                  </td>
                 </tr>
                 <tr id="all_wards">
                   <td>
                    {!! Form::label('all_wards', 'Divide & spread across all Wards?', array('class' => ' control-label', 'for' => 'type')) !!}
                  </td>
                  <td>
                    <input value="1" name="all_wards" class="all_wards" id="all_wards_1" type="radio" <?php if($discount_policy->all_wards == 1){echo "checked";} ?> /> Yes
                    <input value="0" name="all_wards" class="all_wards" id="all_wards_0" type="radio" <?php if($discount_policy->all_wards == 0){echo "checked";} ?> /> No
                  </td>
                 </tr>
                 <tr id="type">
                   <td>
                    {!! Form::label('type', 'Type', array('class' => ' control-label', 'for' => 'type')) !!}
                  </td>
                  <td>
                    <input value="percentage" name="type" class="type" id="" type="radio" <?php if($discount_policy->type == 'percentage'){echo "checked";} ?> /> Percentage
                    <input value="sum" name="type" class="type" id="" type="radio" <?php if($discount_policy->type == 'sum'){echo "checked";} ?> /> Lump Sum
                  </td>
                 </tr>
                 <tr id="discount_duration">
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
    $('.all_wards').click(function(){
          // console.log($(this).val());
            
            if($(this).val() == 0){
              $('#dont_divide_tr').remove();
              $( "#all_wards" ).after(' <tr id="dont_divide_tr">\
                                          <td>\
                                              <label class="control-label" for="dont_divide">Don\'t divive but spread across all wards\
                                              </label>\
                                          </td>\
                                          <td>\
                                              <input value="1" name="dont_divide" class="dont_divide" id="dont_divide_1" type="radio" <?php if($discount_policy->dont_divide == 1){echo "checked";} ?> /> Yes \
                                              <input value="0" name="dont_divide" class="dont_divide" id="dont_divide_0" type="radio" <?php if($discount_policy->dont_divide == 0){echo "checked";} ?> /> No\
                                          </td>\
                                        </tr>');
            }

            if($(this).val() == 1){
                $('#dont_divide_tr').fadeOut();
            }
    });
//JQUERY FOR SPREADING SCHOLARSHIP ACROSS ALL IDS OF SAME PARENT OR JUST ONE 

//  JQUERY FOR SPREADING SCHOLARSHIP ACROSS ALL IDS OF SAME PARENT OR JUST ONE 
    $('.all_wards').click(function(){
          console.log($(this).val());
            
            if($(this).val() == 0){
              $('#ward_to_deduct').remove();
              $( "#dont_divide_tr" ).after('<tr id="ward_to_deduct">\
                                              <td>\
                                                <label class="control-label" for="ward_to_deduct">\
                                                  If no, which of the Wards to benefit\
                                                </label>\
                                              </td>\
                                              <td>\
                                                <input name="ward_to_deduct" value="<?php if(isset($discount_policy->ward_to_deduct)){echo $discount_policy->ward_to_deduct;} ?> />" type="number" class="col-sm-2 form-control" id="" />\
                                              </td>\
                                            </tr>');
            }

            if($(this).val() == 1){
                $('#ward_to_deduct').fadeOut();
            }
    });
//JQUERY FOR SPREADING SCHOLARSHIP ACROSS ALL IDS OF SAME PARENT OR JUST ONE 


//  JQUERY FOR TRANSACTION ID
    $('.type').click(function(){
          // console.log($(this).val());
          var array = {!! json_encode($fee_elements) !!}

          var html = [];
          html.push('<select id="affected_elements" class="form-control" name="affected_elements[]" multiple="multiple">');
          jQuery.each(array, function(index, value){
            html.push('<option value="'+index+'">'+value+'</option>');
          });
          html.push('</select>');
          //console.log(html);
            
            if($(this).val() == 'percentage'){
              $('#percentage_value').remove();
              $('#sum_value').remove();
              $('#affected_elements').remove();
              $( "#type" ).after('<tr id="percentage_value"><td><label class="control-label" for="percentage_value">Percentage Value</label></td><td><input name="percentage_value" value="" type="number" class="col-sm-2 form-control" id="" /></td></tr>\
                                  <tr id="affected_elements"><td><label class="control-label" for="sum_value">Elements to affect</label></td><td>'+html.join('')+'</td></tr>');
            }

            if($(this).val() == 'sum'){
              $('#percentage_value').remove();
              $('#sum_value').remove();
              $('#affected_elements').remove();
              $( "#type" ).after('<tr id="sum_value"><td><label class="control-label" for="sum_value">Sum Value</label></td><td><input name="sum_value" value="" type="number" class="col-sm-2 form-control" id="" /></td></tr>');
            }
    });
//END OF TRANSACTION ID
  </script>