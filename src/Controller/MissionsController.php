<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Missions;
use App\Form\MissionsType;
use App\Repository\MissionsRepository;
use Doctrine\Persistence\ObjectManager;
use ftp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionsController extends AbstractController
{
    #[Route('/missions', name: 'missions')]
    public function index(MissionsRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $q = $request->query->get('q');
        $s = $request->query->get('direction');

        //$missions = $repo->findAll();
        $missions = $repo->findAllWithSearch($q, $s);
        
        //dd($missions);

        $missions = $paginator->paginate(
            $missions, // target to paginate
            $request->query->getInt('page', 1), // page parameter, now section
            2
        );

        return $this->render('missions/index.html.twig', [
            'controller_name' => 'MissionsController',
            'missions' => $missions
        ]);
    }

    #[Route('/missions/new', name: 'missions_create')]
    #[Route('/missions/{id}/edit', name: 'missions_edit')]
    public function form(Missions $missions = null, Request $request, ObjectManager $manager)
    {
        if(!$missions) {
            $missions = new Missions();
            $missions->setTitleMission('Mission ...')
            ->setDescriptionMission('etc');
        }    
        $form = $this->createForm(MissionsType::class, $missions);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($missions);
            $manager->flush();

            return $this->redirectToRoute('missions', ['id' => $missions->getId()]);
        }

        return $this->render('missions/create.html.twig',
            [
                'formMissions' => $form->createView(),
                'editMode' => $missions->getId() !== null
            ]);
    }

    #[Route('/missions/{id}/del', name: 'missions_del')]
    public function del(Missions $missions): RedirectResponse 
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($missions);
        $em->flush();
        return $this->redirectToRoute('missions');
    }


    #[Route('/missions/{id}/show', name: 'missions_show')]
    public function show(int $id): Response
    {
        $missions = $this->getDoctrine()
            ->getRepository(Missions::class)
            ->find($id);

        return $this->render('missions/show.html.twig', [
            'controller_name' => 'MissionsController',
            'missions' => $missions
        ]);
    }

    
}
