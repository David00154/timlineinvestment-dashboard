$('document').ready(function()
{  
	// name validation
	 var nameregex = /^[a-zA-Z ]+$/;
	 
	 $.validator.addMethod("validname", function( value, element ) {
	     return this.optional( element ) || nameregex.test( value );
	 }); 

	 // valid email pattern
	 var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	 
	 $.validator.addMethod("validemail", function( value, element ) {
	     return this.optional( element ) || eregex.test( value );
	 });


     /* validation */
	 $("#register-form").validate({
       rules:
	   {		
			fullname: {
				required: true,
				validname: true,
				minlength: 4
			},
			country: {
				required: true,
			},
			gender: {
				required: true,
			},
			phone: {
				required: true,
				digits: true,
			},
			email : {
				required : true,
				validemail: true,
				remote: {
					url: "check-email.php",
					type: "post",
					data: {
						email: function() {
							return $("#email").val();
						}
					}
				},
			},
			username: {
				required: true,
				minlength: 4,
				remote: {
					url: "check-username.php",
					type: "post",
					data: {
						username: function() {
							return $("#username").val();
						}
					}
				},
			},
			password: {
				required: true,
				minlength: 7,
				maxlength: 15
			},
			confirm_password: {
				required: true,
				equalTo: '#password'
			},
	   },
	   messages:
	   {
			fullname: {
				required: "Fullname is required",
				validname: "Fullname must contain only alphabets and space",
				minlength: "Fullname is too short"
			},
			country: {
				required: "Please select a country",
			},
			gender: {
				required: "Please select gender",
			},
			phone: {
				required: "Phone number is required",
			},
			email : {
				required : "Email is required",
				validemail : "Please enter valid email address",
				remote : "Email already exists"
			},
			username: {
				required: "Username is required",
				minlength: "Username is too short",
				remote : "Username already exists"
			},
			password:{
				required: "Password is required",
				minlength: "Password at least have 7 characters",
			},
			confirm_password:{
				required: "Retype your password",
				equalTo: "Password did not match !",
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
	   
	function submitForm(){
			   
		var data = $("#register-form").serialize();
			
		$.ajax({
				
			type : 'POST',
			url  : 'ajax-signup.php',
			data : data,
			dataType: 'json',
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-signup").html('<img src="images/loader.gif" /> &nbsp; Signing Up...').prop('disabled', true);
		   		$('input[type=text],input[type=email],input[type=password],select').prop('disabled', true);
			},
			success :  function(data)
			{						
				if(data.status==='success'){
								
					$("#btn-signup").html('<img src="images/loader.gif" /> &nbsp; Account Created. Redirecting to Login...');
					window.setTimeout( function(){
                         window.location = "sign-in.php";
                    }, 1000);
				} else {	
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="callout callout-success"> <i class="fa fa-info-circle"></i> &nbsp; '+data.message+'</div>');
						$("#register-form").trigger('reset');
						$('input[type=text],input[type=email],input[type=password],select').prop('disabled', false);
						$('#btn-signup').html('<span class="glyphicon glyphicon-log-in"></span> Register').prop('disabled', false);
					});
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				$("#register-form").trigger('reset');
		        alert("Please check your internet connection"); 
		    }
		});
	}
});