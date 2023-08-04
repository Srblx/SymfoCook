<?php 
namespace App\Controller;

// Utilisez le bon chemin d'accès pour la classe AbstractController
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/', 'HomeController', methods: ('GET'))]
     
    public function index(): Response
    {
        // Utilisez la fonction "render" depuis AbstractController pour renvoyer une vue
        return $this->render('home/index.html.twig');
    }
}