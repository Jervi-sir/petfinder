<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Toastr options
    |--------------------------------------------------------------------------
    |
    | Here you can specify the options that will be passed to the toastr.js
    | library. For a full list of options, visit the documentation.
    |
    */

    'options' => [
        'closeButton'       => true,
        'closeClass'        => 'toast-close-button',
        'closeDuration'     => 300,
        'closeEasing'       => 'swing',
        'closeHtml'         => '<button><i class="icon-off"></i></button>',
        'closeMethod'       => 'fadeOut',
        'closeOnHover'      => true,
        'containerId'       => 'toast-container',
        'debug'             => false,
        'escapeHtml'        => false,
        'extendedTimeOut'   => 10000,
        'hideDuration'      => 1000,
        'hideEasing'        => 'linear',
        'hideMethod'        => 'fadeOut',
        'iconClass'         => 'toast-info',
        'iconClasses'       => [
            'error'   => 'toast-error',
            'info'    => 'toast-info',
            'success' => 'toast-success',
            'warning' => 'toast-warning',
        ],
        'messageClass'      => 'toast-message',
        'newestOnTop'       => false,
        'onHidden'          => null,
        'onShown'           => null,
        'positionClass'     => 'toast-top-right',
        'preventDuplicates' => true,
        'progressBar'       => true,
        'progressClass'     => 'toast-progress',
        'rtl'               => false,
        'showDuration'      => 300,
        'showEasing'        => 'swing',
        'showMethod'        => 'fadeIn',
        'tapToDismiss'      => true,
        'target'            => 'body',
        'timeOut'           => 5000,
        'titleClass'        => 'toast-title',
        'toastClass'        => 'toast',
    ],
];
