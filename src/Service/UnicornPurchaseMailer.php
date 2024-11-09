<?php

namespace App\Service;

use App\Entity\Unicorn;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UnicornPurchaseMailer
{
    public function __construct(
        private MailerInterface $mailer
    ) {}

    public function sendPurchaseConfirmation(Unicorn $unicorn): void
    {
        $posts = $unicorn->getPosts();

        $textContent = "Thank you for purchasing {$unicorn->getName()}!\n\nPosts linked to this unicorn:\n\n";
        
        $postsText = '';
        foreach ($posts as $post) {
            $postsText .= "- {$post->getCreatedAt()->format('d/m/Y H:i')} {$post->getAuthor()}: {$post->getMessage()} \n";
        }

        $textContent .= $postsText;

        $email = (new Email())
            ->from('unicorn-guestbook@unicornfarm.com')
            ->to('buyer@test.com')
            ->subject('Unicorn Purchase Confirmation')
            ->text($textContent);

        $this->mailer->send($email);
    }
}
