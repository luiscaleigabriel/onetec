const toggle = document.getElementById('toggle');

toggle.addEventListener('click', () => {
  const dashnav = document.getElementById('dashboard-l');
  const dashrigt = document.getElementById('dashboard-r');

  if (dashnav.classList.contains('close')) {
    dashnav.classList.remove('close');
    dashrigt.classList.remove('open');
  }else {
    dashnav.classList.add('close');
    dashrigt.classList.add('open');
  }
});

const nome = document.getElementById('nome');
const slug = document.getElementById('slug');

nome.addEventListener('input', () => {
  slug.value = nome.value;
});

/*=============== SHOW MENU DROP ===============*/

function showMenu() {
  const nav = document.getElementById('nav-drop')

  if(!nav.classList.contains('show-menu')) {
    nav.classList.add('show-menu');
  }else {
    nav.classList.remove('show-menu');
  }
}

/*=============== drop image product ===============*/
const label = document.getElementById('label');
const image = document.getElementById('image');
const dropZone = document.getElementById('drop-zone');

function onEnter() {
  label.classList.add('active');
}

function onLeave() {
  label.classList.remove('active');
}

label.addEventListener("dragenter", onEnter);
label.addEventListener("drop", onLeave);
label.addEventListener("dragend", onLeave);
label.addEventListener("dragleave", onLeave);

image.addEventListener('change', e => {
  if(image.files.length > 0) {
    const type = image.files[0].type;
    const format = ['image/jpeg', 'image/jpg', 'image/png'];

    if(!format.includes(type)) {
      alert('Esse formato de arquivo não é permitido');
      return;
    }

    if(document.getElementById('cover')) {
      dropZone.removeChild(document.getElementById('cover'));
    }

    const img = document.createElement('img');
    img.id = "cover";
    img.src = URL.createObjectURL(image.files[0]);

    dropZone.appendChild(img);
  }
});