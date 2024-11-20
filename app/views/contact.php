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
            <input type="number" name="telefone" id="telefone" placeholder="Nº de Telefone" />
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

<?php $this->stop(); ?>