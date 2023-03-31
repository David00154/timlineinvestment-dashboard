
<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Site Properities -->
    <title></title>
    <link rel="stylesheet" type="text/css" href="traderwidget/plat.css">
    <link rel="stylesheet" type="text/css" href="traderwidget/responsive.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
</head>
<body>
<style>

</style>
<div class="block-charts" id="chart-holder">
    <!--<div class="block-charts ">-->
    <div class="one-chart">
        <div class="mini-chart-wrap">
            <div class="deal-finish-popup">
                <div class="deal-finish-popup-win">
                    <h2 class="dfp-head">Congratulations! You predicted the market and earned $19!</h2>
                    <p class="dfp-body">
                    </p>
                    <div class="dfp-foot">
                        <a class="link_out" target="_parent" href="deposit.php">
                            <div class="left-foot"><i class="fa fa-arrow-up"></i></div>
                            <div class="right-foot">
                                <span>Open an account</span>,
                                and start trading now!
                            </div>
                        </a>
                        <a class="restart" id="restart"><i class="fa fa-refresh"></i><span>New forecast</span></a>
                    </div>
                </div>
                <div class="deal-finish-popup-lose">
                    <h2 class="dfp-head">Incorrect forecast</h2>
                    <p class="dfp-body">
                    </p>
                </div>
            </div>
            <div class="mini-chart-legend">
                <div class="mc-table lg-ogo">
                    <div class="mc-table-td mc-logo-empty"></div>
                    <div class="mc-table-td mc-table-td_price" data-style="width: 30%;">
                        <div class="mc-table-td-legend">Price</div>
                        <div class="mc-table-td-value text-green">$50</div>
                    </div>
                    <div class="mc-table-td mc-table-td_profit" data-style="width: 40%;">
                        <div class="mc-table-td-legend">Profit</div>
                        <div class="mc-table-td-value">$100</div>
                    </div>
                    <div class="mc-table-td mc-table-td_revenue" data-style="width: 30%;">
                        <div class="mc-table-td-legend">Revenue</div>
                        <div class="mc-table-td-value text-green">90%</div>
                    </div>
                </div>
            </div>
            <div class="mini-chart-btn-cont">
                <div class="mc-logo mc-logo_eurusd">
                    <form>
                        <div id="radio" class="ui-buttonset">
                            <input type="radio" id="radio1" name="radio" value="0"
                                   class="ui-helper-hidden-accessible"><label for="radio1" style="width: 180px;"
                                                                              class="ui-state-active ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left"
                                                                              role="button" id="Apple"><span
                                class="ui-button-text">Apple</span></label>
                            <input type="radio" id="radio2" name="radio" value="1"
                                   class="ui-helper-hidden-accessible"><label for="radio2" style="width: 180px;"
                                                                              class="ui-button ui-widget ui-state-default ui-button-text-only"
                                                                              role="button" id="GAZPROM"><span
                                class="ui-button-text">GAZPROM</span></label>
                            <input type="radio" id="radio3" name="radio" value="2"
                                   class="ui-helper-hidden-accessible">
                                   <label for="radio3" style="width: 180px;" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right"
                                                                              role="button" id="EURUSD"><span
                                class="ui-button-text">EUR/USD</span></label>
                        </div>
                    </form>
                </div>
                <button class="mc-btn mc-btn_call" id="btn_call">
                    <img class="svg-ico-call" src="traderwidget/arrow-call.svg">
                    <span>Will go<b>up</b></span>
                </button>
                <button class="mc-btn mc-btn_put" id="btn_put">
                    <img class="svg-ico-put" src="traderwidget/arrow-put.svg">
                    <span>Will go<b>down</b></span>
                </button>
                <div class="wait-deal-end">
                    <div class="wde-legend">Wait for trade close:</div>
                    <div class="wde-timer-cont">
                        <div class="chart-timer"><i><img class="svg-ico-call" src="traderwidget/clock-spinner.svg"></i><span
                                class="chart-time-self">00:08</span></div>
                    </div>
                </div>
            </div>
            <div class="mini-chart-cont">
                <div class="chart-padding">
                    <div id="chart1" class="chart">
                        <!--<img width="490" height="254"-->
                        <!--style="height: 254px; width: 490px;vertical-align: top;margin-bottom: -10px;"-->
                        <!--src="images/plat-template.png">-->
                        <div width="490" height="254"
                             style="height: 254px; width: 490px;vertical-align: top;margin-bottom: -10px;"
                             id="chart-m"></div>
                        <!--<canvas width="524" height="220" style="position: absolute; left: 0px; top: 0px; height: 220px; width: 524px;"></canvas>-->
                        <div class="chart-timer">
                        	<i>
                        		<img class="svg-ico-call" src="traderwidget/clock-spinner.svg">
                        	</i>
                            <!--<span    class="chart-time-self">00:08</span>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="deal-finish-popup mini-chart-wrap deal-finished deal-finished_win">
        <div class="deal-finish-popup-win">
            <h2 class="dfp-head">
                Your trading result: <span id="win_amt"></span><br/>Try again!</h2>
            <p class="dfp-body">
            </p>
            <div class="dfp-foot">
                <a class="link_out" target="_parent" href="deposit.php">
                    <div class="left-foot"><i class="fa fa-arrow-left"></i></div>
                    <div class="right-foot">
                        <span>Fund Account Now</span>,
                        Start Making real Profits!
                    </div>
                </a>
                <a class="restart" id="restart-chart"><i class="fa fa-refresh"></i><span>New forecast</span></a>
            </div>
        </div>
        <div class="deal-finish-popup-lose">
            <h2 class="dfp-head">Incorrect forecast</h2>
            <p class="dfp-body">

            </p>
        </div>
    </div>
</div>

<script src="assets/vendor_components/jquery/dist/jquery.js"></script>
<script src="traderwidget/moment.js"></script>
<script src="traderwidget/chart.js"></script>
<script src="traderwidget/main.js"></script>

</body>
</html>
