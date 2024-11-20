<?php

use app\core\Router;
// use app\support\Email;

require '../vendor/autoload.php';

session_start();

require "redirect.php";

// var_dump($_SESSION);

// Utilização da classe com o template 
// @nome_cliente, @codigo_compra, @data_compra, @total_compra

// Montando a lista de produtos $listaProdutos = ''; foreach ($produtos as $produto) { $listaProdutos .= '<li>' . $produto['nome'] . ': ' . $produto['quantidade'] . ' x R$ ' . number_format($produto['preco'], 2, ',', '.') . '</li>'; } $template = str_replace('{{customer_name}}', 'Nome do Cliente', $template); $template = str_replace('{{order_number}}', '123456', $template); $template = str_replace('{{purchase_date}}', '08/11/2024', $template); $template = str_replace('{{total_amount}}', 'R$ 440,00', $template); $template = str_replace('{{product_list}}', $listaProdutos, $template); $template = str_replace('{{tracking_url}}', 'https://www.sualoja.com/tracking/123456', $template);

// $template = file_get_contents('../app/views/email/success.html'); 
// $template = str_replace('{{@customer_name}}', 'Nome do Cliente', $template); 
// $template = str_replace('{{shop_url}}', 'https://www.sualoja.com', $template);

// Utilização da classe 
// $emailSender = new Email('smtp.gmail.com', 'luiscaleigabriel@gmail.com', 'spvk pqmy xzyn cter'); 
// $result = $emailSender->sendEmail( 'luiscaleigabriel@gmail.com', 'Luis Gabriel', 'luiscagabriel20@gmail.com', 'Onetec', 'Comunicado', 'A loja OneTec vem por este meio dizer que está a funcionar' ); 
// echo $result;

Router::run();
