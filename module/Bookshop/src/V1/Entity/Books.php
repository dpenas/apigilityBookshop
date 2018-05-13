<?php

namespace Bookshop\V1\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\ManyToMany(targetEntity="Authors", mappedBy="books")
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
    public function getId()
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
    public function setReleaseDate($releaseDate = null)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate.
     *
     * @return \DateTime|null
     */
    public function getReleaseDate()
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
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Authors
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param Authors $authors
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
    }

    /**
     * @param ArrayCollection $authors
     */
    public function addAuthors(ArrayCollection $authors)
    {
        foreach($authors as $author) {
            $this->authors->add($author);
        }
    }

    /**
     * @param ArrayCollection $authors
     */
    public function removeAuthors(ArrayCollection $authors)
    {
        foreach($authors as $author) {
            $this->authors->remove($author->getId());
        }
    }
}
