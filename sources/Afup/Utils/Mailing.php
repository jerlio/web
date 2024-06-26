<?php

namespace Afup\Site\Utils;

use AppBundle\Email\Mailer\Message;

class Mailing
{
    /**
     * @param Message $message
     * @param string $body
     * @return bool
     */
    public static function envoyerMail(Message $message, $body)
    {
        $recipients = $message->getRecipients();
        $recipient = reset($recipients);
        $message->setContent(str_replace('$EMAIL$', $recipient->getEmail(), $body));

        return Mail::createMailer()->send($message);
    }
}
