<?php

namespace IncentiveBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Action
 */
class Action
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $points;

    /**
     * @var bool
     */
    private $hasBonus = false;

    /**
     * @var Collection|Boosters[]
     */
    private $boosters;

    public function __construct()
    {
        $this->boosters = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Action
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Action
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return Action
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @return bool
     */
    public function getHasBonus()
    {
        return $this->hasBonus;
    }

    /**
     * @param bool $hasBonus
     */
    public function setHasBonus($hasBonus)
    {
        $this->hasBonus = $hasBonus;
    }

    /**
     * @return Collection|Booster[]
     */
    public function getBoosters()
    {
        return $this->boosters;
    }

    /**
     * @param Collection|Booster[] $boosters
     */
    public function setBoosters($boosters)
    {
        $this->boosters = $boosters;
    }
}

