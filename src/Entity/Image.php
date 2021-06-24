<?php

namespace App\Entity;

use App\Entity\SaleCars;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImageRepository;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SaleCars::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $saleCarsId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $info;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSaleCarsId(): ?SaleCars
    {
        return $this->saleCarsId;
    }

    public function setSaleCarsId(?SaleCars $saleCarsId): self
    {
        $this->saleCarsId = $saleCarsId;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getAdd(): ?SaleCars
    {
        return $this->add;
    }

    public function setAdd(?SaleCars $add): self
    {
        $this->add = $add;

        return $this;
    }
}
