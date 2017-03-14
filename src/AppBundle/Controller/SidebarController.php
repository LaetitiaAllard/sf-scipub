<?php
/**
 * Created by PhpStorm.
 * User: allar
 * Date: 14/03/2017
 * Time: 14:31
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SidebarController extends Controller
{
    public function sciencesAction()
    {
        $sciences = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:Science')->findAll();

        return $this->render('AppBundle:Layout:sidebar.html.twig', ['sciences'=>$sciences]);
    }
}