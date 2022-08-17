$('[data-countdown]').each(function () {
    var $this = $(this),
        finalDate = $(this).data('countdown'),
        id = $(this).data('id');
    $this.countdown(finalDate, function (event) {
        if (finalDate != '') {
            $this.html(event.strftime('%H:%M:%S'));

            var status = $(this).data('status');
            
            if (status == 'PROGRESING' && event.offset.minutes <= 10) {
                $(this).data('status', 'FINISHING');
                $(this).parent().parent()[0].style.backgroundColor = 'aqua';
                triggerStatus(id, 'FINISHING');

            } else if (event.offset.minutes == 00 && event.offset.seconds == 0) {
                $(this).data('status', 'AVAILABLE');
                $(this).parent().parent()[0].style.backgroundColor = '#00ff00';
                triggerStatus(id, 'AVAILABLE');
            }


        }
    })
    // .on('finish.countdown', function() { callback
    //     $(this).hide();
    // });
});

function triggerStatus(id, toStatus) {
    $.ajax({
        type: 'GET',
        url: base_url + 'transactions/' + id + '/status/' + toStatus,
        success: function (data) {

        },
        error: function (err) {
            debugger;
        }
    });
}
