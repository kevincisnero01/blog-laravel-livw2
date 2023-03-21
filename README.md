# Blog de Practica con Livewire

## Introducción
Es un  pequeño proyecto  que tiene como fin implementar la tecnologia de Livewire en un CRUD basica para manejar  Posts en  Laravel. 

### ¿Que es Livewire?
Livewire es un marco completo para Laravel que simplifica la creación de interfaces dinámicas, sin dejar la comodidad de Laravel.

## Tecnologias utilizadas
El stack de tecnologias utilizadas son :
- Laravel
- Blade
- Livewire
- Eloquent
- Sweet Alert

# Instalacion
1. En consola ingresar y  esperar a que se descargue el repositorio.
`git clone git@github.com:kevincisnero01/blog-laravel-livw2.git`
2. Descargar composer
`composer install`
3. Descargar npm
`npm install`
4. Compolar asset
`npm un dev`
5. Crear archivo .env utilizando el .env.example
6. Crear variable de entorno  APP_KEY
`php artisan key:generate`
6. Crear base de datos en el gestor de base de datos de tu preferencia
`blog_laravel_db`
7. Ejecutar migraciones
`php artisan migrate`
8. Abrir aplicacion en el navegador : http://blog-laravel-livw2.test/
9. Registrar usuario   e iniciar session. 
10. Probar aplicacion y su funcionamiento para listar, crear, editar y elimina posts.