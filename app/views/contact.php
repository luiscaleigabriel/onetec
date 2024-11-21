<?php $this->layout('master') ?>

<?php $this->start('main'); ?>

<div class="page container">
    <p>
      <span>Home / </span>Contacto 
    </p>
</div>

<main class="main-contact container">
    <div class="main-contact--content">
      <div class="contact-left">
        <div class="contact">
          <h2><i class="fa fa-phone"></i> <span>Contacte - nos</span></h2>
          <p>Estamos abertos 24/24, 7 dias por semana</p>
          <p>Tel: (+224) 999 999 999</p>
        </div>
        <hr />
        <div class="contact">
          <h2><i class="fa fa-envelope"></i> <span>Fale connosco</span></h2>
          <p>Entre em contacto connosco a qualquer hora</p>
          <p>Email: onetec@gmail.com</p>
        </div>
      </div>
      <div class="contact-rigt">
        <form action="" class="form">
          <div class="form-group group">
            <input type="text" name="nome" id="nome" placeholder="Nome" />
            <input type="email" name="email" id="email"placeholder="Email" />
            <input type="text" name="telefone" id="telefone" placeholder="Nº de Telefone" />
          </div>
          <div class="form-group">
            <textarea name="mensagem" id="mensagem" placeholder="Mensagem" ></textarea>
          </div>
          <div class="form-btn">
            <button type="submit" class="btn-primary">Enviar Menssagem</button>
          </div>
        </form>
      </div>
    </div>
</main>

<?php $this->stop(); ?>


<?php $this->start('js'); ?>
<script>
// Máscara para telefone
document.getElementById('telefone').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 12) value = value.slice(0, 12);
    
    if (value.length > 0) {
        value = '(+244) ' + value.slice(3);
    }
    if (value.length > 9) {
        value = value.slice(0,9) + value.slice(9);
    }
    
    e.target.value = value;
});
</script>
<?php $this->stop(); ?>