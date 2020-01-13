<?php

return [
    'secret_key' => env('RECAPTCHA_MIDDLEWARE_SECRET_KEY', ''),
    'response_type' => env('RECAPTCHA_MIDDLEWARE_RESPONSE_TYPE', 'json'),
];