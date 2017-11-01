<?php

namespace AppBundle\Service;

/**
 * Created by PhpStorm.
 * User: mary
 * Date: 1/11/17
 * Time: 9:59
 */

/**
 * Class ClubService
 */
class ClubService
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * ClubService constructor.
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \AppBundle\Entity\Club $club
     */
    public function removeClub(\AppBundle\Entity\Club $club)
    {
        // gedmo will do the job
        $this->entityManager->remove($club);
        $this->entityManager->flush();
    }
}