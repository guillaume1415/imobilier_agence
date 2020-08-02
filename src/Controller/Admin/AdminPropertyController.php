<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController{

    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;
//,ObjectManager $em

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;


        //$this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.property.index")
     * @return Response
     */
    public function index(){
        $properties = $this->repository->findAll();
        return $this->render('admin/Property/index.html.twig',compact('properties'));
    }


    /**
     * @Route("/admin/property/creat ", name="admin.property.new")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(Request $request){
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success','Votre bien à bien était enregistrée');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/Property/new.html.twig',[
            'property' => $property,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/property/{id}", name="admin.property.edit",methods="GET|POST")
     * @param Property $property
     * @return Response
     */
    public function edit(Property $property,Request $request){

        
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','Votre modification à bien était enregistrée');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/Property/edit.html.twig',[
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/{id}", name="admin.property.delete",methods="DELETE")
     * @param Property $property
     * @return RedirectResponse
     */
    public function delete(Property $property,Request $request ){
        dump('suppression');
        if($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token') )){
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success','supprimé avec succès');
        }
        //$this->em->remove($property);
        //$this->em->flush();

        return $this->redirectToRoute('admin.property.index');
    }


}