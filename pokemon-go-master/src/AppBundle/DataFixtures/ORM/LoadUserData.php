<?php


namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures as NativeLoader;

class LoadUserData implements FixtureInterface
{


    public function load(ObjectManager $manager){
       /* $userObjects = NativeLoader::load(__DIR__.'/../../Resources/fixtures/orm/user/user.yml', $manager);
*/
    }

}