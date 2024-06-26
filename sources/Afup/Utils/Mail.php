<?php

namespace Afup\Site\Utils;

use AppBundle\Email\Mailer\Mailer;
use AppBundle\Email\Mailer\Adapter\PhpMailerAdapter;
use Psr\Log\NullLogger;
use Twig\Loader\FilesystemLoader;
use Twig_Environment;

class Mail
{
    const PROJECT_DIR = __DIR__.'/../../..';

    public static function createMailer()
    {
        $configuration = new Configuration();

        return new Mailer(
            new NullLogger(),
            new Twig_Environment(new FilesystemLoader(self::PROJECT_DIR.'/app/Resources/views/')),
            PhpMailerAdapter::createFromConfiguration($configuration),
            $configuration
        );
    }
}
