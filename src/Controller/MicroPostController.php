<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/micro-posts', 'app_micro_post_')]
class MicroPostController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MicroPostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        return $this->render('micro_post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function show(MicroPostRepository $postRepository, int $id): Response
    {
        $post = $postRepository->find($id);
        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/add', name: 'add')]
    public function add(Request $request, MicroPostRepository $postRepository): Response
    {
        $form = $this->createForm(MicroPostType::class, new MicroPost());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setCreatedAt(new \DateTime());
            $postRepository->save($post);

            $this->addFlash('success', 'Your post have been added!');
            return $this->redirectToRoute('app_micro_post_index');
        }

        return $this->renderForm(
            'micro_post/add.html.twig', [
                'form' => $form
            ]
        );
    }

    #[Route('/edit/{id}', name: 'edit', requirements: ['id' => '\d+'])]
    public function edit(Request $request, MicroPostRepository $postRepository, int $id): Response
    {
        $microPost = $postRepository->find($id);
        $form = $this->createForm(MicroPostType::class, $microPost);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $postRepository->save($post);

            $this->addFlash('success', 'Your post have been edited!');
            return $this->redirectToRoute('app_micro_post_index');
        }

        return $this->renderForm(
            'micro_post/edit.html.twig', [
                'form'=>$form
            ]
        );
    }
}
