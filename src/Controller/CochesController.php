<?php

namespace App\Controller;

use App\Entity\Coches;
use App\Form\CochesType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/coches', name: 'app_coches_')]
class CochesController extends AbstractController
{

    // CONSULTAR COCHES
    #[Route('/consultar', name: 'consultar')]
    public function consultar(EntityManagerInterface $gestorEntidades): JsonResponse
    {

        // INSERT INTO coches VALUES ("0000MNR", 1, 35500, 1, 20, "2024-06-10");
        // ENDPOINT: http://localhost:8000/coches/consultar

        // COGEMOS REPOSITORIO:
        $repoCoches = $gestorEntidades->getRepository(Coches::class);
        // SACAR TODOS LOS COCHES:
        $coches = $repoCoches->findAll();

        // CREAMOS ARRAY Y FOREACH
        $json = [];

        foreach($coches as $coche){
            $fecha = new DateTime();
            $fechaFormateada = $coche->getFecha()->format("Y-m-d");

            $json[] = [
                "matricula" => $coche->getMatricula(),
                // SE AÑADE CARACTERÍSTICAS POR SI EL FRONTEND NOS LO PIDE ASÍ. PERO SE PUEDE QUITAR CARACTERÍSTICAS Y LISTO.
                "características" => [
                    "precio" => $coche->getPrecio(),
                    "estado" => $coche->isEstado(),
                    "kms" => $coche->getKms(),
                ],
                //"fecha" => $coche->getFecha(),
                "fecha" => $fechaFormateada,
                // SACAR MODELO:
                "modelo" => $coche->getIdModelo()->getNombreModelo(),
            ];
        }


        return new JsonResponse($json);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////

    // INSERTAR COCHES MEDIANTE FORMULARIO
    #[Route('/insertar', name: 'insertar')]
    public function insertar(EntityManagerInterface $gestorEntidades, Request $solicitud): Response
    {

        // ENDPOINT: http://localhost:8000/coches/insertar
        // Vamos a ejecutar por consola: php bin/console make:form

        $coche = new Coches();

        // IMPORTAMOS FORMULARIO:
        $formulario = $this->createForm(CochesType::class, $coche);

        $formulario->handleRequest($solicitud);

        if($formulario->isSubmitted() && $formulario->isValid()) {
            $gestorEntidades->persist($coche);
            $gestorEntidades->flush();

            return $this->redirectToRoute("app_coches_consultar");
        } else {
            return $this->render('coches/index.html.twig', [
                'controller_name' => 'CochesController',
                'miForm' => $formulario,
            ]);
        }
    }
}
