<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch{
    /**
     * @var int | null
     *
     */
    private $MaxPrice;

    /**
     * @var int | null
     * @Assert\Range(min="10",max="400")  
     */
    private $MinSurface;

    /**
     * @var ArrayCollection
     */
    private $options;

    public function __construct(){
        $this->options = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->MaxPrice;
    }

    /**
     * @param int|null $MaxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(?int $MaxPrice): PropertySearch
    {
        $this->MaxPrice = $MaxPrice;
        return $this;
    }

    /**
     * @return int|null
     * 
     */
    public function getMinSurface(): ?int
    {
        return $this->MinSurface;
    }

    /**
     * @param int|null $MinSurface
     * @return PropertySearch
     */
    public function setMinSurface(?int $MinSurface): PropertySearch
    {
        $this->MinSurface = $MinSurface;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): Arraycollection
    {
        return $this->options;
    }

     /**
     * @param int|null $MinSurface
     * @return PropertySearch
     */
    public function setOptions(ArrayCollection $options): void
    {
       $this->options = $options;
    }

}