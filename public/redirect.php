<?php

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if (!isset($_SESSION['redirect'])) {
    $_SESSION['redirect'] = [
        'atual' => $uri,
        'previous' => ''
    ];
}else {
    if ($_SESSION['redirect']['atual'] !== $uri) {
        $_SESSION['redirect'] = [
            'atual' => $uri,
            'previous' => $_SESSION['redirect']['atual']
        ];
    } 
}