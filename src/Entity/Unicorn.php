<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post as ApiPost;
use ApiPlatform\OpenApi\Model\Operation;
use App\Controller\UnicornPurchaseController;
use App\Repository\UnicornRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UnicornRepository::class)]
#[UniqueEntity(fields: ['name'], message: 'This name for a unicorn is already taken.')]
#[ApiResource(
    operations: [
        new GetCollection(),
        new ApiPost(
            name: 'purchase',
            description: 'Purchases a Unicorn.',
            uriTemplate: '/unicorns/{id}/purchase',
            controller: UnicornPurchaseController::class,
            openapi: new Operation(
                summary: 'Purchases a Unicorn.',
                description: 'Sends an email containing all posts linked to this unicorn and removes all those posts.',
            )
        )
    ]
)]
class Unicorn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $name = null;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'unicorn', orphanRemoval: true)]
    private Collection $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): static
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setUnicorn($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUnicorn() === $this) {
                $post->setUnicorn(null);
            }
        }

        return $this;
    }
}
