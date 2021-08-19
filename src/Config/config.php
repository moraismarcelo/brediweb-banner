<?php

return [
    'name' => 'BrediBanner',

    /*
    * Carrega automaticamente no menu principal.
    */
    'autoload_menu' => true,

    'config' => [
        'imagem' => [
            'input_file' => 'imagem',
            'destino' => 'banner/',
            'resolucao' => ['p' => ['h' => 48, 'w' => 200], 'g' => ['h' => 460, 'w' => 1917]]
        ],
        'imagem_2' => [
            'input_file' => 'imagem_2',
            'destino' => 'banner/',
            'resolucao' => ['p' => ['h' => 200, 'w' => 200], 'g' => ['h' => 900, 'w' => 900]]
        ]
    ],
    'request_valitation' => [
        'titulo' => 'required|min:2',
        // 'subtitulo' => 'required'
    ]
];
