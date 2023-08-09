<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
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
}
