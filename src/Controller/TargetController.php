<?php

namespace App\Controller; 

use App\Entity\Target;
use App\Form\TargetType;
use App\Repository\TargetRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class TargetController extends AbstractController
{
    #[Route('/target', name: 'target')]
    public function index(TargetRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {

        $target = $repo->findAll();
        //dump($status);

        $target = $paginator->paginate(
            $target, // target to paginate
            $request->query->getInt('page', 1), // page parameter, now section
            2
        );

        return $this->render('target/index.html.twig', [
            'controller_name' => 'TargetController',
            'target' => $target
        ]);
    }

    #[Route('/target/new', name: 'target_create')]
    #[Route('/target/{id}/edit', name: 'target_edit')]
    public function form(Target $target = null, Request $request, ObjectManager $manager)
    {
        if(!$target) {
            $target = new Target();
            $target->setName('Name ...');
        }    
        $form = $this->createForm(TargetType::class, $target);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($target);
            $manager->flush();

            return $this->redirectToRoute('target', ['id' => $target->getId()]);
        }

        return $this->render('target/create.html.twig',
            [
                'formTarget' => $form->createView(),
                'editMode' => $target->getId() !== null
            ]);
    }

    #[Route('/target/{id}/del', name: 'target_del')]
    public function del(Target $target): RedirectResponse 
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($target);
        $em->flush();
        return $this->redirectToRoute('target');
    }


    #[Route('/target/{id}/show', name: 'target_show')]
    public function show(int $id): Response
    {
        $target = $this->getDoctrine()
            ->getRepository(Target::class)
            ->find($id);

        return $this->render('target/show.html.twig', [
            'controller_name' => 'TargetController',
            'target' => $target
        ]);
    }

   


}
