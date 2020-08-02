<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;




class PropertyController extends AbstractController
{


    /**
     * @var PropertyRepository
     */
     private $repository;
     private $manager;
//,ObjectManager $manager
    public function __construct(PropertyRepository $repository)
    {
      $this->repository = $repository;
      //$this->manager = $manager;
        
    }

    /**
     * @Route("/bien", name="produit.index")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$search);
        $form->handleRequest($request);
        $property = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties',
            'properties' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/bien/{slug}.{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $property
     * @param string $slug
     * @param $id
     * @return Response
     */
    public function show(Property $property, string $slug, $id):response{
       /* if ($property->getSlug()  !== $slug){
            return  $this->redirectToRoute('property.show',[
                'id' =>$property->getId(),
                'slug' =>$property->getSlug(),
            ],301);
        }*/

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
            ]);
    }
}
