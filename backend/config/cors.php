<?php

return [
    'paths'                    => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods'          => ['*'],
    // EXTRA_ALLOWED_ORIGIN: dualab.es hace peticiones aquí desde su propia home
    // (botón "Contacto"/formulario), aunque el frontoffice viva en info.dualab.es.
    'allowed_origins'          => array_filter([
        env('FRONTEND_URL', 'http://localhost:5173'),
        env('EXTRA_ALLOWED_ORIGIN'),
    ]),
    'allowed_origins_patterns' => ['#^http://localhost(:\d+)?$#'],
    'allowed_headers'          => ['*'],
    'exposed_headers'          => [],
    'max_age'                  => 0,
    'supports_credentials'     => true,
];
