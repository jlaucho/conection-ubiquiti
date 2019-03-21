<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Name interface modify
    |--------------------------------------------------------------------------
    |
    | This value is the name this column with column.
    |
    */

    'interface' => env('INTERFACE_MODIFY', 'eth0'),

    /*
    |--------------------------------------------------------------------------
    | Default value
    |--------------------------------------------------------------------------
    |
    | This value is default role in database
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Location of Models in yous system
    |--------------------------------------------------------------------------
    |
    | This value is the location.
    |
    */

    'direction_model' => env('UBIQUITI_MODEL', 'app'),

     /*
    |--------------------------------------------------------------------------
    | Set password for radio
    |--------------------------------------------------------------------------
    |
    | This value is password used for recover information.
    |
    */

    'password_available' => [
        'secret1',
        'secret2',
    ],

];
