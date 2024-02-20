<?php

namespace App\Controller;

use App\Entity\Modelos;
use App\Entity\Tipos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// AÑADIMOS "_" AL FINAL DE "APP_MODELOS"
#[Route('/modelos', name: 'app_modelos_')]
class ModelosController extends AbstractController
{
    // INSERTAR MODELOS (INSERT)
    #[Route('/insertar', name: 'insertar')]
    public function insertar(EntityManagerInterface $gestorEntidades): Response
    {
        // ENDPOINT: http://127.0.0.1:8000/modelos/insertar

        // METEMOS DATOS MEDIANTE ARRAYS:
        $modelos = array (
            "m1" => array(
                "nombre_modelo" => "Kona EV 2024 115kW Flexx",
                "id_tipo" => 1
            ),
            "m2" => array(
                "nombre_modelo" => "Tucson 1.6 TGDI HEV",
                "id_tipo" => 2
            ),
        );

        foreach ($modelos as $nuevoModelo) {
            $modelo = new Modelos();

            // SETEAMOS:
            $modelo->setNombreModelo($nuevoModelo["nombre_modelo"]);
            $repoTipos = $gestorEntidades->getRepository(Tipos::class);
            // SE ESCRIBE LA SIGUIENTE LÍNEA PORQUE NO SE HA CAMBIADO EL ID ANTERIORMENTE, SE HA ESTABLECIDO EL ID AUTOMÁTICO:
            $tipo = $repoTipos->find($nuevoModelo["id_tipo"]);
            $modelo->setIdTipo($tipo);
            $gestorEntidades->persist($modelo);
            $gestorEntidades->flush();
        }

        return new Response("<h1>Modelos insertados</h1>");
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////

    // CONSULTAR MODELOS (VER MODELOS, SELECT) MEDIANTE RESPONSE
    #[Route('/consultar', name: 'consultar')]
    public function consultar(EntityManagerInterface $gestorEntidades): Response
    {
        // ENDPOINT: http://127.0.0.1:8000/modelos/consultar

        // SACAMOS REPOSITORIO:
        // CON LO SIGUIENTE NOS SACA TODOS LOS DATOS (findAll)
        //$modelos = $gestorEntidades->getRepository(Modelos::class)->findAll();

        // HACEMOS UN JOIN!:
        $repoModelos = $gestorEntidades->getRepository(Modelos::class);
        $modelos = $repoModelos->joinModelos();
        

        // ASÍ COMPROBAMOS QUE VAMOS BIEN:
        // return new Response("" . var_dump($modelos));


        return $this->render('modelos/index.html.twig', [
            'controller_name' => 'ModelosController',
            'modelos' => $modelos,
        ]);   
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////

    // CONSULTAR MEDIANTE JSON
    #[Route('/consultarJSON', name: 'consultar_json')]
    public function consultarJSON(EntityManagerInterface $gestorEntidades): JsonResponse
    {
        // ENDPOINT: http://127.0.0.1:8000/modelos/consultarJSON

        // HACEMOS UN JOIN!:
        $repoModelos = $gestorEntidades->getRepository(Modelos::class);
        $modelos = $repoModelos->joinModelos();
        
        // HACEMOS JSON MEDIANTE ARRAYS:
        $json = [];
        foreach ($modelos as $modelo) {
            $json[] = [
                "id" => $modelo["id"],
                "tipo" => $modelo["nombre_tipo"],
                "modelo" => $modelo["nombre_modelo"],
            ];
        }

        return new JsonResponse($json);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////

    // ACTUALIZACIÓN CON REDIRECCIÓN
    #[Route('/actualizar/{tipo}/{modelo}/{id}', name: 'actualizar')]
    public function actualizar(EntityManagerInterface $gestorEntidades, int $tipo, String $modelo, int $id): Response
    {
        // ENDPOINT: http://127.0.0.1:8000/modelos/actualizar/1/Tucson 1.6 TGDI HEV/2

        $repoModelo = $gestorEntidades->getRepository(Modelos::class);
        $modeloCambiado = $repoModelo->find($id);

        // SETEAR NOMBRE MODELO
        $modeloCambiado->setNombreModelo($modelo);

        $repoTipo = $gestorEntidades->getRepository(Tipos::class);
        $tipoModificado = $repoTipo->find($tipo);

        // SETEAR TIPO MODELO
        $modeloCambiado->setIdTipo($tipoModificado);

        $gestorEntidades->flush();

        return $this->redirectToRoute("app_modelos_consultar");
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////

    // BORRADO DE MODELO CON SALIDA JSON
    #[Route('/eliminar/{id}', name: 'eliminar')]
    public function eliminar(EntityManagerInterface $gestorEntidades, int $id): Response
    {
        // ENDPOINT: http://127.0.0.1:8000/modelos/eliminar/2

        // SACAMOS REPOSITORIO:
        $repoModelo = $gestorEntidades->getRepository(Modelos::class);

        // SACAMOS MODELO A BORRAR:
        $modeloBorrado = $repoModelo->find($id);
        $gestorEntidades->remove($modeloBorrado);

        $gestorEntidades->flush();

        return $this->redirectToRoute("app_modelos_consultar_json");
    }
}