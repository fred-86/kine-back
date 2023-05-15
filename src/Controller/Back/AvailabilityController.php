<?php

namespace App\Controller\Back;

use App\Entity\Back\Availability;
use App\Form\Back\AvailabilityType;
use App\Repository\AvailabilityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/availability")
 */
class AvailabilityController extends AbstractController
{
    /**
     * @Route("/", name="app_back_availability_index", methods={"GET"})
     */
    public function index(AvailabilityRepository $availabilityRepository): Response
    {
        return $this->render('back/availability/index.html.twig', [
            'availabilities' => $availabilityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_availability_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AvailabilityRepository $availabilityRepository): Response
    {
        $availability = new Availability();
        $form = $this->createForm(AvailabilityType::class, $availability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $availabilityRepository->add($availability, true);

            return $this->redirectToRoute('app_back_availability_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/availability/new.html.twig', [
            'availability' => $availability,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_availability_show", methods={"GET"})
     */
    public function show(Availability $availability): Response
    {
        return $this->render('back/availability/show.html.twig', [
            'availability' => $availability,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_availability_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Availability $availability, AvailabilityRepository $availabilityRepository): Response
    {
        $form = $this->createForm(AvailabilityType::class, $availability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $availabilityRepository->add($availability, true);

            return $this->redirectToRoute('app_back_availability_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/availability/edit.html.twig', [
            'availability' => $availability,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_availability_delete", methods={"POST"})
     */
    public function delete(Request $request, Availability $availability, AvailabilityRepository $availabilityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$availability->getId(), $request->request->get('_token'))) {
            $availabilityRepository->remove($availability, true);
        }

        return $this->redirectToRoute('app_back_availability_index', [], Response::HTTP_SEE_OTHER);
    }
}
