<?php

namespace Bookshop\V1\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Books
 *
 * @ORM\Table(name="books")
 * @ORM\Entity
 */
class Books
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="release_date", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $releaseDate;

    /**
     * @var Authors
     *
     * @ORM\ManyToMany(targetEntity="Authors", inversedBy="books")
     */
    private $authors;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set releaseDate.
     *
     * @param \DateTime|null $releaseDate
     *
     * @return Books
     */
    public function setReleaseDate(?\DateTime$releaseDate = null): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate.
     *
     * @return \DateTime|null
     */
    public function getReleaseDate(): ?\DateTime
    {
        return $this->releaseDate;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Books
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Collection
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    /**
     * @param Collection|null $authors
     *
     * @return Books
     */
    public function setAuthors(?Collection $authors): self
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * @param Collection $authors
     */
    public function addAuthors(Collection $authors): void
    {
        foreach ($authors as $author) {
//            if ($this->authors->contains($author)) {
//                continue;
//            }

            $this->authors->add($author);
        }
    }

    /**
     * @param Collection $authors
     */
    public function removeAuthors(Collection $authors): void
    {
        foreach ($authors as $author) {
//            if (!$this->authors->contains($author)) {
//                continue;
//            }

            $this->authors->remove($author->getId());
        }
    }
}
