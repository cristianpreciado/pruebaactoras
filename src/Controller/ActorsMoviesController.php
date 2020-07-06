<?php

namespace App\Controller;

use App\Entity\ActorsMovies;
use App\Form\ActorsMoviesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/actors/movies")
 */
class ActorsMoviesController extends AbstractController
{
    /**
     * @Route("/", name="actors_movies_index", methods={"GET"})
     */
    public function index(): Response
    {
        $actorsMovies = $this->getDoctrine()
            ->getRepository(ActorsMovies::class)
            ->findAll();

        return $this->render('actors_movies/index.html.twig', [
            'actors_movies' => $actorsMovies,
        ]);
    }

    /**
     * @Route("/new", name="actors_movies_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $actorsMovie = new ActorsMovies();
        $form = $this->createForm(ActorsMoviesType::class, $actorsMovie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($actorsMovie);
            $entityManager->flush();

            return $this->redirectToRoute('actors_movies_index');
        }

        return $this->render('actors_movies/new.html.twig', [
            'actors_movie' => $actorsMovie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="actors_movies_show", methods={"GET"})
     */
    public function show(ActorsMovies $actorsMovie): Response
    {
        return $this->render('actors_movies/show.html.twig', [
            'actors_movie' => $actorsMovie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="actors_movies_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ActorsMovies $actorsMovie): Response
    {
        $form = $this->createForm(ActorsMoviesType::class, $actorsMovie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actors_movies_index');
        }

        return $this->render('actors_movies/edit.html.twig', [
            'actors_movie' => $actorsMovie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="actors_movies_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ActorsMovies $actorsMovie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$actorsMovie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($actorsMovie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('actors_movies_index');
    }
}
