<h1>Proyecto Final - Blog</h1>

<h3>Base de Datos:</h3>
<ul>
    <li>
    User
    <ul>
        <li>name</li>
        <li>email</li>
        <li>password</li>
        <li>created_at</li>
        <li>updated_at</li>
    </ul>
    </li>
    <li>
    Post
    <ul>
        <li>title</li>
        <li>content</li>
        <li>user_id</li>
        <li>created_at</li>
        <li>updated_at</li>
    </ul>
    </li>
    <li>
    Comment
    <ul>
        <li>text</li>
        <li>user_id</li>
        <li>post_id</li>
        <li>created_at</li>
        <li>updated_at</li>
    </ul>
    </li>
</ul>

<h3>Tecnologias utilizadas:</h3>

<ul>
    <li>Framework PHP: Laravel 7.*</li>
    <li>Framework CSS: Bootstrap 4</li>
    <li>Framework JavaScript: jQuery</li>
</ul>

<h3>Instalación de proyecto basado en Laravel:</h3>

<ul>
    <li>Ejecutar <strong>composer install</strong> para instalar los paquetes de PHP</li>
    <li>Ejecutar <strong>php artisan migrate</strong> para crear la estructura de la base de datos.</li>
</ul>

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.