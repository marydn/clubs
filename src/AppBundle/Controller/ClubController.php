<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Club;
use AppBundle\Form\ClubType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClubController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $clubs = $this->getDoctrine()->getRepository('AppBundle:Club')->findAll();

        return $this->render('AppBundle:Club:list.html.twig', array(
            'clubs' => $clubs,
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(ClubType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $club = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();

            return $this->redirectToRoute('list');
        }

        return $this->render('AppBundle:Club:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param Club $club
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, Club $club)
    {
        $form = $this->createForm(ClubType::class, $club);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($form->get('players')->getData() as $player) {
                if ($club->getPlayers()->contains($player)) {
                    $player->setClub($club);
                } else {
                    $player->serClub(null);
                    $club->removePlayer($player);
                }

                $em->persist($player);
            }

            $em->persist($club);
            $em->flush();

            return $this->redirectToRoute('list');
        }

        return $this->render('AppBundle:Club:update.html.twig', array(
            'form' => $form->createView(),
            'club' => $club,
        ));
    }

    /**
     * @param Club $club
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Club $club)
    {
        /** @var \AppBundle\Service\ClubService $service */
        $service = $this->get('app.club');
        $service->removeClub($club);

        return $this->redirectToRoute('list');
    }
}
