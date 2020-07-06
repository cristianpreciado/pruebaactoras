<?php

namespace App\Controller;

use App\Entity\Movies;
use App\Form\MoviesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movies")
 */
class MoviesController extends AbstractController
{
    /**
     * @Route("/", name="movies_index", methods={"GET"})
     */
    public function index(): Response
    {
        $movies = $this->getDoctrine()
            ->getRepository(Movies::class)
            ->findAll();

        return $this->render('movies/index.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * @Route("/new", name="movies_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $movie = new Movies();
        $form = $this->createForm(MoviesType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('movies_index');
        }

        return $this->render('movies/new.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movies_show", methods={"GET"})
     */
    public function show(Movies $movie): Response
    {
        return $this->render('movies/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="movies_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Movies $movie): Response
    {
        $form = $this->createForm(MoviesType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('movies_index');
        }

        return $this->render('movies/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movies_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Movies $movie): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $json = array();
        $mensaje = '';

        $entityManager = $this->getDoctrine()->getManager();

        try {

            $movie->setStatusActors(0);
            $entityManager->persist($actor);
            $entityManager->flush();

            $json['status'] = 1;
        } catch (\Doctrine\DBAL\DBALException $e) {
            $mensaje = $e->getMessage();
            $response->setStatusCode(500);
        } catch (\Exception $e) {
            $mensaje = $e->getMessage();
            $response->setStatusCode(500);
        }

        $json['mensaje'] = $mensaje;

        $response->setContent(json_encode($json));
        $em->getConnection()->close();
        return $response;
    }
}
