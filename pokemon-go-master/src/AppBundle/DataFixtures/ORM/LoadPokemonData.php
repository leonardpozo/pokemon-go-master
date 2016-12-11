<?php
namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures as NativeLoader;
class LoadPokemonData implements FixtureInterface
{
    public function load(ObjectManager $manager){
        $typeObjects = NativeLoader::load(__DIR__.'/../../Resources/fixtures/orm/pokemon/type.yml', $manager);
        $pokemonObjects = NativeLoader::load(__DIR__.'/../../Resources/fixtures/orm/pokemon/pokemon.yml', $manager);
         NativeLoader::load(__DIR__.'/../../Resources/fixtures/orm/pokemon/test.yml', $manager);
    }
}
