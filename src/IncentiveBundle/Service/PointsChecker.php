<?php


namespace IncentiveBundle\Service;


use IncentiveBundle\Entity\Point;
use Doctrine\ORM\EntityManager;
use IncentiveBundle\Entity\Type\PointTypeEnum;

class PointsChecker
{
    /** @var EntityManager */
    protected $entityManager;

    /**
     * PointsChecker constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @param Point $point
     * @return int
     */
    public function checkBonusPoint(Point $point): bool
    {
        $existBonus = false;
        // Get the action of the newely created point
        $action = $this->entityManager->getRepository('IncentiveBundle:Action')->findBySource($point->getSource());
        // Ignore bonus calculation if the current action has no booster
        if (!$action->getHasBonus())
            return $existBonus;
        // Get the booster attached to of the newely created point
        $booster = $this->entityManager->getRepository('IncentiveBundle:Booster')->findByAction($action);
        // Get the start time of the time frame
        $lastTimeFrame = date("Y-m-d H:i:s", strtotime('-'.$booster->getTimeFrame().' hours'));
        // Count how many bonus we already served a bonus (related to the actual action) in the last time frame 
        $bonusPointsCount = $this->entityManager->getRepository('IncentiveBundle:Point')->countBonusInTimeFrame($lastTimeFrame, $booster->getId());
        // Count how many action similar we have in the last time frame
        $actionPointsCount = $this->entityManager->getRepository('IncentiveBundle:Point')->countActionInTimeFrame($lastTimeFrame, $action->getId());

        // Check for the last time frame:
        // 1. if there is NO bonus was served
        // 2. if the count of similar action is equal or more than the defined frequency (set to 5 in our case)
        if ($bonusPointsCount === 0 && $actionPointsCount >= $booster->getFrequency()) {
            $existBonus = true;
            // Serve a new bonus points as defined 
            $bonusPoint = new Point();
            $bonusPoint->setSourceType(PointTypeEnum::BONUS);
            $bonusPoint->setSource($booster->getId());
            $this->entityManager->persist($bonusPoint);
            $this->entityManager->flush();
        }
        
        return $existBonus;
    }

    /**
     * @param String $date
     * @return int
     */
    public function calculatePoints(String $date, String $bonusValidityDays): int
    {
        // Get the SUM of action points prior to the given date 
        $totalActionPoints = $this->entityManager->getRepository('IncentiveBundle:Point')->sumActionPoints($date);
        // Get the SUM of bonus points prior to the given date
        $totalBonusPoints = $this->entityManager->getRepository('IncentiveBundle:Point')->sumBonusPoints($date, $bonusValidityDays);
        // SUM UP the total points
        return $totalActionPoints+$totalBonusPoints;
    }

}