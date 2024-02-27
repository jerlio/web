<?php

declare(strict_types=1);

namespace AppBundle\Controller\Planete;

use PlanetePHP\FeedRepository;
use Symfony\Component\HttpFoundation\Response;

final class FeedsController
{
    /** @var FeedRepository */
    private $feedRepository;

    public function __construct(FeedRepository $feedRepository)
    {
        $this->feedRepository = $feedRepository;
    }

    public function __invoke(): Response
    {
        $feeds = $this->feedRepository->findActive();

        $data = [];

        foreach ($feeds as $feed) {
            $data[] = [
                'name' => $feed->getName(),
                'url' => $feed->getUrl(),
            ];
        }

        return new Response(json_encode($data), 200, ['Content-Type' => 'application/json']);
    }
}
