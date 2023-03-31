new WOW().init();
(function ($) {

        $.fn.countDown = function (onExpiredFn) {

            this.each(function () {


                if (!onExpiredFn) onExpiredFn = function () {};

                var countDownDate = new Date($(this).data('time')).getTime();
                var $this = $(this);
                var now = new Date($this.data('time-now')).getTime();
                var distance = countDownDate - now;

                // Update the count down every 1 second
                var x = setInterval(function () {

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    var countDown = '';

                    if (days > 0) {
                        countDown += days + 'd, ';
                    }

                    countDown += hours + 'h, ';
                    countDown += minutes + 'm, ';
                    countDown += seconds + 's';

                    $this.html(countDown);

                    if (distance < 0) {
                        clearInterval(x);
                        $this.html("<font color='red'>Calculate next earning time</font>");
                        onExpiredFn();
                    }

                    if (days > 7) {
                        $('.pay_button').attr("disabled", "disabled");

                    }
                    distance = distance - 1000;

                }, 1000);
            });
        };

    }
    (jQuery))
