<?php

namespace JanThomas89\Bundle\MailSafeBundle\Services;

/**
 * Class MailSafeService
 * Service for generating the spans for safe mail output.
 *
 * @package JanThomas89\Bundle\MailSafeBundle\Services
 */
class MailSafeService
{
    /**
     * Additional css classes to alter the styling.
     *
     * @var string
     */
    protected $cssClasses;

    /**
     * Charset for string operations.
     *
     * @var string
     */
    protected $charset;

    /**
     * Constructs the service.
     *
     * @param string $cssClasses
     * @param string $charset
     */
    public function __construct($cssClasses = '', $charset = 'UTF-8')
    {
        $this->cssClasses = $cssClasses;
        $this->charset = $charset;
    }

    /**
     * Generates a span for the given email and name.
     *
     * @param $email
     * @param string $name
     * @return string
     */
    public function generate($email, $name = '')
    {
        $attrs = array();

        /* data-mailsafe */
        $attrs['data-mailsafe'] = $this->crypt($email, $name);

        /* Additional css classes */
        if ($this->cssClasses != '') {
            $attrs['class'] = $this->cssClasses;
        }

        return $this->generateHTML($attrs);
    }

    /**
     * Crypts / encodes the email and name.
     * (reverse => json => base64)
     *
     * @param $email
     * @param string $name
     * @return string
     */
    protected function crypt($email, $name = '')
    {
        $emailCrypted = '';
        $length = mb_strlen($email, $this->charset);

        for ($i = $length; $i > 0; $i--) {
            $emailCrypted .= mb_substr($email, $i - 1, 1, $this->charset);
        }

        return base64_encode(json_encode(array(
            $emailCrypted,
            $name
        )));
    }

    /**
     * Renders the span for the given attributes.
     *
     * @param array $attrs
     * @return string
     */
    protected  function generateHTML(array $attrs)
    {
        $html = '<span';

        foreach ($attrs as $key => $value) {
            $html .= ' ' . $key . '="' . $value . '"';
        }

        $html .= '></span>';

        return $html;
    }
}
