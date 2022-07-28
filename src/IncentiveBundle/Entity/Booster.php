<?php

namespace IncentiveBundle\Entity;

use DateTime;

/**
 * Booster
 */
class Booster
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
    private $points;

    /**
     * @var int
     */
    private $timeFrame;

    /**
     * @var int
     */
    private $frequency;

    /**
     * @var bool
     */
    private $enabled = false;

    /**
     * @var datetime
     */
    private $createdAt;

    /**
     * @var Action
     */
    private $action;


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
     * Set name
     *
     * @param string $name
     *
     * @return Booster
     */
    public function setName($name): Booster
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return Booster
     */
    public function setPoints($points): Booster
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

    /**
     * Set timeFrame
     *
     * @param integer $timeFrame
     *
     * @return Booster
     */
    public function setTimeFrame($timeFrame): Booster
    {
        $this->timeFrame = $timeFrame;

        return $this;
    }

    /**
     * Get timeFrame
     *
     * @return int
     */
    public function getTimeFrame(): int
    {
        return $this->timeFrame;
    }

    /**
     * Set frequency
     *
     * @param int $frequency
     *
     * @return Booster
     */
    public function setFrequency($frequency): Booster
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return int
     */
    public function getFrequency(): int
    {
        return $this->frequency;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return Booster
     */
    public function setEnabled(bool $enabled): Booster
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Set createdAt
     *
     * @param int $createdAt
     *
     * @return Booster
     */
    public function setCreatedAt(int $createdAt): Booster
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param Action $action
     * @return Booster
     */
    public function setAction(Action $action): ?Booster
    {
        $this->action = $action;

        return $this;
    }
}

