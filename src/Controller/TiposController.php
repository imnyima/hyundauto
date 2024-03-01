<?php

namespace App\Controller;

use App\Entity\Tipos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/*
* Pasos para restaurar el proyecto:
* 1) php bin/console doctrine:database:create
* 2) php bin/console make:migration
* 3) php bin/console doctrine:migrations:migrate
* 4) http://localhost:8000/tipos/insertar/Eléctrico
* 5) http://localhost:8000/tipos/insertar/Híbrido
* 6) http://localhost:8000/modelos/insertar
* 7) http://localhost:8000/modelos/consultar
* 8) http://localhost:8000/modelos/consultarJSON
*/

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

////////////////////////////////////////////////////////////////////////////////////////////////////////

    // CONSULTAR MEDIANTE JSON
    #[Route('/consultar', name: 'consultar')]
    public function consultar(EntityManagerInterface $gestorEntidades): JsonResponse
    {
        // ENDPOINT: http://127.0.0.1:8000/tipos/consultar

        $tipos = $gestorEntidades->getRepository(Tipos::class)->findAll();

            $json = array();
            foreach ($tipos as $tipo) {
                $json[] = array(
                    "id" => $tipo->getId(),
                    "nombre_tipo" => $tipo->getNombreTipo(),
                );
            }

            return new JsonResponse($json);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////

    /*
    * Para definir un formulario:
    * 1) Configurar config/packages/twig.yaml para añadir Bootstrap
    * 2) Crear el formulario en el Controlador
    * 3) Recoger los datos del formulario
    * 4) Modificar la Base de Datos
    * 5) Agregar el formulario como Widget al Twig asociado al controlador
    */
    // FORMULARIO
    #[Route('/insertar', name: 'insertarTipo')]
    public function insertarTipo(EntityManagerInterface $gestorEntidades, Request $solicitud): Response
    {
        // ENDPOINT: http://127.0.0.1:8000/tipos/insertar

        $tipo = new Tipos();

        // Creamos el formulario. CAMPO POR CAMPO
        $formulario = $this->createFormBuilder($tipo)
            ->add('nombre_tipo', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('guardar', SubmitType::class, ["label" => "Insertar tipo", 'attr' => ['class' => 'btn btn-primary']])
            ->getForm();

        // Recogemos los datos del formulario
        $formulario->handleRequest($solicitud);

        // Si el formulario se ha enviado y es válido:
        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $tipo = $formulario->getData();
            $gestorEntidades->persist($tipo);
            $gestorEntidades->flush();
            return $this->redirectToRoute("app_modelos_consultar");

        }

        return $this->render('tipos/index.html.twig', [
            'controller_name' => 'TiposController',
            'miForm' => $formulario->createView(),
        ]); 
    }
}
