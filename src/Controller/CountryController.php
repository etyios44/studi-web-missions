<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class CountryController extends AbstractController
{
    #[Route('/country', name: 'country')]
    public function index(CountryRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $country = $repo->findAll();
        //dd($contact);

        $country = $paginator->paginate(
            $country, // target to paginate
            $request->query->getInt('page', 1), // page parameter, now section
            2
        );

        return $this->render('country/index.html.twig', [
            'controller_name' => 'CountryController',
            'country' => $country
        ]);
    }

    #[Route('/country/new', name: 'country_create')]
    #[Route('/country/{id}/edit', name: 'country_edit')]
    public function form(Country $country = null, Request $request, ObjectManager $manager)
    {
        if(!$country) {
            $country = new Country();
            $country->setname('Pays ...');
        }    

        dump($country);
        //die;
        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($country);
            $manager->flush();

            return $this->redirectToRoute('country', ['id' => $country->getId()]);
        }

        return $this->render('country/create.html.twig',
            [
                'formCountry' => $form->createView(),
                'editMode' => $country->getId() !== null
            ]);
    }

    #[Route('/country/{id}/del', name: 'country_del')]
    public function del(Country $country): RedirectResponse 
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($country);
        $em->flush();
        return $this->redirectToRoute('country');
    }


    #[Route('/country/{id}/show', name: 'country_show')]
    public function show(int $id): Response
    {
        $country = $this->getDoctrine()
            ->getRepository(Country::class)
            ->find($id);

        return $this->render('country/show.html.twig', [
            'controller_name' => 'CountryController',
            'country' => $country
        ]);
    }

    
}
