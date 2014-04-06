(function($, undefined) {

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

                console.log(mail, name);
            });
        });
    };

    /* Initializes the mails on page load. */
    $(function() {
        $('body').mailsafe();
    });

})(jQuery);