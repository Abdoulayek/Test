<?php

namespace App\Controller;

use App\Entity\Clientscall;
use App\Form\Clientscall1Type;
use App\Repository\ClientscallRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/clientscall')]
class ClientscallController extends AbstractController
{
    #[Route('/', name: 'app_clientscall_index', methods: ['GET'])]
    public function index(ClientscallRepository $clientscallRepository): Response
    {
        return $this->render('clientscall/index.html.twig', [
            'clientscalls' => $clientscallRepository->findBy(array('statut' => 'Projet')),
        ]);
    }

    #[Route('/new', name: 'app_clientscall_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ClientscallRepository $clientscallRepository): Response
    {
        $clientscall = new Clientscall();
        $form = $this->createForm(Clientscall1Type::class, $clientscall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientscallRepository->save($clientscall, true);

            return $this->redirectToRoute('app_clientscall_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('clientscall/new.html.twig', [
            'clientscall' => $clientscall,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_clientscall_show', methods: ['GET'])]
    public function show(Clientscall $clientscall): Response
    {
        return $this->render('clientscall/show.html.twig', [
            'clientscall' => $clientscall,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_clientscall_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Clientscall $clientscall, ClientscallRepository $clientscallRepository): Response
    {
        $form = $this->createForm(Clientscall1Type::class, $clientscall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientscallRepository->save($clientscall, true);

            return $this->redirectToRoute('app_clientscall_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('clientscall/edit.html.twig', [
            'clientscall' => $clientscall,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_clientscall_delete', methods: ['POST'])]
    public function delete(Request $request, Clientscall $clientscall, ClientscallRepository $clientscallRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clientscall->getId(), $request->request->get('_token'))) {
            $clientscallRepository->remove($clientscall, true);
        }

        return $this->redirectToRoute('app_clientscall_index', [], Response::HTTP_SEE_OTHER);
    }
}
