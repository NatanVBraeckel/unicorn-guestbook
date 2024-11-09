<?php

namespace App\Service;

use App\Entity\Unicorn;
use Doctrine\ORM\EntityManagerInterface;

class UnicornPurchaseService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function removePostsForUnicorn(Unicorn $unicorn): void
    {
        $posts = $unicorn->getPosts();

        foreach ($posts as $post) {
            $this->entityManager->remove($post);
        }

        $this->entityManager->flush();
    }
}
