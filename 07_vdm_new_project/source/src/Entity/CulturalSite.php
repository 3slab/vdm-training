<?php

namespace App\Entity;

use App\Repository\CulturalSiteRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CulturalSiteRepository::class)
 */
class CulturalSite
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     *
     * @var string|null
     */
    protected $id;

    /**
     * @ORM\Column(type="float")
     *
     * @var float|null
     */
    protected $long;

    /**
     * @ORM\Column(type="float")
     *
     * @var float|null
     */
    protected $lat;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    protected $name;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return CulturalSite
     */
    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLong(): ?float
    {
        return $this->long;
    }

    /**
     * @param float|null $long
     * @return CulturalSite
     */
    public function setLong(?float $long): self
    {
        $this->long = $long;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @param float|null $lat
     * @return CulturalSite
     */
    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return CulturalSite
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
