<?php

namespace JanThomas89\Bundle\MailSafeBundle\Twig\Extension;

use JanThomas89\Bundle\MailSafeBundle\Services\MailSafeService;

/**
 * Class MailSafeExtension
 * @package JanThomas89\Bundle\MailSafeBundle\Twig\Extension
 */
class MailSafeExtension extends \Twig_Extension
{
    /**
     * The referenced service to generate the spans.
     *
     * @var \JanThomas89\Bundle\MailSafeBundle\Services\MailSafeService
     */
    protected $service;

    /**
     * @param MailSafeService $service
     */
    public function __construct(MailSafeService $service)
    {
        $this->service = $service;
    }

    /**
     * Returns the extensions name.
     *
     * @return string
     */
    public function getName()
    {
        return 'mail_safe_extension';
    }

    /**
     * Returns the extensions filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter(
                'mailsafe',
                array($this, 'mailsafeFilter'),
                array('is_safe' => array('html'))
            )
        );
    }

    /**
     * Generates a span for the given mail and name.
     *
     * @param $email
     * @param string $name
     * @return string
     */
    public function mailsafeFilter($email, $name = '')
    {
        return $this->service->generate($email, $name);
    }
}
