//JS TO ENABLE INPUT BOX WHEN CORRESPONDING CHECKBOX IS CHECKED
function enableElement(elementID){
    //alert($('.'+elementID).length);
    if($('#'+elementID).prop('checked')){
       $('.'+elementID).prop('disabled',false); 
    }else{
        $('.'+elementID).prop('disabled',true);
    }
}
//END OF JS TO ENABLE INPUT BOX WHEN CORRESPONDING CHECKBOX IS CHECKED

