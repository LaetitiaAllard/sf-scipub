<?php

namespace AppBundle\Service;

use AppBundle\Entity\Publication;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class Notifier
 * @package AppBundle\Service
 */
class Notifier
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var string
     */
    private $email;


    /**
     * Constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator (Le service 'router')
     * @param \Swift_Mailer         $mailer       (Le service 'mailer')
     * @param string                $email        (Le paramètre 'notify_email')
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        \Swift_Mailer $mailer,
        $email
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->mailer = $mailer;
        $this->email = $email;
    }

    /**
     * Notifies the administrator that a new publication has been submitted.
     *
     * @param Publication $publication
     *
     * @return int
     */
    public function notify(Publication $publication)
    {
        $body = sprintf(
            'Nouvelle publication à valider : <a href="%s">%s</a>',
            // Href du lien
            $this->urlGenerator->generate(
                'app_admin_publication_show',
                ['id' => $publication->getId()],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            // Libellé du lien
            $publication->getTitle()
        );

        /** @var \Swift_Mime_Message $message */
        $message = \Swift_Message::newInstance()
            ->setSubject('Nouvelle publication à valider')
            ->addFrom($this->email)
            ->addTo($this->email)
            ->setBody($body, 'text/html');

        return $this->mailer->send($message);
    }
}
