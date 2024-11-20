document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('totalInCart').textContent = getCart().length;
  document.getElementById('totaLike').textContent = getLike().length;
});

const btnsAdd = document.querySelectorAll('.addToCart');

btnsAdd.forEach(btnAdd => {
  btnAdd.addEventListener('click', () => {
    const name = btnAdd.getAttribute('data-name');
    const image = btnAdd.getAttribute('data-image');
    const price = btnAdd.getAttribute('data-price');
    const id = btnAdd.getAttribute('data-id');
    const quantity = 1;

    const product = {
      id: id,
      image: image,
      name: name,
      price: price,
      quantity: quantity
    };

    addToCart(product);
    
  });
});

function addMyProduct(id, name, image, price){
    const quantity = 1;

    const product = {
      id: id,
      image: image,
      name: name,
      price: price,
      quantity: quantity
    };

    addToCart(product);
}

function addToCart(product) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  let producExist = cart.find(item => item.id == product.id);

  if (producExist) {
    producExist.quantity += product.quantity;
  }else {
    cart.push(product);
  }

  localStorage.setItem('cart', JSON.stringify(cart));
  document.getElementById('totalInCart').textContent = getCart().length;
}

function getCart() {
  let cart = JSON.parse(localStorage.getItem('cart')) ||[];
  return cart;
}

function showProducts() {
  const products = getCart();
  const showAll = document.getElementById('product-list--main');
  let total= 0;

  showAll.innerHTML = '';

  if (products.length <= 0) {
    showAll.innerHTML = '<h2 style="margin-block: 20px;">Nenhum produto adicionado</h2>';
  }

  products.forEach(product => {
    let productTr = document.createElement('tr');
    
    productTr.innerHTML = `
    <td>
      <div class="item-product">
        <div>
          <img src="${product.image}" alt="Product" />
        </div>
        <h2>${product.name}</h2>
      </div>
    </td>
    <td>
      ${Math.floor(product.price).toLocaleString()} kz
    </td>
      <td>
        <button class="btn-change" onclick="subtraiProduct(${product.id})">-</button>

        <input type="number" name="qtd" id="qtd" value="${product.quantity}" disabled />

        <button id="btn-change" onclick="addProdct(${product.id})">+</button>
      </td>
      <td>
        ${(product.quantity * product.price).toLocaleString()} Kz
      </td>
      <td>
        <button class="btn-primary" onclick="removeProduct(${product.id})">Remover</button>
      </td>
    `;

    total += (product.price * product.quantity);
    
    showAll.appendChild(productTr);
  });

  document.getElementById('total').textContent = `Total: ${total.toLocaleString()} Kz`;

}

function showInCheckout() {
  const products = getCart();
  const showAll = document.getElementById('list-checkout');
  let total= 0;
  let entrega= 2000;

  showAll.innerHTML = '';

  if (products.length <= 0) {
    showAll.innerHTML = '<h2 style="margin-block: 20px;">Nenhum produto adicionado</h2>';
  }

  products.forEach(product => {
    let productTr = document.createElement('div');
    productTr.classList.add('checkout-product');

    productTr.innerHTML = `
      <div class="checkout-details-p">
          <div class="checkout-product--image">
            <img src="${product.image}" alt="product" />
          </div>
          <h2>${product.name}</h2> <span>x ${product.quantity}</span>
        </div>
        <h3 class="checkout-p--price">${(product.price * product.quantity).toLocaleString()} kz</h3>
      </div>
    `;

    let valor = (product.price * product.quantity);
    total += (product.price * product.quantity);
    
    showAll.appendChild(productTr);
  });

  document.getElementById('subtotal').textContent = `${total.toLocaleString()} Kz`;
  
  if(total > 80000) {
    document.getElementById('entrega').textContent = `Grátis`;
    document.getElementById('total').textContent = `${total.toLocaleString()} Kz`;
  }else {
    document.getElementById('entrega').textContent = `${entrega}Kz`;
    document.getElementById('total').textContent = `${total + entrega}Kz`;
  }

}

function showInCheckoutPay() {
  const products = getCart();
  const showAll = document.getElementById('list-checkout');
  let total= 0;
  let entrega= 2000;

  showAll.innerHTML = '';

  if (products.length <= 0) {
    showAll.innerHTML = '<h2 style="margin-block: 20px;">Nenhum produto adicionado</h2>';
  }
  let producs = document.createElement('input');

  products.forEach(product => {
    let productTr = document.createElement('div');
    productTr.classList.add('checkout-product');

    productTr.innerHTML = `
      <div class="checkout-details-p">
          <div class="checkout-product--image">
            <img src="${product.image}" alt="product" />
          </div>
          <h2>${product.name}</h2> <span>x ${product.quantity}</span>
        </div>
        <h3 class="checkout-p--price">${(product.price * product.quantity).toLocaleString()} kz</h3>
      </div>
    `;

    producs.value += `-${product.id}+${product.quantity}`;

    let valor = (product.price * product.quantity);
    total += (product.price * product.quantity);
    
    showAll.appendChild(productTr);
  });

  producs.name = 'data';
  producs.id = 'data';
  producs.type = 'hidden';
  showAll.appendChild(producs);
  document.getElementById('subtotal').textContent = `${total.toLocaleString()} Kz`;
  
  if(total > 80000) {
    document.getElementById('entrega').textContent = `Grátis`;
    document.getElementById('total').textContent = `${total.toLocaleString()} Kz`;
  }else {
    document.getElementById('entrega').textContent = `${entrega}Kz`;
    document.getElementById('total').textContent = `${total + entrega}Kz`;
  }

  document.getElementById('totalTotal').value = total;

}

function removeProduct(productId) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  const productIndex = cart.findIndex(item => item.id == productId);

  if (productIndex != -1) {
    cart.splice(productIndex, 1);
  }

  localStorage.setItem('cart', JSON.stringify(cart));
  showProducts();
  document.getElementById('totalInCart').textContent = getCart().length;
}

function addProdct(productId) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  const productIndex = cart.findIndex(item => item.id == productId);

  if (productIndex != -1) {
    cart[productIndex].quantity += 1;
  }

  localStorage.setItem('cart', JSON.stringify(cart));
  showProducts();
  document.getElementById('totalInCart').textContent = getCart().length;
}

function subtraiProduct(productId) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  const productIndex = cart.findIndex(item => item.id == productId);

  if (productIndex != -1) {
    if (cart[productIndex].quantity > 1) {
      cart[productIndex].quantity -= 1
    }else {
      cart.splice(productIndex, 1);
    }
  }

  localStorage.setItem('cart', JSON.stringify(cart));
  showProducts();
  document.getElementById('totalInCart').textContent = getCart().length;
}

/**
 * Lista de favoritos
 */

const btnsLike = document.querySelectorAll('.btn-f');

btnsLike.forEach(btnAdd => {
  btnAdd.addEventListener('click', () => {
    const name = btnAdd.getAttribute('data-name');
    const image = btnAdd.getAttribute('data-image');
    const price = btnAdd.getAttribute('data-price');
    const id = btnAdd.getAttribute('data-id');
    const quantity = 1;

    const product = {
      id: id,
      image: image,
      name: name,
      price: price,
      quantity: quantity
    };

    addToLike(product);
    
  });
});

function addToLike(product) {
  let cart = JSON.parse(localStorage.getItem('like')) || [];

  let producExist = cart.find(item => item.id == product.id);

  if (producExist) {
    producExist.quantity += product.quantity;
  }else {
    cart.push(product);
  }

  localStorage.setItem('like', JSON.stringify(cart));
  document.getElementById('totaLike').textContent = getLike().length;
}

function getLike() {
  let like = JSON.parse(localStorage.getItem('like')) ||[];
  return like;
}

function showProductsLike() {
  const products = getLike();
  const showAll = document.getElementById('product-list--main');
  let total= 0;

  showAll.innerHTML = '';

  if (products.length <= 0) {
    showAll.innerHTML = '<h2 style="margin-block: 20px;">Nenhum produto adicionado aos favoritos</h2>';
  }

  products.forEach(product => {
    let productTr = document.createElement('tr');
    
    productTr.innerHTML = `
    <td>
      <div class="item-product">
        <div>
          <img src="${product.image}" alt="Product" />
        </div>
        <h2>${product.name}</h2>
      </div>
    </td>
    <td>
      ${Math.floor(product.price).toLocaleString()} kz
    </td>
      <td>
        <button onclick="addMyProduct(${product.id}, '${product.name}', '${product.image}', ${product.price})" class="btn-primary" ><i class="fa fa-cart-shopping"></i> Adicionar ao Carrinho</button>
        <button class="btn-change" onclick="removeLike(${product.id})">Remover</button>
      </td>
    `;
    
    showAll.appendChild(productTr);
  });

}

function removeLike(productId) {
  let cart = JSON.parse(localStorage.getItem('like')) || [];
  const productIndex = cart.findIndex(item => item.id == productId);

  if (productIndex != -1) {
    cart.splice(productIndex, 1);
  }

  localStorage.setItem('like', JSON.stringify(cart));
  showProductsLike();
  document.getElementById('totaLike').textContent = getLike().length;
}