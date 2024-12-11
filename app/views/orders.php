<?php $this->layout('master') ?>

<?php $this->start('main'); ?>

<div class="page container">
    <p>
      <span>Home / Minha Conta / </span>Compras
    </p>
    <?php if (!isset($_SESSION['success'])): ?> 
      <br /> <br />
      <button onclick="gerarPDF()" class="btn-primary">Baixar Recibo em PDF</button>
      <div id="recibo"></div>
    <?php endif; ?>
</div>

<?php
    if (isset($_SESSION['error'])) {
      echo flash('error', 'error');
    }
    if (isset($_SESSION['success'])) {
      echo flash('success', 'success');
    }
?>

<section class="acount container">
    <?php $this->insert('partials/userpaine') ?>
    <div class="acout-form">
      <table>
        <thead>
          <tr>
            <th>Código</th>
            <th>Data</th>
            <th>Estado</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($orders) > 0): ?>

            <?php foreach($orders as $order): ?>
                <tr>
                    <td><?= $order->codigo ?></td>
                    <td><?= $order->data_da_compra ?></td>
                    <td><span class="status">Comprado</span></td>
                    <td><?= $order->total ?> Kz</td>
                </tr>
            <?php endforeach; ?>

          <?php else: ?>
            <h3>Nenhuma compra Realizada</h3>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
</section>

<?php $this->stop(); ?>

<?php if(!isset($_SESSION['success'])): ?>
  <?php $this->start('js'); ?>
    <script>
      // Recuperar produtos do localStorage 
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

        produtos.forEach(produto => { 
          const subtotal = produto.quantity * produto.price; 
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
                <p>Subtotal: ${subtotal.toFixed(2)}</p>
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
            <p><strong>Número do Pedido:</strong> <?= $_SESSION['auth']->name ?></p>
            <p><strong>Data da Compra:</strong> <?= date('d-m-Y h:m:s') ?></span></p>
            <p><strong>Cliente:</strong> <?= $_SESSION['auth']->name ?></p>
            <p><strong>Email:</strong> <?= $_SESSION['auth']->email ?></p>
        </div>

        <div class="products">
            


        </div>

        <div class="footer">
            <p>Para qualquer dúvida, entre em contato conosco:</p>
            <p>Email: suporte@onetec.com | Tel: (+244) 999-999-999</p>
            <p>© 2024 OneTec - Todos os direitos reservados</p>
        </div>
    </div>

    <script>
        // Adiciona a data atual ao recibo
        document.addEventListener('DOMContentLoaded', function() {
            const date = new Date();
            const formattedDate = date.toLocaleDateString('pt-BR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('currentDate').textContent = formattedDate;
        });
    </script>
            </body> 
          </html> `; 
          const blob = new Blob([pdfContent], { type: 'application/pdf' }); 
          const url = URL.createObjectURL(blob); 
          const a = document.createElement('a'); 
          a.href = url; a.download = 'recibo.pdf'; 
          a.click(); 
          URL.revokeObjectURL(url); }
    </script>
  <?php $this->stop(); ?>


<?php endif; ?>