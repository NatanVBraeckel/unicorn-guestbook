<?php

namespace App\Controller;

use App\Entity\Unicorn;
use App\Service\UnicornPurchaseMailer;
use App\Service\UnicornPurchaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UnicornPurchaseController extends AbstractController
{
    public function __construct(
        private UnicornPurchaseService $unicornPurchaseService,
        private UnicornPurchaseMailer $unicornPurchaseMailer,
    ) {}

    public function __invoke(Unicorn $unicorn): Response
    {
        $this->unicornPurchaseMailer->sendPurchaseConfirmation($unicorn);

        $this->unicornPurchaseService->removePostsForUnicorn($unicorn);
        
        return new Response('Unicorn purchased successfully!', Response::HTTP_OK);
    }
}
