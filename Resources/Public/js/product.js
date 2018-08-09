$(document).ready(function(){
	var today = new Date();
	 $("#fromdate").datepicker({
	 	dateFormat:'yy-mm-dd',
	 	minDate: 0,
	 	defaultDate: today,
        onSelect: function(selected) {
          $("#todate").datepicker("option","minDate", selected);
          if(!$("#todate").val()){
          	$("#todate").val(selected);
          }
        }
    });
    $("#todate").datepicker({ 
    	dateFormat:'yy-mm-dd',
    	minDate: 0,
    	defaultDate: new Date(),
        onSelect: function(selected) {
           $("#fromdate").datepicker("option","maxDate", selected);
        }
    });

    $('#createNew').click(function(e){
    	e.preventDefault();
    	valid = validateFields();
    	if(valid){
    		$('#createProduct').submit();
    	}
    })

    $("#fromdateBack").datepicker({
	 	dateFormat:'yy-mm-dd',	 	
        onSelect: function(selected) {
          $("#todateBack").datepicker("option","minDate", selected);
          
        }
    });

    $("#todateBack").datepicker({ 
    	dateFormat:'yy-mm-dd',
        onSelect: function(selected) {
           $("#fromdateBack").datepicker("option","maxDate", selected);
        }
    });

    $('#send').click(function(e){
    	e.preventDefault();
    	valid = validateFields();
    	if(valid){
    		$('#inquiry').submit();
    	}
    });

    $('#categorySelect').off('change').on('change', function () {
    	var id = $('#categorySelect option:selected').val();
    	$('.form-group .attributes').hide();
    	$('#cat_' + id).show();
	});

});

function validateFields(){
	
	var notValid = 0 ;
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	$('.validate').each(function(){
		if(!$(this).val()){
			notValid = 1;
			$(this).css({'color':'red', 'border-color':'red'});
			$(this).parent().find('label').css({'color':'red'});
		}else{
			if($(this).is('[id="owneremail"]')){
				var email = $(this).val();
				if(!re.test(email)){
					notValid = 1;
					$(this).css({'color':'red', 'border-color':'red'});
					$(this).parent().find('label').css({'color':'red'});
					return;
				}
			}
			$(this).css({'color':'#02243c', 'border-color':'#02243c'});
			$(this).parent().find('label').css({'color':'#02243c'});
		}
	});
	if($('.checks').length){
		if(!$('.checks:checked').length){
			notValid = 1;
			$('.product-cats').parent().find('label').css({'color':'red'});
		}else{
			$('.product-cats').parent().find('label').css({'color':'#02243c'});
		}
	}

	if(notValid){
		return false;
	}
	return true;
	
}