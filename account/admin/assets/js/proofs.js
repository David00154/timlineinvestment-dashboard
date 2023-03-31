function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + "").replace(/[^0-9+\-Ee.]/g, "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
        dec = typeof dec_point === "undefined" ? "." : dec_point,
        s = "",
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}





$.post("/proofs_api.php", { type: 'withdraw' }, function(data) {
    var data = JSON.parse(data);
    var results_object = [];
    var total_sorted = [];
    function load_trs(start, end){
        $('#proof-loading').css('display', 'none');
        $('#proofs-container').html('');
        for (var i = 0; i < data.length; i++) {
            for (var j = 0; j < data[i].length; j++) {
                var username = data[i][j][0];
                var date = data[i][j][1];
                var hash = data[i][j][2];
                var coin = data[i][j][3];
                var amount = data[i][j][4];
                var code;
                var verify_link;
                var result_object = new Object();
                result_object.username = '';
                result_object.date = '';
                result_object.hash = '';
                result_object.amount = '';
                result_object.coin = '';
                result_object.username = username;
                result_object.date = date;
                result_object.hash = hash;
                result_object.coin = coin;
                result_object.amount = amount;
                results_object.push(result_object);
            }
        }


        let sorted_results = results_object;
        sorted_results.sort(function (a, b) {
            var dateA = new Date(a.date), dateB = new Date(b.date);
            return dateB - dateA;
        });
        total_sorted.push(sorted_results);


        $('#proofs-container').html('');
        for (var k = start-1; k <= end-1; k++) {
            if(k >= sorted_results.length){
                break;
            }
            var code;
            var a_code;
            var pointer;
            var amount;
            var small_font;
            if (sorted_results[k].coin == '48') {
                code = 'BTC';
                a_code = 'BTC';
                verify_link = 'https://blockchain.info/tx/';
                small_font = '';
                pointer = '';
                amount = sorted_results[k].amount;
            }
            if (sorted_results[k].coin == '68') {
                code = 'LTC';
                a_code = 'LTC';
                verify_link = 'https://live.blockcypher.com/ltc/tx/';
                small_font = '';
                pointer = '';
                amount = sorted_results[k].amount;
            }
            if (sorted_results[k].coin == '69') {
                code = 'ETH';
                a_code = 'ETH';
                verify_link = 'https://etherscan.io/tx/';
                small_font = '';
                pointer = '';
                amount = sorted_results[k].amount;
            }
            if (sorted_results[k].coin == '71') {
                code = 'DASH';
                a_code = 'DASH';
                verify_link = 'https://live.blockcypher.com/dash/tx/';
                small_font = '';
                pointer = '';
                amount = sorted_results[k].amount;
            }
            if (sorted_results[k].coin == '77') {
                code = 'BTC';
                a_code = 'BCH';
                verify_link = 'https://explorer.bitcoin.com/bch/tx/';
                small_font = '';
                pointer = '';
                amount = sorted_results[k].amount;
            }
            if (sorted_results[k].coin == '79') {
                code = 'DOGE';
                a_code = 'DOGE';
                verify_link = 'https://dogechain.info/tx/';
                small_font = '';
                pointer = '';
                amount = number_format(sorted_results[k].amount, 2, '.', ',');
            }
            if (sorted_results[k].coin == '43') {
                code = 'PAYEER';
                a_code = 'USD';
                verify_link = '';
                sorted_results[k].hash = '';
                small_font = 'font-size: 12px; opacity: 0.4;';
                pointer = 'style="pointer-events: none"';
                amount = number_format(sorted_results[k].amount, 2, '.', ',');
            }
            if (sorted_results[k].coin == '18') {
                code = 'PM';
                a_code = 'USD';
                verify_link = '';
                sorted_results[k].hash = '';
                small_font = 'font-size: 12px; opacity: 0.4;';
                pointer = 'style="pointer-events: none"';
                amount = number_format(sorted_results[k].amount, 2, '.', ',');
            }
            
            var user_length = sorted_results[k].username.length;
            var xx = ''
            for(var v=0; v<user_length; v++){
                if(v !== user_length-3 ){
                    xx += sorted_results[k].username[v];
                }else {
                    xx += '***';
                    break;
                }
                
                
            }
            
            $('#proofs-container').append('<tr>\n' +
                '   <td class="table-des"><strong>' + xx + '</strong></td>\n' +
                '   <td class="table-des dispare">' + sorted_results[k].date + '</td>\n' +
                '   <td class="table-des"><strong><img src="images/'+sorted_results[k].coin+'.svg">' + amount + ' ' + a_code + '</strong></td>\n' +
                '   <td class="table-des"><a target="_blank" href="' + verify_link + sorted_results[k].hash + '"><span class="badge theme-grad badge-xs"><i class="fa fa-link"></i> Verify</span></a></td>\n' +
                '  </tr> '
            );
        }
        $('#proofs-pagination').on('click', '.proofPagination', function () {
            $('#proof-loading').css('display', 'block');
            var id = $(this)[0].id;
            var id_num = id.substr(7);
            var start_from = (parseInt(id_num)*interval) - interval + 1;
            var end_to = start_from + interval - 1;
            results_object = [];
            load_trs(start_from, end_to);
            $('#proofs-pagination').html('');
            for (var t=0; t<btns_count; t++){
                $('#proofs-pagination').append('<a href="#proofs-container" class="proofPagination" id="pg-btn-'+(t+1)+'">'+(t+1)+'</a>');
            }
            $('.proofPagination').removeClass('active');
            $('#'+id+'').addClass('active');
        });
    }
    load_trs(1, 20);

    /* pagination functions */
    // count number of pagination buttons
    var cnt_total = total_sorted[0].length;
    var interval = 20;
    var btns_count = (cnt_total/interval);
    var btns_decimal_part = btns_count - Math.floor(btns_count);
    var btns_integer_part = Math.floor(btns_count);
    // number of pagination buttons
    if(btns_decimal_part > 0){
        btns_count = btns_integer_part + 1;
    }else if(btns_decimal_part === 0) {
        btns_count = btns_integer_part;
    }

    $('#proofs-pagination').html('');
    for (var t=0; t<btns_count; t++){
        $('#proofs-pagination').append('<a href="#proofs-container" class="proofPagination" id="pg-btn-'+(t+1)+'">'+(t+1)+'</a>');
    }
    $('#pg-btn-1').addClass('active');
    // define start and end of pagination indexes
    $('#proofs-pagination').on('click', '.proofPagination', function () {
        $('#proof-loading').css('display', 'block');
        var id = $(this)[0].id;
        var id_num = id.substr(7);
        var start_from = (parseInt(id_num)*interval) - interval + 1;
        var end_to = start_from + interval - 1;
        results_object = [];
        load_trs(start_from, end_to);
        $('#proofs-pagination').html('');
        for (var t=0; t<btns_count; t++){
            $('#proofs-pagination').append('<a href="#proofs-container" class="proofPagination" id="pg-btn-'+(t+1)+'">'+(t+1)+'</a>');
        }
        $('.proofPagination').removeClass('active');
        $('#'+id+'').addClass('active');
    });
});

// smooth scroll to anchor
$("a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
            scrollTop: $(hash).offset().top
        }, 800, function(){

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
        });
    } // End if
});
