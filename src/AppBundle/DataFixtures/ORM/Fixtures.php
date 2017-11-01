<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Created by PhpStorm.
 * User: mary
 * Date: 1/11/17
 * Time: 9:32
 */
class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 30; $i++) {
            $player = new Player();
            $player->setName('Jugador '.$i);
            $manager->persist($player);
        }

        $manager->flush();
    }
}
