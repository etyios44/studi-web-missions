<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\TypeMission;
use App\Form\TypeMissionType;
use App\Repository\TypeMissionRepository;
use Doctrine\Persistence\ObjectManager;
use ftp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeMissionController extends AbstractController
{
    #[Route('/type_mission', name: 'typemission')]
    public function index(TypeMissionRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        //$repo = $this->getDoctrine()->getRepository(Article::class);
        $typemission = $repo->findAll();
        //dump($missions);

        $typemission = $paginator->paginate(
            $typemission, // target to paginate
            $request->query->getInt('page', 1), // page parameter, now section
            2
        );

        return $this->render('type_mission/index.html.twig', [
            'controller_name' => 'TypeMissionController',
            'typemission' => $typemission
        ]);
    }

    #[Route('/type_mission/new', name: 'typemission_create')]
    #[Route('/type_mission/{id}/edit', name: 'typemission_edit')]
    public function form(TypeMission $typemission = null, Request $request, ObjectManager $manager)
    {
        if(!$typemission) {
            $typemission = new TypeMission();
            $typemission->setTitle('Type Mission ...');
        }    
        $form = $this->createForm(TypeMissionType::class, $typemission);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($typemission);
            $manager->flush();

            return $this->redirectToRoute('typemission', ['id' => $typemission->getId()]);
        }

        return $this->render('type_mission/create.html.twig',
            [
                'formTypeMission' => $form->createView(),
                'editMode' => $typemission->getId() !== null
            ]);
    }

    #[Route('/type_mission/{id}/del', name: 'typemission_del')]
    public function del(TypeMission $typemission): RedirectResponse 
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($typemission);
        $em->flush();
        return $this->redirectToRoute('typemission');
    }


    #[Route('/type_mission/{id}/show', name: 'typemission_show')]
    public function show(int $id): Response
    {
        $typemission = $this->getDoctrine()
            ->getRepository(TypeMission::class)
            ->find($id);

        return $this->render('type_mission/show.html.twig', [
            'controller_name' => 'TypeMissionController',
            'typemission' => $typemission
        ]);
    }

    
}
