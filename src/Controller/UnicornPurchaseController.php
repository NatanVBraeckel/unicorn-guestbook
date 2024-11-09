<?php

namespace App\Controller;

use App\Entity\Unicorn;
use App\Service\UnicornPurchaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UnicornPurchaseController extends AbstractController
{
    public function __construct(
        private UnicornPurchaseService $unicornPurchaseService
    ) {}

    public function __invoke(Unicorn $unicorn): Response
    {
        // TODO: send an email

        $this->unicornPurchaseService->removePostsForUnicorn($unicorn);
        
        return new Response('Unicorn purchased successfully!', Response::HTTP_OK);
    }
}
