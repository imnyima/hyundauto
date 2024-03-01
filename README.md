# Instalación proyecto Hyundauto

- Pasos para restaurar el proyecto:
    - php bin/console doctrine:database:create
    - php bin/console make:migration
    - php bin/console doctrine:migrations:migrate
    - http://localhost:8000/tipos/insertar/Eléctrico
    - http://localhost:8000/tipos/insertar/Híbrido
    - http://localhost:8000/modelos/insertar
    - http://localhost:8000/modelos/consultar
    - http://localhost:8000/modelos/consultarJSON
    - http://127.0.0.1:8000/modelos/actualizar/1/Tucson 1.6 TGDI HEV/2
    - http://127.0.0.1:8000/modelos/eliminar/2
    - http://127.0.0.1:8000/tipos/consultar
    - http://127.0.0.1:8000/tipos/insertar
    - http://localhost:8000/coches/consultar
    - http://localhost:8000/coches/insertar