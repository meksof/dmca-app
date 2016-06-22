(function($) {
    var o = $({});

    $.subscribe = function() {
        o.on.apply(o, arguments);
    };

    $.unsubscribe = function() {
        o.off.apply(o, arguments);
    };

    $.publish = function() {
        o.trigger.apply(o, arguments);
    };
}(jQuery));
(function() {

    var submitAjaxRequest = function(e) {
        var form = $(e.target).closest('form[data_remote]');
        var method = form.find('input[name="_method"]').val() || 'POST';

        $.ajax({
            type: method,
            url: form.prop('action'),
            data: form.serialize(),
            success: function() {
                $.publish('form.submitted', form);
            }
        });
        e.preventDefault();
    };

    $('body').on('change', '.remove', submitAjaxRequest);

})();
(function() {
    $.subscribe('form.submitted', function() {
        $('.flash').fadeIn(500).delay(1000).fadeOut(500);
    });
})();