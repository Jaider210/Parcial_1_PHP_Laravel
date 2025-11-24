<?php

use Laravel\Jetstream\Http\Middleware\AuthenticateSession;

return [

    'stack' => 'inertia',

    'middleware' => ['web'],

    'auth_session' => AuthenticateSession::class,

    'guard' => 'sanctum',

    'features' => [
        'registration',
        'account-deletion',
        // Otros features opcionales:
        // 'terms-and-privacy-policy',
        // 'profile-photos',
        // 'api',
        // 'teams',
    ],

    'profile_photo_disk' => 'public',
];
