<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Backend de Prueba Tecnica para Desarrollador FullStack

## Instalación

### Requisitos previos

Asegúrate de tener instalados los siguientes programas en tu máquina:

- **PHP** >= 8.1
- **Composer** = 2.7.7

### Instalación de dependencias

1. Clona este repositorio en tu máquina local:

   En cmd, ejecuta los siguientes comandos:

   git clone https://github.com/CamiloMoreno09/backendpruebatecnica.git

   cd backendpruebatecnica

2. Instala las dependencias
   
   composer install

4. Genera la clave de la aplicación
   
   php artisan key:generate

6. Ejecuta las migraciones de la base de datos
   
   php artisan migrate

7. Compila las rutas y configuraciones de la aplicación

   php artisan optimize

9. Corre el proyecto
   
   php artisan serve

  ¡ IMPORTANTE !

   El backup de la base de datos esta ubicado en la carpeta database
