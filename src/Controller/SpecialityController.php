<?php

namespace App\Controller; 

use App\Entity\Agent;
use App\Entity\Speciality;
use App\Form\SpecialityType;
use App\Repository\AgentRepository;
use App\Repository\SpecialityRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class SpecialityController extends AbstractController
{
    #[Route('/speciality', name: 'speciality')]
    public function index(SpecialityRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {

        $speciality = $repo->findAll();

        $speciality = $paginator->paginate(
            $speciality, // target to paginate
            $request->query->getInt('page', 1), // page parameter, now section
            2
        );

        return $this->render('speciality/index.html.twig', [
            'controller_name' => 'SpecialityController',
            'speciality' => $speciality
        ]);
    }

    #[Route('/speciality/new', name: 'speciality_create')]
    #[Route('/speciality/{id}/edit', name: 'speciality_edit')]
    public function form(Speciality $speciality = null, Request $request, ObjectManager $manager)
    {
        if(!$speciality) {
            $speciality = new Speciality();
            $speciality->setName('Speciality ...');
        }    

        dump($speciality);
        //die; 

        $form = $this->createForm(SpecialityType::class, $speciality);
        
        $form->handleRequest($request);
        
        
        if($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($speciality);
            $manager->flush();
            
            return $this->redirectToRoute('speciality', ['id' => $speciality->getId()]);
        }
        
        return $this->render('speciality/create.html.twig',
            [
                'formSpeciality' => $form->createView(),
                'editMode' => $speciality->getId() !== null
            ]);
    }

    #[Route('/speciality/{id}/del', name: 'speciality_del')]
    public function del(Speciality $speciality): RedirectResponse 
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($speciality);
        $em->flush();
        return $this->redirectToRoute('speciality');
    }


    #[Route('/speciality/{id}/show', name: 'speciality_show')]
    public function show(int $id): Response
    {
        $speciality = $this->getDoctrine()
            ->getRepository(Speciality::class)
            ->find($id);

        return $this->render('speciality/show.html.twig', [
            'controller_name' => 'SpecialityController',
            'speciality' => $speciality
        ]);
    }

   


}
