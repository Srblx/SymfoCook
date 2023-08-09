<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    // ^ IngredientRepository est une injection de dependance injecter le service dans les paramettre du controller
    public function index(IngredientRepository $repository): Response
    {
        // & Function findAll pour avoir les ingredients 
        //todo $ingredients = $repository->findAll();
        
        
        return $this->render('ingredient/index.html.twig', [
            //& Voir commantaire todo c'est une autre posibilité plutot que d'appeller directement la variable 
            'ingredients' => $repository->findAll()
        ]);
    }
}
