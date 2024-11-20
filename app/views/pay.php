<?php $this->layout('master') ?>

<?php $this->start('css'); ?>

<?php $this->stop(); ?>

<?php $this->start('main'); ?>

<div class="page container">
    <p>
      <span>Conta / Carrinho / </span>Finalizar Compra 
    </p>
</div>

<main class="checkout container">
    <form class="checkout-form" action="/paypay" method="post">
      <div class="form-left">
        <div id="list-checkout" class="form-r--top"> 
        </div>
        <div class="form-r-botton">
          <div>
            <span>SubTotal</span>
            <span id="subtotal">1000kz</span>
          </div>
          <div>
            <span>Entrega</span>
            <span id="entrega"></span>
          </div>
          <div>
            <span>Total</span>
            <span id="total"></span>
          </div>
        </div>
      </div>
      <div class="form-rigth box">
        <h2>Pagamento</h2> 
        <input type="hidden" name="total" id="totalTotal"  />
        <div class="form-group"> 
            <label for="card-number">Número do Cartão:</label> 
            <input type="number" id="card-number" name="card-number" required> 
        </div> 
        <div class="form-group"> 
            <label for="card-expiry-month">Mês de Expiração:</label> 
            <input type="text" id="card-expiry-month" name="card-expiry-month" required> 
        </div> 
        <div class="form-group"> 
            <label for="card-expiry-year">Ano de Expiração:</label> 
            <input type="text" id="card-expiry-year" name="card-expiry-year" required> 
        </div> 
        <div class="form-group"> 
            <label for="card-cvc">CVC:</label> 
            <input type="text" id="card-cvc" name="card-cvc" required> 
        </div> 
        <div class="pay">
        <button type="submit" class="btn-primary">Pagar</button>
        </div> 
    </form>
</main>

<?php $this->stop(); ?>


<?php $this->start('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script> 
<script>
    document.addEventListener('DOMContentLoaded', () => {
      showInCheckoutPay();
    });

    document.getElementById('card-number').addEventListener('input', function (e) { let value = e.target.value.replace(/\D/g, ''); if (value.length > 12) { value = value.slice(0, 12); } e.target.value = value; }); 

   // Função para aplicar máscara no mês de expiração 
   document.getElementById('card-expiry-month').addEventListener('input', function (e) { let value = e.target.value.replace(/\D/g, ''); if (value.length > 2) { value = value.slice(0, 2); } e.target.value = value; }); 
   
   // Função para aplicar máscara no ano de expiração 
   document.getElementById('card-expiry-year').addEventListener('input', function (e) { let value = e.target.value.replace(/\D/g, ''); if (value.length > 4) { value = value.slice(0, 2); } e.target.value = value; });

   // Função para aplicar máscara no CVC 
   document.getElementById('card-cvc').addEventListener('input', function (e) { let value = e.target.value.replace(/\D/g, ''); if (value.length > 3) { value = value.slice(0, 4); } e.target.value = value; });
</script>
<?php $this->stop(); ?>