<?php

namespace App\Controller\Back;

use App\Entity\Back\Appointment;
use App\Form\Back\AppointmentType;
use App\Repository\Back\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/appointment")
 */
class AppointmentController extends AbstractController
{
    /**
     * @Route("", name="app_back_appointment_index", methods={"GET"})
     */
    public function index(AppointmentRepository $appointmentRepository): Response
    {
        return $this->render('back/appointment/index.html.twig', [
            'appointments' => $appointmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_appointment_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AppointmentRepository $appointmentRepository): Response
    {
        $appointment = new Appointment();
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appointmentRepository->add($appointment, true);

            return $this->redirectToRoute('app_back_appointment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/appointment/new.html.twig', [
            'appointment' => $appointment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_appointment_show", methods={"GET"})
     */
    public function show(Appointment $appointment): Response
    {
        return $this->render('back/appointment/show.html.twig', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_appointment_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Appointment $appointment, AppointmentRepository $appointmentRepository): Response
    {
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appointmentRepository->add($appointment, true);

            return $this->redirectToRoute('app_back_appointment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/appointment/edit.html.twig', [
            'appointment' => $appointment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_appointment_delete", methods={"POST"})
     */
    public function delete(Request $request, Appointment $appointment, AppointmentRepository $appointmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appointment->getId(), $request->request->get('_token'))) {
            $appointmentRepository->remove($appointment, true);
        }

        return $this->redirectToRoute('app_back_appointment_index', [], Response::HTTP_SEE_OTHER);
    }
}
