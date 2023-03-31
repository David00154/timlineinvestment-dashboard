$('document').ready(function()
{  

     /* validation */
	 $("#login-form").validate({
      rules:
	  {		
	  		username_email: {
	            required: true,
            },
			password: {
				required: true,
			},
			
	   },
       messages:
	   {
	   		username_email : {
				required : "This field is required",
			},
            password: {
                required: "Password is required"
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
			var data = $("#login-form").serialize();
				
			$.ajax({	
				type : 'POST',
				url  : 'ajax-login.php',
				data : data,
				beforeSend: function()
				{	
					$("#errorDiv").fadeOut();
					$("#btn-login").html('<img src="images/loader.gif" /> &nbsp; Signing In...').prop('disabled', true);
				},
				success :  function(response)
				{						
					if(response=="ok"){						
						$("#btn-login").html('<img src="images/loader.gif" /> &nbsp; Signing In...').prop('disabled', true);
						window.setTimeout( function(){
                             window.location = "account/index.php";
                        }, 1000);
					} else {
						$("#errorDiv").fadeIn(1000, function(){						
							$("#errorDiv").html('<div class="callout callout-danger"> <strong><i class="fa fa-info-circle"></i></strong> &nbsp; '+response+'</div>');
							$("#btn-login").html('<i class="fa fa-sign-in"></i> &nbsp; Sign In').prop('disabled', false);
						});
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
					$("#login-form").trigger('reset');
			        alert("Please check your internet connection"); 
			    }
			});
		}
});