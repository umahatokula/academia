//array is 2 dimensional
function makeOptions(array){
	var p = array;
	var options = '<option value="0"> </option>';
		for (var key in p) {
			if (p.hasOwnProperty(key)) {
				var obj = p[key];
				for (var prop in obj) {
				// important check that this is objects own property 
             	// not from prototype prop inherited
              	if(obj.hasOwnProperty(prop)){
              //console.log(prop + " = " + obj[prop]);
               	options += '<option value="' + prop + '">' + obj[prop] + '</option>';
               }
           }
       }
   }
   return options;
}
