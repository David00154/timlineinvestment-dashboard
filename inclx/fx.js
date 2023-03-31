// default variables
var loading_white = '<div id="preloader"><div class="KCEwhiteLoader"> </div></div>';
var loading = '<div id="preloader"><div class="KCEblueLoader"> </div></div>';

// defaut functions
// exchange timer
function kce_usertimer(curr_time,endDate,display){
	var countDownDate = endDate;
	var now = curr_time;
	var x = setInterval(function() {
	now = now + 1;
  	var distance = countDownDate - now;
  	var minutes = Math.floor((distance % (60 * 60)) / (60));
  	var seconds = Math.floor(distance % (60));
document.getElementById(display).innerHTML = '<span class="badge badge-md badge-lighter">Timer: '+minutes + 'm : ' + seconds + 's </span>';
  	if (countDownDate < now) {
    	clearInterval(x);
    	document.getElementById(display).innerHTML = '<span class="badge badge-md badge-danger">EXPIRED</span>';
    	setTimeout(function(){
            location.reload();
        },2000);

  	}
	}, 1000);
}
// format money
function formatMoney(n, c, d, t) {
  var c = isNaN(c = Math.abs(c)) ? 2 : c,
    d = d == undefined ? "." : d,
    t = t == undefined ? "," : t,
    s = n < 0 ? "-" : "",
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
    j = (j = i.length) > 3 ? j % 3 : 0;

  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
// toastr message
function toastr_success(msg){
	toastr.clear(), toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !1,
            positionClass: "toast-bottom-center",
            preventDuplicates: !0,
            showDuration: "1000",
            hideDuration: "10000",
            timeOut: "3000",
            extendedTimeOut: "1000"
        }, toastr.success('<em class="ti ti-check toast-message-icon"></em> '+msg)
}
function toastr_error(msg){
	toastr.clear(), toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !1,
            positionClass: "toast-bottom-center",
            preventDuplicates: !0,
            showDuration: "1000",
            hideDuration: "10000",
            timeOut: "3000",
            extendedTimeOut: "1000"
        }, toastr.error('<em class="ti ti-na toast-message-icon"></em> '+msg)
}
//blockchain payment tracking
function blockchain_websocket(data){
	var btcs = new WebSocket('wss://ws.blockchain.info/inv');
	
	btcs.onopen = function(){
		btcs.send(JSON.stringify({"op":"addr_sub", "addr":data.payto}));
	};
	btcs.onmessage = function(onmsg){
		var response = JSON.parse(onmsg.data);
		var getOuts = response.x.out;
		var countOuts = getOuts.length;

		for (i=0; i<countOuts; i++){
			var outAdd = response.x.out[i].addr;
			if (outAdd == data.payto) {
				var amount = response.x.out[i].value;
				var calAmount = amount / 100000000;
				if (calAmount == data.amt) {
					font_confirm_transaction(data.amt_usd,data.amt,data.project);
				}
			}
		}
	};
}
//blockchain payment track confirmation
function font_confirm_transaction(amount,btc_amt,project) {
	var data_url = "requests/newInvest.php";
	$.ajax({
		type: "POST",
	    url: data_url,
	    data: {amount:amount, amtBtc:btc_amt, project:project},
	    dataType: "json",
		success: function (data) {
			if(data.status == "success") {
				$("#eklints-invest").html(data.msg);
				toastr_success(data.amount+" has been credited to your investment");
			} else {
				toastr_error(data.msg);
			}
		}
	});
}
function completed_payment(timeCode){
	// data can be passed as "startDate=timeCode&others=otherdata.... without space"
	// or data can also be passed as {startDate:timeCode, others:otherdata....}
	// format is like this $.post(url, data, callbackFunction);
	$.post("requests/userExchangePaid.php", {startDate:timeCode});
	$("#exchangeForm").html(`
		<div class="status status-thank px-md-5">
			<div class="status-icon"><em class="ti ti-check"></em></div>
			<span class="status-text large text-dark">Pending confirmation</span>
			<p class="px-md-5">We received your data, our team will check and credit your wallet.</p>
		</div>`);
	// remove timer
	$('#kce-countDown').remove();
}
// blockchain test
// function bitTest(data){
// 	var btcs = new WebSocket('wss://ws.blockchain.info/inv');
	
// 	btcs.onopen = function(){
// 		btcs.send(JSON.stringify({"op":data.p}));
// 	};
// 	btcs.onmessage = function(onmsg){
// 		var response = JSON.parse(onmsg.data);
// 		// var getOuts = response.x.out;
// 		// var countOuts = getOuts.length;

// 		console.log(response);
// 	};
// }
// convert image from base64 to blob
function b64toBlob(b64Data, contentType, sliceSize) {
    contentType = contentType || '';
    sliceSize = sliceSize || 512;

    var byteCharacters = atob(b64Data);
    var byteArrays = [];

    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);

        byteArrays.push(byteArray);
    }

  var blob = new Blob(byteArrays, {type: contentType});
  return blob;
}

$(document).ready(function(){ //document.ready starts
	// get user data for livefeed
	// setInterval(function(){
	// 	$('.kce-balance').load('requests/userData.php #k-balance', function(){
	// 		$('.kce-balance').text($(this).text());
	// 	});
	// }, 2000);
	setInterval(function(){
		$('.kce-USD').load('requests/blockchain.php #kce-USD', function(){
			$('.kce-USD').text($(this).text());
		});
		$('.kce-BTC').load('requests/blockchain.php #kce-BTC', function(){
			$('.kce-BTC').text($(this).text());
		});
		$('.kce-ETH').load('requests/blockchain.php #kce-ETH', function(){
			$('.kce-ETH').text($(this).text());
		});
		$('.kce-LTC').load('requests/blockchain.php #kce-LTC', function(){
			$('.kce-LTC').text($(this).text());
		});
		// total trades
		let tot_online = 10+Math.floor((Math.random() * 300) + 1);
		$('.tot_trades').text(tot_online+Math.floor((Math.random() * 100) + 1));
	},20000);
	// trading bot
	$('.tot_trades').text(300+Math.floor((Math.random() * 300) + 1));
	setInterval(function(){
		let tot_sell = Math.floor((Math.random() * 50) + 1)+Math.floor((Math.random() * 600) + 1);
		let tot_buy = Math.floor((Math.random() * 50) + 1)+Math.floor((Math.random() * 600) + 1);
		$('.tot_sell').text(tot_sell);
		$('.tot_buy').text(tot_buy);
		if (tot_buy>tot_sell) {
			$('.tot_margin').html('<i class="fa fa-arrow-up text-success"></i>');
		} else {
			$('.tot_margin').html('<i class="fa fa-arrow-down text-danger"></i>');
		}
		
	},3000);

	// remove tradeview logo
	setTimeout(function(){
		$("a.button-1dpg_T2E- .button--right-2CEhpGhn-").css("display", "none");
	},3000);
}) //document.ready ends
var $userMoney = $('#kce-balance').val();
var kce_ROI = 0.1; //10 percent
// change country on register
$('form#regForm select[name="country"]').on('change', function(){
  var selected = $('form#regForm select[name="country"]').val();
  if (selected!='none') {
    $('form#regForm span#countryChoice').html('<img src="images/flags/'+selected+'.png" width="30px">');
  } else {
    $('form#regForm span#countryChoice').html('');
  }
});

// email register
$('#signUpForm button').on('click', function(){
	$(this).hide();
    $('#signUpForm').append(loading);
	var data_url = "requests/userRegister.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#signUpForm").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
				if (data.status=='success') {
					$('#signupContainer').html(data.msg);
				} else {
					$("#signUpForm").prepend(data.msg);				
		    		$('#signUpForm button').show();
		    		$('#preloader').remove();
		    	}
	    	},1000)	
		}
	});
});

// complete registration
$('#regForm button').on('click', function(){
	$(this).hide();
    $('#regForm').append(loading);
	var data_url = "requests/userRegister2.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#regForm").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
				$("#regForm").prepend(data.msg);	
				$("#regForm").append(data.msg);				
	    		$('#regForm button').show();
	    		$('#preloader').remove();
	    	},1000)
		}
	});
});

//Login
$('#loginForm button').click(function(){
	$(this).hide();
    $('#loginForm').append(loading);
	var data_url = "requests/userLogin.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#loginForm").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
				if (data.status=='success') {
					// $("#loginForm").prepend(data.msg);
					toastr.success("Login Successful");
					location.reload();
				} else {
					$("#loginForm").prepend(data.msg);
					// toastr.error(data.msg);				
		    		$('#loginForm button').show();
		    		$('#preloader').remove();
				}
			},1000);
		}
	});
});

//reset
$('#resetForm button').click(function(){
	$(this).hide();
    $('#resetForm').append(loading);
	var data_url = "requests/userReset.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#resetForm").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
				if (data.status=='success') {
					$('#resetContainer').html(data.msg);
				} else {
					$("#resetForm").prepend(data.msg);				
		    		$('#resetForm button').show();
		    		$('#preloader').remove();
		    	}
	    	},1000)
		}
	});
});

// complete reset password
$('#resetPass button').on('click', function(){
	$(this).hide();
    $('#resetPass').append(loading);
	var data_url = "requests/userReset2.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#resetPass").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
		    	$('#preloader').remove();
				if (data.status=='success') {
					$('.page-content .container .row.justify-content-center').html(data.msg);
				} else {
					$("#resetPass").prepend(data.msg);				
		    		$('#resetPass button').show();
		    	}
	    	},1000)
		}
	});
});

//Update Profile
$('#updateProfile button').click(function(){
	$(this).hide();
    $('#updateProfile').append(loading);
	var data_url = "requests/userUpdateProfile.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#updateProfile").serialize()+'&updateType=profile',
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
				$("#updateProfile").prepend(data.msg);				
	    		$('#updateProfile button').show();
	    		$('#preloader').remove();
			},1000);
		}
	});
});
//change password
$('#updatePassword button').click(function(){
	$(this).hide();
    $('#updatePassword').append(loading);
	var data_url = "requests/userChangePassword.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#updatePassword").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
				$("#updatePassword").prepend(data.msg);				
	    		$('#updatePassword button').show();
	    		$('#preloader').remove();
			},1000);
		}
	});
});

// 2FA Authentication
// $('#kce-2FA button').on('click',function(){
// 	$(this).html(loading);
// })
function _2FA(status){
	$('#kce-2FA button').html(loading);
	var data_url = "requests/user2FA.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: {status:status},
		dataType: "json",
		success: function (data) {
			setTimeout(function(){
				$("#kce-2FA").html(data.msg);
			},1000);
		}
	});
}
//Write testimony
$('#writeTestimony button').click(function(){
	$(this).hide();
    $('#writeTestimony').append(loading);
	var data_url = "requests/userWriteTestimony.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#writeTestimony").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
				$("#writeTestimony").prepend(data.msg);				
	    		$('#writeTestimony button').show();
	    		$("#preloader").remove();
	    		if (data.status=="success") {
	    			$("#writeTestimony textarea").val('');
	    		}
			},1000);
		}
	});
});
// calculate the percentage of invest
$('#kce-percentInvest button').on('click', function(){
	var id = this.id;
	id = id.split('-');
	var calc = ($userMoney*id[1])/100;
	var roi = calc * kce_ROI;
	var total = calc + roi;
	$('#investForm input[name="amount"]').val(calc);
	$('#investForm input[name="roi"]').val(roi);
	$('#investForm input[name="total"]').val(total);
})
$('#investForm input[name="amount"]').on('keyup', function(){
	var val = parseInt($(this).val());
	if (isNaN(val)) {
		$(this).val('');
	} else{
		var calc = val * kce_ROI;
		var total = parseInt(calc) + val;
		$('#investForm input[name="roi"]').val(calc);
		$('#investForm input[name="total"]').val(total);
	}
})
// submit invest form
$('#kce-submitInvest').click(function(){
	$(this).hide();
    $('#investForm').append(loading);
	var data_url = "requests/userInvest.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#investForm").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
				swal(data.status,data.msg,data.status);			
	    		$('#kce-submitInvest').show();
	    		$('#preloader').remove();
	    		if (data.status=='success') {
	    			$('#investForm').trigger('reset');
	    		}
			},1000);
		}
	});
});

// KYC verification form
$('#kce-kycForm .submit').on('click', function(){
	$(this).hide();
	$('#kce-kycForm').append(loading);
		var form = document.getElementById("kce-kycForm");
		var ImageURL = $('form#kce-kycForm img#uploaded_image').attr('src');
        if ($('input[name="uploadedImage"]').val()=='yes') {
          var block = ImageURL.split(";");
          var contentType = block[0].split(":")[1];
          var realData = block[1].split(",")[1];
          var blob = b64toBlob(realData, contentType);
        } else {
          var blob = '';
        }
  var formData = new FormData(form);
  formData.append("image", blob);
  formData.append("updateType", "kyc");
  var data_url = "requests/userUpdateProfile.php"; 
	$.ajax({
		type: "POST",
	    url: data_url,
	    data: formData,
	    dataType: "json",
	    contentType:false,
	    processData:false,
	    cache:false,
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
				$("#kce-kycForm").prepend(data.msg);
				$("#kce-kycForm").append(data.msg);				
	    		$('#kce-kycForm button').show();
	    		$('#preloader').remove();
			},1000);
		}
	});

})


// transfer
$('#transferForm button').on('click', function(){
	$(this).hide();
    $('#transferForm').append(loading);
	var data_url = "requests/userTransfer.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#transferForm").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){
				swal(data.status,data.msg,data.status);			
	    		$('#transferForm button').show();
	    		$('#preloader').remove();
	    		if (data.status=='success') {
	    			$('#transferForm').trigger('reset');
	    		}
			},1000);
		}
	});
})








// exchange footer 2
// $('#exchangeForm select[name="send"]').on('change', function(){
// 	var send = $(this).val();
// 	$('#image_send').attr('src','images/coins/'+send+'.png');
// })
// $('#exchangeForm select[name="receive"]').on('change', function(){
// 	var send = $(this).val();
// 	$('#image_receive').attr('src','images/coins/'+send+'.png');
// })


// exchange footer
$('#exchangeForm select[name="selected-coin"]').on('change', function(){
	var coin = $(this).val();
	if (coin=="Bitcoin") {
		var symbol = "BTC";
	} else if (coin=="Ethereum"){
		var symbol = "ETH";
	} else {
		var symbol = "LTC";
	}
	$('#selected-coin').text(symbol);
	// $('#list-coin').removeClass('active');
	$('#image_send').attr('src','images/coins/'+coin+'.png');

	$('.kce-buyMethod').val(symbol);
	$('.kce-amountSend').val(0);
	$('.kce-amountReceive').text(0);
})

// update wallet details
$('#update-bit-wallet button').on('click',function(){
	$(this).hide();
    $('#update-bit-wallet').append(loading);
	var data_url = "requests/userUpdateAccountWallet.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#update-bit-wallet").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){		
				$('#update-bit-wallet').prepend(data.msg);
	    		$('#update-bit-wallet button').show();
	    		$('#preloader').remove();
	    		if (data.status=='success') {
	    			$('.kce-myBitAdd').text(data.wallet);
	    		}
			},1000);
		}
	});
})
// update account details
$('#update-account-details button').on('click',function(){
	$(this).hide();
    $('#update-account-details').append(loading);
	var data_url = "requests/userUpdateAccountWallet.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#update-account-details").serialize(),
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			setTimeout(function(){		
				$('#update-account-details').prepend(data.msg);
	    		$('#update-account-details button').show();
	    		$('#preloader').remove();
	    		if (data.status=='success') {
	    			$('.kce-myAccount').html(data.wallet);
	    		}
			},1000);
		}
	});
})

//exchange payment
$('.pay-option input').on('click', function(){
	var id = this.id;
	$('#kce-buyMethod').text(id);
	$('.kce-buyMethod').val(id);
	$('.kce-amountSend').val(0);
	$('.kce-amountReceive').text(0);
})
$('.kce-amountSend').on('keyup', function(){
	var crypto = $('.kce-buyMethod').val();
	var val = $(this).val();

	$.ajax({
		type: "POST",
		url: 'requests/exchangeCalc.php',
		data: {type:"exchange", crypto:crypto, value:val},
		dataType: "json",
		success: function (data) {
			$('.kce-amountReceive').text(data.val);
		}
	});
})
$('#exchangeForm .btn-submit').on('click', function(){
	var html = $(this).html();
	$(this).html(loading_white).attr('disabled','on');
	var amt = $('.kce-amountSend').val();
	var crypto = $('.kce-buyMethod').val();
	$.ajax({
		type: "POST",
		url: 'requests/exchangeProcess.php',
		data: {amount:amt, type:crypto},
		dataType: "json",
		success: function (data) {
			$('.alert').remove();
			$('#preloader').remove();
			$('#exchangeForm .btn-submit').html(html).removeAttr("disabled");
			if (data.status=='success') {
				var alt_btn;
				if (crypto == "BTC") {
					let bitdata = {"amt":data.amount, "payto":data.wallet, "timeCode":data.timeCode, "p":data.p};
					// bitTest(bitdata); //testing call bitcoin monitor
					blockchain_websocket(bitdata); //call bitcoin monitor
					alt_btn = '';
				} else{
					alt_btn = '<div class="token-buy"><a href="#" onclick="completed_payment('+data.timeCode+')">Click here if you are not redirected after making payment </a></div>';
				}
				$('#exchangeForm').html(`
					<div class="card-head"><span class="card-sub-title text-primary font-mid">Step 2</span>
			            <h4 class="card-title">Make Payment</h4>
			        </div>
			        <div class="card-text">
			            <p>Scan QR-code or copy address</p>
			        </div>
					<div class="col-md-6 text-center mb-2">
			            <div>
			                <img src="https://chart.googleapis.com/chart?chs=110x110&amp;chld=M|0&amp;cht=qr&amp;chl=${data.wallet}%3Famount%3D${data.amount}" width="150px">
			            </div>
			            <div>
			                <div class="copy-wrap mgb-1-5x mgt-1-5x"><span class="copy-feedback" style="display: none;">Copied to Clipboard</span><em class="fa fa-link"></em><input type="text" class="copy-address" value="${data.wallet}" disabled=""><button class="copy-trigger copy-clipboard" data-clipboard-text="${data.wallet}"><em class="ti ti-files"></em></button></div>
			            </div>
			            <div><h4>Amount to pay : ${data.amount} ${crypto}</h4></div>
			        </div>

			        ${alt_btn}`);

				$('#exchangeForm').append('<div id="kce-countDown"></div>');
				kce_usertimer(data.timeCode,data.timeCode_2,"kce-countDown");
			} else{
				$('form#exchangeForm').prepend(data.msg);
			}
		}
	});	
})

// withdrawal
    $('#withdrawal .btn-submit').on('click',function(){
    	var html = $(this).html();
		$(this).html(loading_white).attr('disabled','on');
        $.ajax({
            type: "POST",
            url: 'requests/userWithdraw.php',
            data: $('#withdrawal').serialize(),
            dataType: "json",
            success: function (data) {
				
                if (data.status=="success") {
                    $("#withdrawal").html(`
                        <div class="status status-thank px-md-5">
                            <div class="status-icon"><em class="ti ti-check"></em></div>
                            <span class="status-text large text-dark">Withdrawal Successful</span>
                            <p class="px-md-5">We we are currently processing your withdrawal. This may take 24 hours.</p>
                        </div>`);
                    toastr_success("Success");
                } else {
                    toastr_error(data.msg);
                    $('#preloader').remove();
					$('#withdrawal .btn-submit').html(html).removeAttr("disabled");
                }
            }
        });
    })
    $('#withdrawal input[name="amount"]').on('keyup',function(){
        var val = $('input[name="amount"]').val();

        $.ajax({
            type: "POST",
            url: 'requests/exchangeCalc.php',
            data: {type:"withdraw", value:val},
            dataType: "json",
            success: function (data) {
                $('.pay-amount#btc').text(data.btc);
                $('.pay-amount#eth').text(data.eth);
                $('.pay-amount#ltc').text(data.ltc);
                $('.pay-amount#usd').text(data.usd);
            }
        });
    })

    // select plan
    $("#select_planList button").on("click", function(){
    	var id = this.id;
    	var html = $(this).html();
		$(this).html(loading_white).attr('disabled','on');
    	$.ajax({
			type: "POST",
			url: 'requests/selectPlan.php',
			data: {plan:id},
			dataType: "json",
			success: function (data) {
				$('.alert').remove();
				$('#preloader').remove();
				$('#select_planList button').html(html).removeAttr("disabled");
				// if (data.status=='success') {
					let bitdata = {"amt":data.bitAmt, "amt_usd":data.amt, "payto":data.wallet, "project":data.project, "p":data.p};
					$('#select_planList').html(data.msg);
					blockchain_websocket(bitdata); //call bitcoin monitor
					kce_usertimer(data.timeCode,data.timeCode_2,"e-countDown");
				// } else{
				// 	$('form#eklints-invest').prepend(data.msg);
				// 	toastr_error(data.msg2);
				// }
			}
		});	
    })