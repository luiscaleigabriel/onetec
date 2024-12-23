<?php

namespace app\controllers;

use app\core\Request;
use TCPDF;

class ReciboController 
{

    public function index() 
    {
        // Capturar os dados do request 
        $produtos = $request->input('produtos'); 
        // Criar uma nova instância do TCPDF 
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 
        // Configurações do Documento 
        $pdf->SetCreator(PDF_CREATOR); 
        $pdf->SetAuthor('OneTec'); 
        $pdf->SetTitle('Recibo de Compra'); 
        $pdf->SetSubject('Recibo'); 
        $pdf->SetKeywords('TCPDF, PDF, recibo, compra, OneTec'); 
        // Configurações da Página 
        $pdf->setPrintHeader(false); 
        $pdf->setPrintFooter(false); 
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT); 
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
        // Adicionar uma página 
        $pdf->AddPage(); 
        // Conteúdo do PDF 
        $html = ' <h1>OneTec - Recibo de Compra</h1> 
        <table border="1" cellpadding="5"> <thead> <tr> <th>Produto</th> <th>Quantidade</th> <th>Preço Unit.</th> <th>Total</th> </tr> </thead> <tbody>'; $total = 0; 
        
        foreach ($produtos as $produto) { 
            $subtotal = $produto['quantity'] * $produto['price']; 
            $total += $subtotal; $html .= ' <tr> <td>' . $produto['name'] . '</td> <td>' . $produto['quantity'] . '</td> <td>' . $produto['price'] . ' Kz</td> <td>' . number_format($subtotal, 2) . ' Kz</td> </tr>'; 
        } 
        $entrega = ($total >= 80000) ? 'Grátis' : 2000; 
        $totalFinal = ($total >= 80000) ? $total : $total + 2000; 
        $html .= ' </tbody> </table> <br> <div class="total"> <p>Subtotal: ' . number_format($total, 2) . ' Kz</p> <p>Entrega: ' . $entrega . '</p> <p>Total: ' . number_format($totalFinal, 2) . ' Kz</p> </div> <p>Obrigado por comprar na OneTec!</p>'; 
        
        // Adicionar o conteúdo HTML ao PDF 
        $pdf->writeHTML($html, true, false, true, false, ''); // Fechar e gerar o PDF 
        $pdf->Output('recibo.pdf', 'D'); // 'D' para download direto 
    }

    public function gerar() 
    {
        /**
      const produtosSalvos = JSON.parse(localStorage.getItem('cart')); 

      function gerarRecibo(produtos) { 
        let total = 0; 
        let reciboHTML = ` 
        <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unit.</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
            `; 
            let subtotal = 0;
        produtos.forEach(produto => { 
          subtotal = produto.quantity * produto.price; 
          total += subtotal; 
          reciboHTML += ` 
            <tr> 
              <td>${produto.name}</td> 
              <td>${produto.quantity}</td> 
              <td>${produto.price} Kz</td> 
              <td>${subtotal.toFixed(2)} Kz</td> 
            </tr> 
            `; 
          }); 

          let entrega = 0;
          if(total >= 80000) {
            entrega = 'Grátis';
          }else {
            entrega = 2000;
            total += entrega;
          }
        reciboHTML += ` 
        </tbody>
        </table>
          <div class="total">
                <p>Subtotal: ${subtotal.toFixed(2)} Kz</p>
                <p>Entrega: ${entrega}</p>
                <p>Total: ${total.toFixed(2)} Kz</p>
            </div>`; 
        return reciboHTML; 
      } 
        // Gerar HTML do recibo 
        const recibo = gerarRecibo(produtosSalvos); 
        // Exibir recibo 
         document.getElementById('recibo').innerHTML = recibo; 
         // Função para gerar PDF usando Blob 
         function gerarPDF() { 
          const reciboElement = document.getElementById('recibo').innerHTML; 
          const pdfContent = ` 
          <html><head><base href="." /><meta charset="UTF-8" /><base href="." /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>OneTec - Recibo de Compra</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f0f2f5;
    }

    .receipt-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #eee;
        padding-bottom: 20px;
    }

    .logo {
        margin-bottom: 15px;
    }

    .title {
        color: #333;
        font-size: 24px;
        margin: 10px 0;
    }

    .order-info {
        margin: 20px 0;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }

    .products {
        margin: 20px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f8f9fa;
        color: #333;
    }

    .total {
        margin-top: 20px;
        text-align: right;
        font-size: 18px;
        font-weight: bold;
    }

    .footer {
        margin-top: 30px;
        text-align: center;
        color: #666;
        font-size: 14px;
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    .receipt-container {
        animation: fadeIn 0.5s ease-in;
    }

    .success-icon {
        color: #28a745;
        font-size: 48px;
        margin-bottom: 20px;
    }
</style>
</head>
<body>
<div class="receipt-container">
        <div class="header">
            <div class="logo">
                <svg width="150" height="50" viewBox="0 0 150 50">
                    <text x="10" y="35" fill="#333" font-size="24" font-weight="bold">OneTec</text>
                    <circle cx="130" cy="25" r="15" fill="#28a745"/>
                </svg>
            </div>
            <div class="success-icon">✓</div>
            <h1 class="title">Compra Realizada com Sucesso!</h1>
            <p>Obrigado por comprar na OneTec</p>
        </div>

        <div class="order-info">
            <p><strong>Número do Pedido:</strong> <?= $new->codigo ?></p>
            <p><strong>Data da Compra:</strong> <?= date('d-m-Y, h:m:s') ?></span></p>
            <p><strong>Cliente:</strong> <?= $_SESSION['auth']->name ?></p>
            <p><strong>Email:</strong> <?= $_SESSION['auth']->email ?></p>
        </div>

        <div class="products">
            ${reciboElement}
        </div>

        <div class="footer">
            <p>Para qualquer dúvida, entre em contato conosco:</p>
            <p>Email: suporte@onetec.com | Tel: (+244) 999-999-999</p>
            <p>© 2024 OneTec - Todos os direitos reservados</p>
        </div>
    </div>
            </body> 
          </html> `; 
          const blob = new Blob([pdfContent], { type: 'application/pdf' }); 
          const url = URL.createObjectURL(blob); 
          const a = document.createElement('a'); 
          a.href = url; a.download = 'recibo.pdf'; 
          a.click(); 
          URL.revokeObjectURL(url); }
    </script>
         */
    }
}