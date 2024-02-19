<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CochesController extends AbstractController
{
    #[Route('/coches', name: 'app_coches')]
    public function index(): Response
    {
        return $this->render('coches/index.html.twig', [
            'controller_name' => 'CochesController',
        ]);
    }
}
