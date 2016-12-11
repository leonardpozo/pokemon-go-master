<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PokemonController extends Controller
{
    /**
     * @Route("/pokemons", name="pokemon")
     */
    public function displayPokemons()
    {
        $manager = $this->getDoctrine()->getManager();
        $pokemonRepository = $manager->getRepository('AppBundle:Pokemon\Pokemon');

        $pokemons = $pokemonRepository->findAll();

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $json = $serializer->serialize($pokemons, 'json');

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/users", name="user")
     */
    public function getUser()
    {
        $manager = $this->getDoctrine()->getManager();
        $userRepository = $manager->getRepository('AppBundle:User\User');

        $user = $userRepository->findAll();

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $json = $serializer->serialize($user, 'json');

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/find/{id}", name="find")
     */
    public function findPokemon($id)
    {
        $pokemonBehavior = $this->get('behavior.pokemon');
        $randompokemon=$pokemonBehavior->createRandomPokemon($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($randompokemon);
        $manager->flush();

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $json = $serializer->serialize($randompokemon, 'json');

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/catch/{id}", name="catch")
     */
    public function catchPokemon($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $pokemonUserStatsRepository=$manager->getRepository('AppBundle:Pokemon\UserPokemonStats');
        $catchedpokemon=$pokemonUserStatsRepository->find($id);
        $catchedpokemon->setCatched(true);
        $manager->flush();

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $json = $serializer->serialize($catchedpokemon, 'json');

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("/pokedex/{id}", name="pokedex")
     */
    public function pokedex($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $pokemonUserStatsRepository=$manager->getRepository('AppBundle:Pokemon\UserPokemonStats');
        $catchedpokemon=$pokemonUserStatsRepository->findBy(array('user'=>$id,'catched'=>1));

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $json = $serializer->serialize($catchedpokemon, 'json');

        return new JsonResponse($json, 200, [], true);
    }
}

