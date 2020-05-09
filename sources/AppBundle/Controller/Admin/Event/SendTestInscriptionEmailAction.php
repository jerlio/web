<?php

namespace AppBundle\Controller\Admin\Event;

use AppBundle\Controller\Event\EventActionHelper;
use AppBundle\Email\Emails;
use AppBundle\Email\Mailer\MailUserFactory;
use AppBundle\Routing\LegacyRouter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class SendTestInscriptionEmailAction
{
    /** @var EventActionHelper */
    private $eventActionHelper;
    /** @var Emails */
    private $emails;
    /** @var LegacyRouter */
    private $legacyRouter;
    /** @var FlashBagInterface */
    private $flashBag;

    public function __construct(
        EventActionHelper $eventActionHelper,
        Emails $emails,
        LegacyRouter $legacyRouter,
        FlashBagInterface $flashBag
    ) {
        $this->eventActionHelper = $eventActionHelper;
        $this->emails = $emails;
        $this->legacyRouter = $legacyRouter;
        $this->flashBag = $flashBag;
    }

    public function __invoke(Request $request)
    {
        $event = $this->eventActionHelper->getEventById($request->query->get('id'), false);
        $this->emails->sendInscription($event, MailUserFactory::bureau());
        $this->flashBag->add('notice', 'Mail de test envoyé');

        return new RedirectResponse($this->legacyRouter->getAdminUrl('forum_gestion', ['action' => 'modifier', 'id' => $event->getId()]));
    }
}