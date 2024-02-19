<?php

namespace App\Controller;

use App\Entity\Tipos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// AÑADIMOS "_" AL FINAL DE "APP_TIPOS"
#[Route('/tipos', name: 'app_tipos_')]
class TiposController extends AbstractController
{
    // INSERTAR TIPOS MEDIANTE PARÁMETROS
    #[Route('/insertar/{nombreTipo}', name: 'insertar')]
    public function index(EntityManagerInterface $gestorEntidades, String $nombreTipo): Response
    {

        // ENDPOINT: http://127.0.0.1:8000/tipos/insertar/Eléctrico
        // http://127.0.0.1:8000/tipos/insertar/Híbrido

        // CREAMOS OBJETO (lo que estamos metiendo por parámetro)
        $tipo = new Tipos();
        $tipo->setNombreTipo($nombreTipo);

        // GUARDA Y HACE UN COMMIT:
        $gestorEntidades->persist($tipo);
        $gestorEntidades->flush();



        return new Response("<h1>Tipo insertado con ID = " . $tipo->getId() . "</h1>");
    }
}
