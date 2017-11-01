<?php

namespace AppBundle\Controller;

use AppBundle\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlayerController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(PlayerType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $player = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            return $this->redirectToRoute('list');
        }

        return $this->render('AppBundle:Player:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
