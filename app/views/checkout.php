<?php $this->layout('master') ?>


<?php $this->start('main'); ?>

<div class="page container">
    <p>
      <span>Conta / Carrinho / </span>CheckOut 
    </p>
</div>

<main class="checkout container">
    <form class="checkout-form" action="/pay" method="post">
      <div class="form-left">
        <h2>Informe seus dados</h2>
        <div class="form-group">
          <label for="nome">Nome <span>*</span></label>
          <input value="<?= $user->nome ?>" type="text" name="nome" id="nome" />
        </div>
        <div class="form-group">
          <label for="endereco">Endereço <span>*</span></label>
          <input value="<?= $user->endereco ?>" type="text" name="endereco" id="endereco" />
        </div>
        <div class="form-group">
          <label for="cidade">Província <span>*</span> (Onde você se encontra)</label>
          <select name="cidade" id="cidade">
            <option value="Luanda">Luanda</option>
            <option value="Benguela">Benguela</option>
            <option value="Kwanza Sul">Kwanza Sul</option>
          </select>
        </div>
        <div class="form-group">
          <label for="telefone">Nº de Telefone <span>*</span></label>
          <input value="<?= $user->telefone ?>" type="number" name="telefone" id="telefone" />
        </div>
        <div class="form-group">
          <label for="email">Email <span>*</span></label>
          <input value="<?= $user->email ?>" type="email" name="email" id="email" />
        </div>
      </div>
      <div class="form-rigth">
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
          <div class="pay">
            <button type="submit" class="btn-primary">Finalizar Compra</button>
          </div>
        </div>
      </div>
    </form>
</main>

<?php $this->stop(); ?>

<?php $this->start('js'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
      showInCheckout();
    });
</script>
<?php $this->stop(); ?>