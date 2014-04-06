mailsafe
========

Simple symfony 2 bundle to output an email in a spam safe way

How it works?
----
In order to hide an email address for spam bots, mailsafe renders a span element instead of the raw email address.
The spans data-mailsafe attribute represents a reversed and base 64 encoded version of the email address.

<span data-mailsafe="WyJlZC5lcmF3dGZvcy1zYW1vaHRuYWpAb2ZuaSIsIiJd"></span>

To display a human readable version of this email the span is replaced via javascript.


How to use?
----
Include @JanThomas89MailSafeBundle/Resources/public/js/mailsafe.jquery.js in your template.
Then use the twig filter "mailsafe" whenever you want to output an email.

{{ "example@example.com" | mailsafe }}