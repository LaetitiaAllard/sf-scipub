<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DashboardController
 * @package AppBundle\Controller\Admin
 */
class DashboardController extends Controller
{
    /**
     * Dashboard action.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction()
    {
        return $this->render('dashboard/dashboard.html.twig');
    }
}
