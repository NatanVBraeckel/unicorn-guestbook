<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Unicorn;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create unicorns
        $unicorn1 = new Unicorn();
        $unicorn1->setName('Sparkle');
        $manager->persist($unicorn1);

        $unicorn2 = new Unicorn();
        $unicorn2->setName('Rainbow');
        $manager->persist($unicorn2);

        // create posts
        $post1 = new Post();
        $post1->setAuthor('Natan');
        $post1->setMessage('I love Sparkle!');
        $post1->setUnicorn($unicorn1);
        $manager->persist($post1);

        $post2 = new Post();
        $post2->setAuthor('Nona');
        $post2->setMessage('Rainbow is amazing!');
        $post2->setUnicorn($unicorn2);
        $manager->persist($post2);

        $post3 = new Post();
        $post3->setAuthor('Natan');
        $post3->setMessage('Rainbow is alright...');
        $post3->setUnicorn($unicorn2);
        $manager->persist($post3);

        $manager->flush();
    }
}
