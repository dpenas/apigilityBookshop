<?php

namespace Bookshop\V1\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Authors
 *
 * @ORM\Table(name="authors")
 * @ORM\Entity
 */
class Authors
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
     * @ORM\Column(name="name", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="born_date", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $bornDate;

    /**
     * @var Books
     *
     * @ORM\ManyToMany(targetEntity="Books", mappedBy="authors")
     */
    protected $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
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
     * Set bornDate.
     *
     * @param \DateTime|null $bornDate
     *
     * @return Authors
     */
    public function setBornDate(?\DateTime $bornDate = null): self
    {
        $this->bornDate = $bornDate;

        return $this;
    }

    /**
     * Get bornDate.
     *
     * @return \DateTime|null
     */
    public function getBornDate(): ?\DateTime
    {
        return $this->bornDate;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Authors
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
