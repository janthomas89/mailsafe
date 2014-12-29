(function(factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object' && typeof module === 'object') {
        factory(require('jquery'));
    } else {
        factory(window.jQuery);
    }
})(function($, undefined) {
    /**
     * Reverses the given string.
     * @param input
     * @returns {string}
     */
    var reverse = function (input) {
        return input.split('').reverse().join('');
    };

    $.fn.mailsafe = function() {

        /* works only in modern browsers */
        if (!atob) {
            return this;
        }

        return this.each(function() {
            $elms = $(this).find('[data-mailsafe]');
            $elms.each(function () {
                var $this = $(this);
                var decoded = $.parseJSON(atob($this.data('mailsafe')));
                var mail = reverse(decoded[0]);
                var name = decoded[1] || mail;

                var $a = $('<a />')
                    .attr('href', 'mailto:' + mail)
                    .attr('class', $this.attr('class'))
                    .html(name);

                $this.replaceWith($a);
            });
        });
    };

    /* Initializes the mails on page load. */
    $(function() {
        $('body').mailsafe();
    });
})