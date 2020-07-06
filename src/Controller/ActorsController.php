<?php

namespace App\Controller;

use App\Entity\Actors;
use App\Form\ActorsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/actors")
 */
class ActorsController extends AbstractController
{
    /**
     * @Route("/", name="actors_index", methods={"GET"})
     */
    public function index(): Response
    {
        $actors = $this->getDoctrine()
            ->getRepository(Actors::class)
            ->findAll();

        return $this->render('actors/index.html.twig', [
            'actors' => $actors,
        ]);
    }

    /**
     * @Route("/filtrar/{status}", name="actors_filter_satus", methods={"GET"})
     */
    public function filetrStatus(Request $request, $status): Response
    {
        $listaActores = $this->getDoctrine()
            ->getRepository(Actors::class)
            ->filterStatus($status);
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($listaActores));

        return $response;
    }

    /**
     * @Route("/new", name="actors_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $actor = new Actors();
        $form = $this->createForm(ActorsType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($actor);
            $entityManager->flush();

            return $this->redirectToRoute('actors_index');
        }

        return $this->render('actors/new.html.twig', [
            'actor' => $actor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="actors_show", methods={"GET"})
     */
    public function show(Actors $actor): Response
    {
        return $this->render('actors/show.html.twig', [
            'actor' => $actor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="actors_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Actors $actor): Response
    {
        $form = $this->createForm(ActorsType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actors_index');
        }

        return $this->render('actors/edit.html.twig', [
            'actor' => $actor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="actors_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Actors $actor): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $json = array();
        $mensaje = '';

        $entityManager = $this->getDoctrine()->getManager();

        try {

            $actor->setStatusActors(0);
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
        $entityManager->getConnection()->close();
        return $response;
    }
}
