$('[data-countdown]').each(function () {
    var $this = $(this),
        finalDate = $(this).data('countdown');
    $this.countdown(finalDate, function (event) {
        if(finalDate != '' ){
            $this.html(event.strftime('%H:%M:%S'));
        }
    })
    // .on('finish.countdown', function() { callback
    //     $(this).hide();
    // });
});