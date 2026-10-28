<?php

return [

    'paths' => [
        resource_path('views'),
    ],

    /*
    | Do not use realpath() here — on a fresh server the folder may not exist yet
    | and realpath() would return false, breaking view:clear / optimize:clear.
    */
    'compiled' => env('VIEW_COMPILED_PATH', storage_path('framework/views')),

];
