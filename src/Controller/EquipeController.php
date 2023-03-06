<?php

namespace App\Controller;


use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;








#[Route('/equipe')]
class EquipeController extends AbstractController
{
    #[Route('/recherche_ajax', name: 'recherche_ajax')]

    public function rechercheAjax(Request $request, EquipeRepository $sr): JsonResponse
    {
        $requestString = $request->query->get('searchValue');
        $resultats = $sr->findUserByNsc($requestString);
        return $this->json($resultats);
    }



    #[Route('/search', name: 'app_equipe_search')]
    public function search(EquipeRepository $EquipeRepository, Request $request): Response

    {
        
       
            return $this->render('equipe/search.html.twig', [
                'equipes' => $EquipeRepository->findAll(),
            ]);
        
    }
    #[Route('/', name: 'app_equipe_index', methods: ['GET'])]
    public function index(EquipeRepository $equipeRepository,): Response
    {
        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_equipe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EquipeRepository $equipeRepository, SluggerInterface $slugger): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('logo')->getData();

            // // this condition is needed because the 'brochure' field is not required
            // // so the PDF file must be processed only when a file is uploaded
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

                //     // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('equipe_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $equipe->setLogo($newFilename);
            }
             $equipeRepository->save($equipe, true);

            return $this->redirectToRoute('app_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipe/new.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipe_show', methods: ['GET'])]
    public function show(Equipe $equipe): Response
    {
        return $this->render('equipe/show.html.twig', [
            'equipe' => $equipe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equipe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipe $equipe, EquipeRepository $equipeRepository): Response
    {
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipeRepository->save($equipe, true);

            return $this->redirectToRoute('app_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipe/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipe_delete', methods: ['POST'])]
    public function delete(Request $request, Equipe $equipe, EquipeRepository $equipeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipe->getId(), $request->request->get('_token'))) {
            $equipeRepository->remove($equipe, true);
        }

        return $this->redirectToRoute('app_equipe_index', [], Response::HTTP_SEE_OTHER);
    }
   
    
    #[Route('/{id}/rating', name: 'rating')]
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, [
            'stars' => $options['stars']
        ]);
    }

    public function configureOptions($resolver)
    {
        $resolver->setDefaults([
            'attr' => [
                'class' => 'rating',
            ],
            'scale' => 1,
            'stars' => 5,
        ]);
    }

    public function getParent()
    {
        return NumberType::class;
    }

    public function getName()
    {
        return 'rating';
    }
    
}
