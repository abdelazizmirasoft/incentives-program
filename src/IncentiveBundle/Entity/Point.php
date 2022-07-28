<?php

namespace IncentiveBundle\Entity;

use DateTime;

/**
 * Point
 */
class Point
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $source;

    /**
     * @var String
     */
    private $sourceType;

    /**
     * @var datetime
     */
    private $createdAt;

    /**
     * @var bool
     */
    private $withdrawn = false;

    /**
     * @var int
     */
    private $points;

    public function __construct()
    {
        $this->createdAt = new DateTime(); 
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set source
     *
     * @param integer $source
     *
     * @return Point
     */
    public function setSource($source): Point
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return int
     */
    public function getSource(): ?int
    {
        return $this->source;
    }

    /**
     * Set sourceType
     *
     * @param String $sourceType
     *
     * @return Point
     */
    public function setSourceType(String $sourceType): Point
    {
        $this->sourceType = $sourceType;

        return $this;
    }

    /**
     * Get sourceType
     *
     * @return String
     */
    public function getSourceType(): String
    {
        return $this->sourceType;
    }

    /**
     * Set createdAt
     *
     * @param integer $createdAt
     *
     * @return Point
     */
    public function setCreatedAt($createdAt): Point
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt(): datetime
    {
        return $this->createdAt;
    }

    /**
     * @return bool
     */
    public function isWithdrawn(): bool
    {
        return $this->withdrawn;
    }

    /**
     * @param bool $withdrawn
     *
     * @return Point
     */
    public function setWithdrawn($withdrawn): Point
    {
        $this->withdrawn = $withdrawn;

        return $this;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return Point
     */
    public function setPoints($points): Point
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }
}

