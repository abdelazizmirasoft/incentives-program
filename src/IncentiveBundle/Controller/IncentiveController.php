<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is licensed exclusively to Abdelaziz Mirad
 * @note        Feel free to modify this template, take a look at .php_cs file
 *
 * @copyright   Copyright © 2022-2022 Abdelaziz Mirad
 * @license     All rights reserved
 * @author      Abdelaziz Mirad [abdelaziz.mirad@gmail.com]
 */

namespace IncentiveBundle\Controller;

use IncentiveBundle\Entity\Point;
use IncentiveBundle\Entity\Type\PointTypeEnum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class IncentiveController extends Controller
{
    const BONUS_VALIDITY_DAYS = "30";


    /**
     * @return Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $points = $em->getRepository('IncentiveBundle:Point')->findAll();
        foreach($points as $point){
            if($point->getSourceType() == PointTypeEnum::ACTION ){
                $point->setPoints($em->getRepository('IncentiveBundle:Action')->findBySource($point->getSource())->getPoints());
            }
            else if($point->getSourceType() == PointTypeEnum::BONUS ){
                $point->setPoints($em->getRepository('IncentiveBundle:Booster')->findBySource($point->getSource())->getPoints());
            }
        }
        return $this->render('IncentiveBundle:Incentive:index.html.twig', array(
            'points' => $points,
        ));
    }

    
    /**
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $point  = new Point();
        $form = $this->createForm('IncentiveBundle\Form\PointType', $point);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $point->setSource($request->request->get($form->getName())['source']);
            $point->setSourceType(PointTypeEnum::ACTION);
            $em->persist($point);
            $em->flush();
            $pointsChecker = $this->get('action.points_checker');
            $pointsChecker->checkBonusPoint($point);
            return $this->redirectToRoute('incentive_index', array('id' => $point->getId()));
        }

        return $this->render('IncentiveBundle:Incentive:new.html.twig', array(
            'point'  => $point,
            'form' => $form->createView(),
        ));
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function calculateAction(Request $request)
    {
        $form = $this->createFormBuilder()->add(
                    'given_date',
                    DateType::class, 
                    [
                        'widget' => 'single_text',
                        'format' => 'yyyy-MM-dd',
                    ]
                )->getForm();
        $form->handleRequest($request);
        $totalPoints = null;            
        if ($form->isSubmitted() && $form->isValid()) {
            $given_date = $request->request->get($form->getName())['given_date'];
            $pointsChecker = $this->get('action.points_checker');
            $totalPoints = $pointsChecker->calculatePoints($given_date, self::BONUS_VALIDITY_DAYS);
            // $totalPoints = $this->calculatePoints($given_date);
            return $this->render('IncentiveBundle:Incentive:calculate.html.twig', array(
                'form' => $form->createView(),
                'totalPoints' => $totalPoints
            ));
        }

        return $this->render('IncentiveBundle:Incentive:calculate.html.twig', array(
            'form' => $form->createView(),
            'totalPoints' => $totalPoints
        ));
    }


}
