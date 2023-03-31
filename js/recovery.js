$('document').ready(function()
{  
	 // valid email pattern
	 var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	 
	 $.validator.addMethod("validemail", function( value, element ) {
	     return this.optional( element ) || eregex.test( value );
	 });


     /* validation */
	 $("#password-recovery-form").validate({
      	rules:
	  	{		
	  		email: {
	            required: true,
	            validemail: true,
	            remote: {
					url: "check-recovery-email.php",
					type: "post",
					data: {
						email: function() {
							return $( "#email" ).val();
						}
					}
				}
            },
			
	   },
       messages:
	   {
	   		email : {
				required : "Email is required",
				validemail : "Please enter valid email address",
				remote : "Email does not exists in our records"
			},
       },
       errorPlacement : function(error, element) {
		  $(element).closest('.form-group').find('.help-block').html(error.html());
	   },
	   highlight : function(element) {
		  $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	   },
	   unhighlight: function(element, errorClass, validClass) {
		  $(element).closest('.form-group').removeClass('has-error');
		  $(element).closest('.form-group').find('.help-block').html('');
	   },
	   		submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#password-recovery-form").serialize();
				
			$.ajax({	
				type : 'POST',
				url  : 'recover-password.php',
				data : data,
				dataType: 'json',
				beforeSend: function()
				{	
					$("#errorDiv").fadeOut();
					$("#btn-recovery").html('<img src="images/loader.gif" /> &nbsp; Sending Recovery Link...').prop('disabled', true);
					$('input[type=email]').prop('disabled', true);
				},
				success :  function(data)
				{			
					if(data.status==='success'){		
					    $("#errorDiv").fadeIn(1000, function(){						
							$("#errorDiv").html('<div class="callout callout-success"> <strong><i class="fa fa-info-circle"></i></strong> &nbsp; '+data.message+'</div>');
							$('input[type=email]').prop('disabled', false);
						    $('#btn-recovery').html('Recover Password').prop('disabled', false);
						});
					} else {
						$("#errorDiv").fadeIn(1000, function(){						
							$("#errorDiv").html('<div class="callout callout-danger"> <strong><i class="fa fa-info-circle"></i></strong> &nbsp; '+data.message+'</div>');
							$("#btn-recovery").html('Recover Password').prop('disabled', false);
						});
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
					$("#password-recovery-form").trigger('reset');
			        alert("Please check your internet connectiom"); 
			    }
			});
		}
});