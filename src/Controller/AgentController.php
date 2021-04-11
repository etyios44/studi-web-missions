<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Doctrine\Persistence\ObjectManager;
use ftp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentController extends AbstractController
{
    #[Route('/agent', name: 'agent')]
    public function index(AgentRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $agent = $repo->findAll();
        //dd($agent);

        $agent = $paginator->paginate(
            $agent, // target to paginate
            $request->query->getInt('page', 1), // page parameter, now section
            2
        );

        return $this->render('agent/index.html.twig', [
            'controller_name' => 'AgentController',
            'agent' => $agent
        ]);
    }

    #[Route('/agent/new', name: 'agent_create')]
    #[Route('/agent/{id}/edit', name: 'agent_edit')]
    public function form(Agent $agent = null, Request $request, ObjectManager $manager)
    {
        if(!$agent) {
            $agent = new Agent();
            $agent->setName('Agent ...');
        }    
        $form = $this->createForm(AgentType::class, $agent);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($agent);
            $manager->flush();

            return $this->redirectToRoute('agent', ['id' => $agent->getId()]);
        }

        return $this->render('agent/create.html.twig',
            [
                'formAgent' => $form->createView(),
                'editMode' => $agent->getId() !== null
            ]);
    }

    #[Route('/agent/{id}/del', name: 'agent_del')]
    public function del(Agent $agent): RedirectResponse 
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($agent);
        $em->flush();
        return $this->redirectToRoute('agent');
    }


    #[Route('/agent/{id}/show', name: 'agent_show')]
    public function show(int $id): Response
    {
        $agent = $this->getDoctrine()
            ->getRepository(Agent::class)
            ->find($id);

        return $this->render('agent/show.html.twig', [
            'controller_name' => 'AgentController',
            'agent' => $agent
        ]);
    }

    
}
