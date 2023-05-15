<?php

namespace App\Controller\Back;

use App\Entity\Back\Reviews;
use App\Form\Back\ReviewsType;
use App\Repository\Back\ReviewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/reviews")
 */
class ReviewsController extends AbstractController
{
    /**
     * @Route("/", name="app_back_reviews_index", methods={"GET"})
     */
    public function index(ReviewsRepository $reviewsRepository): Response
    {
        return $this->render('back/reviews/index.html.twig', [
            'reviews' => $reviewsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_reviews_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ReviewsRepository $reviewsRepository): Response
    {
        $review = new Reviews();
        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reviewsRepository->add($review, true);

            return $this->redirectToRoute('app_back_reviews_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/reviews/new.html.twig', [
            'review' => $review,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_reviews_show", methods={"GET"})
     */
    public function show(Reviews $review): Response
    {
        return $this->render('back/reviews/show.html.twig', [
            'review' => $review,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_reviews_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reviews $review, ReviewsRepository $reviewsRepository): Response
    {
        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reviewsRepository->add($review, true);

            return $this->redirectToRoute('app_back_reviews_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/reviews/edit.html.twig', [
            'review' => $review,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_reviews_delete", methods={"POST"})
     */
    public function delete(Request $request, Reviews $review, ReviewsRepository $reviewsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            $reviewsRepository->remove($review, true);
        }

        return $this->redirectToRoute('app_back_reviews_index', [], Response::HTTP_SEE_OTHER);
    }
}
