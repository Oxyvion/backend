<?php

return [
    // La API admite llamadas desde el portal Vite en estos dos nombres locales.
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    // La API responde los métodos CRUD y las cabeceras de autorización Bearer.
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://127.0.0.1:5173', 'http://localhost:5173'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
