<?php

namespace App\Controller;

use App\Entity\PerformanceEquipe;
use App\Form\PerformanceEquipe1Type;
use App\Repository\PerformanceEquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/performance_equipe')]
class PerformanceEquipeController extends AbstractController
{
    #[Route('/', name: 'app_performance_equipe_index', methods: ['GET'])]
    public function index(PerformanceEquipeRepository $performanceEquipeRepository): Response
    {
        return $this->render('performance_equipe/index.html.twig', [
            'performance_equipes' => $performanceEquipeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_performance_equipe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PerformanceEquipeRepository $performanceEquipeRepository): Response
    {
        $performanceEquipe = new PerformanceEquipe();
        $form = $this->createForm(PerformanceEquipe1Type::class, $performanceEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $performanceEquipeRepository->save($performanceEquipe, true);

            return $this->redirectToRoute('app_performance_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('performance_equipe/new.html.twig', [
            'performance_equipe' => $performanceEquipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_performance_equipe_show', methods: ['GET'])]
    public function show(PerformanceEquipe $performanceEquipe): Response
    {
        return $this->render('performance_equipe/show.html.twig', [
            'performance_equipe' => $performanceEquipe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_performance_equipe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PerformanceEquipe $performanceEquipe, PerformanceEquipeRepository $performanceEquipeRepository): Response
    {
        $form = $this->createForm(PerformanceEquipe1Type::class, $performanceEquipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $performanceEquipeRepository->save($performanceEquipe, true);

            return $this->redirectToRoute('app_performance_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('performance_equipe/edit.html.twig', [
            'performance_equipe' => $performanceEquipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_performance_equipe_delete', methods: ['POST'])]
    public function delete(Request $request, PerformanceEquipe $performanceEquipe, PerformanceEquipeRepository $performanceEquipeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$performanceEquipe->getId(), $request->request->get('_token'))) {
            $performanceEquipeRepository->remove($performanceEquipe, true);
        }

        return $this->redirectToRoute('app_performance_equipe_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route("/stats", name:"stats")]
     
    public function statistiquess(PerformanceEquipeRepository $evRepo)
    {
        // On va chercher le nombre de performance  par victoires
        $performanceEquipe = $evRepo->countByDate();

        $victoires = [];
        $performanceEquipeCount = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach ($performanceEquipe as $performanceEquipes) {
            $victoires[] = $performanceEquipes['victoires'];
            $performanceEquipeCount[] = $performanceEquipe['count'];
        }

        return $this->render('performance_equipe/stat.html.twig', [

            'victoires' => json_encode($victoires),
            'performanceEquipeCount' => json_encode($performanceEquipeCount),
        ]);
}
}
