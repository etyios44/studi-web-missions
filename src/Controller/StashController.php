<?php

namespace App\Controller; 

use App\Entity\Stash;
use App\Form\StashType;
use App\Repository\StashRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class StashController extends AbstractController
{
    #[Route('/stash', name: 'stash')]
    public function index(StashRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {

        $stash = $repo->findAll();
        //dump($status);

        $stash = $paginator->paginate(
            $stash, // target to paginate
            $request->query->getInt('page', 1), // page parameter, now section
            2
        );

        return $this->render('stash/index.html.twig', [
            'controller_name' => 'StashController',
            'stash' => $stash
        ]);
    }

    #[Route('/stash/new', name: 'stash_create')]
    #[Route('/stash/{id}/edit', name: 'stash_edit')]
    public function form(Stash $stash = null, Request $request, ObjectManager $manager)
    {
        if(!$stash) {
            $stash = new Stash();
            $stash->setCode('Code ...');
        }    
        $form = $this->createForm(StashType::class, $stash);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($stash);
            $manager->flush();

            return $this->redirectToRoute('stash', ['id' => $stash->getId()]);
        }

        return $this->render('stash/create.html.twig',
            [
                'formStash' => $form->createView(),
                'editMode' => $stash->getId() !== null
            ]);
    }

    #[Route('/stash/{id}/del', name: 'stash_del')]
    public function del(Stash $stash): RedirectResponse 
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($stash);
        $em->flush();
        return $this->redirectToRoute('stash');
    }


    #[Route('/stash/{id}/show', name: 'stash_show')]
    public function show(int $id): Response
    {
        $stash = $this->getDoctrine()
            ->getRepository(Stash::class)
            ->find($id);

        return $this->render('stash/show.html.twig', [
            'controller_name' => 'StashController',
            'stash' => $stash
        ]);
    }

   


}
