<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ObjectManager;
use ftp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(ContactRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $contact = $repo->findAll();
        //dd($contact);

        $contact = $paginator->paginate(
            $contact, // target to paginate
            $request->query->getInt('page', 1), // page parameter, now section
            2
        );

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contact' => $contact
        ]);
    }

    #[Route('/contact/new', name: 'contact_create')]
    #[Route('/contact/{id}/edit', name: 'contact_edit')]
    public function form(Contact $contact = null, Request $request, ObjectManager $manager)
    {
        if(!$contact) {
            $contact = new Contact();
            $contact->setname('Contact ...');
        }    
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($contact);
            $manager->flush();

            return $this->redirectToRoute('contact', ['id' => $contact->getId()]);
        }

        return $this->render('contact/create.html.twig',
            [
                'formContact' => $form->createView(),
                'editMode' => $contact->getId() !== null
            ]);
    }

    #[Route('/contact/{id}/del', name: 'contact_del')]
    public function del(Contact $contact): RedirectResponse 
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();
        return $this->redirectToRoute('contact');
    }


    #[Route('/contact/{id}/show', name: 'contact_show')]
    public function show(int $id): Response
    {
        $contact = $this->getDoctrine()
            ->getRepository(Contact::class)
            ->find($id);

        return $this->render('contact/show.html.twig', [
            'controller_name' => 'ContactController',
            'contact' => $contact
        ]);
    }

    
}
