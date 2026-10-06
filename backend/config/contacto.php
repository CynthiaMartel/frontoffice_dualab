<?php

return [
    // Buzón que recibe el aviso interno de cada solicitud del formulario.
    'avisos_a' => env('CONTACTO_AVISOS_A'),

    // Máximo de solicitudes por email en una hora: evita usar el formulario
    // para enviar confirmaciones masivas a direcciones ajenas desde dualab.es.
    'max_por_email_hora' => (int) env('CONTACTO_MAX_POR_EMAIL_HORA', 3),
];
