<?php
/**
 * Created by PhpStorm.
 * User: mary
 * Date: 1/11/17
 * Time: 12:03
 */

namespace AppBundle\Controller;

use AppBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $form = $this->createForm(SearchType::class, null, array(
            'action' => $this->generateUrl('search')
        ));

        $form->handleRequest($request);

        return $this->render('AppBundle:Search:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resultAction(Request $request)
    {
        $clubs = array();
        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $clubs = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:Club')
                ->search($form->get('club')->getData(), $form->get('phone')->getData());
        }

        return $this->render('AppBundle:Search:list.html.twig', array(
            'clubs' => $clubs,
        ));
    }
}