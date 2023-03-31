$(document).ready(function (e) {
    var intervalID = setInterval(function () {
        DoCalculate();
    }, 300);
    $("#txtAmount").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

function DoCalculate() {
    var temp1 = $('#txtAmount').val();
    if (temp1.length == 0) {
        temp1 = 0;
    }
    var temp2 = $('#txtDays').val();
    if (temp2.length == 0) {
        temp2 = 0;
    }
    var initial = parseFloat(temp1);
    var amount = initial;
    var amountAtEndOfDay;
    var days = parseFloat(temp2);
    var rate = parseFloat($("#txtRate").val()) / 100;
    var totalProfit = 0;
    var release = 0.95;
    $("#lblHourlyProfit").val(parseFloat((initial * rate) / 24).toFixed(8));
    $("#lblDailyProfit").val(parseFloat(initial * rate).toFixed(8));
    $("#lblWeeklyProfit").val(parseFloat((initial * rate) * 7).toFixed(8));
    $("#lblMonthlyProfit").val(parseFloat((initial * rate) * 30).toFixed(8));
    $("#lblTotalProfit").val(parseFloat((initial * rate) * days).toFixed(8));
}
