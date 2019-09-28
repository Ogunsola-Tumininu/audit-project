<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuditRepository")
 */
class Audit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $no_of_category;

    /**
     * @ORM\Column(type="integer")
     */
    private $no_of_section;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNoOfCategory(): ?int
    {
        return $this->no_of_category;
    }

    public function setNoOfCategory(int $no_of_category): self
    {
        $this->no_of_category = $no_of_category;

        return $this;
    }

    public function getNoOfSection(): ?int
    {
        return $this->no_of_section;
    }

    public function setNoOfSection(int $no_of_section): self
    {
        $this->no_of_section = $no_of_section;

        return $this;
    }
}
