<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type;

/**
 * Class AppController
 * @package AppBundle\Controller
 */
class AppController extends Controller
{
    /**
     * Home page action.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $publications = $em->getRepository('AppBundle:Publication')->findBy(['validated'=>1], ['publishedAt'=>'DESC'],3);

        return $this->render('AppBundle:App:home.html.twig', ['publications'=>$publications]);

    }

    public function sciencesAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $sciences = $em->getRepository('AppBundle:Science')->findBy([],['title'=>'ASC']);

        return $this->render('AppBundle:App:sciences.html.twig', ['sciences' => $sciences]);

    }

    public function scienceDetailAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $scienceId = $request->attributes->get('idScience');
        $science = $em->getRepository('AppBundle:Science')->find($scienceId);

        $publications = $em->getRepository('AppBundle:Publication')->findBy(['science'=> $science,
                                                                             'validated'=>1]);

        return $this->render('AppBundle:App:science.html.twig', array('science'=> $science,
                                                                  'publications'=>$publications));
    }

    public function publicationDetailAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $idPublication = $request->attributes->get('idPublication');
        $publication = $em->getRepository('AppBundle:Publication')->find($idPublication);

        $idScience = $request->attributes->get('idScience');
        $science = $em->getRepository('AppBundle:Science')->find($idScience);

        return $this->render('AppBundle:App:publicationDetail.html.twig', ['publication'=>$publication,
                                                                            'science'=>$science]);
    }

    public function publishAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $publication = new Publication();

        $form = $this
            ->createForm('AppBundle\Form\PublicationType', $publication)
            ->add('Add', Type\SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($publication);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('AppBundle:App:publish.html.twig', ['form' => $form->createView()]);
    }


}
