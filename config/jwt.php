<?php

return [
    'issuer' => env('JWT_ISSUER', 'genossys_app'),
    'secret' => env('JWT_SECRET', ''),
    'exp' => env('JWT_EXPIRATION', 3600),
];
