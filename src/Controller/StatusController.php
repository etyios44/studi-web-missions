<?php

namespace App\Controller; 

use App\Entity\Status;
use App\Form\StatusType;
use App\Repository\StatusRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class StatusController extends AbstractController
{
    #[Route('/status', name: 'status')]
    public function index(StatusRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {

        $status = $repo->findAll();
        //dump($status);

        $status = $paginator->paginate(
            $status, // target to paginate
            $request->query->getInt('page', 1), // page parameter, now section
            2
        );

        return $this->render('status/index.html.twig', [
            'controller_name' => 'StatusController',
            'status' => $status
        ]);
    }

    #[Route('/status/new', name: 'status_create')]
    #[Route('/status/{id}/edit', name: 'status_edit')]
    public function form(Status $status = null, Request $request, ObjectManager $manager)
    {
        if(!$status) {
            $status = new Status();
            $status->setDetailStatus('Status ...');
        }    
        $form = $this->createForm(StatusType::class, $status);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($status);
            $manager->flush();

            return $this->redirectToRoute('status', ['id' => $status->getId()]);
        }

        return $this->render('status/create.html.twig',
            [
                'formStatus' => $form->createView(),
                'editMode' => $status->getId() !== null
            ]);
    }

    #[Route('/status/{id}/del', name: 'status_del')]
    public function del(Status $status): RedirectResponse 
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($status);
        $em->flush();
        return $this->redirectToRoute('status');
    }


    #[Route('/status/{id}/show', name: 'status_show')]
    public function show(int $id): Response
    {
        $status = $this->getDoctrine()
            ->getRepository(Status::class)
            ->find($id);

        return $this->render('status/show.html.twig', [
            'controller_name' => 'StatusController',
            'status' => $status
        ]);
    }

   


}
