<?php

namespace App\Controller;
use App\Entity\Ingredient;

use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IngredientController extends AbstractController
{
    /**
      * Undocumented function
      * this function display all ingredients
      *
      * @param IngredientRepository $repository
      * @param PaginatorInterface $paginator
      * @param Request $request
      * @return Response
    */

    #[Route('/ingredient', name: 'ingredient.index', methods: ['GET'])]
    // ^ IngredientRepository est une injection de dependance injecter le service dans les paramettre du controller
    public function index(IngredientRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        // & Function findAll pour avoir les ingredients 
        //todo $ingredients = $repository->findAll();
        
        //^ Parametrage du nombre délément et de pages
        $ingredients = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        
        return $this->render('ingredient/index.html.twig', [
            //& Voir commantaire todo c'est une autre posibilité plutot que d'appeller directement la variable 
            'ingredients' => $ingredients
        ]);
    }

    #[Route('ingredient/nouveau', name: 'ingredient.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager) : Response 
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        // ! debug
        // dd($form);
        // & Processus aprés la soumission du formulaire
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            $ingredient = $form->getData();
            
            $manager->persist($ingredient);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre ingrédient a été créé avec succès !'
            );

            // $this->redirectToRoute('ingredient.index');
        }

        return $this->render("/ingredient/new.html.twig", [
            'form' => $form->createView()
        ]);
    }
}
