let checkAll = document.querySelector("#checkAll");
let categorias = [];
let flag = 0;
let offset = 0;

var loading = false; // Bandeira para evitar múltiplas solicitações de carregamento
var page = 1; // Página inicial
var productsPerPage = 6; // Número de produtos por página

categorias.push(document.querySelector("#eletro"));
categorias.push(document.querySelector("#moveis"));
categorias.push(document.querySelector("#roupas"));
checkAll.addEventListener("click", function () {
  if (checkAll.checked) {
    for (let item of categorias) item.checked = true;
    flag = categorias.length;
  } else {
    for (let item of categorias) item.checked = false;
    flag = 0;
  }
});
for (let item of categorias) {
  item.addEventListener("click", function () {
    if (item.checked) flag++;
    else flag--;
    if (flag === categorias.length) checkAll.checked = true;
    else checkAll.checked = false;
  });
}

document.addEventListener("DOMContentLoaded", function () {
  var cards = document.querySelectorAll(".card");

  for (var i = 0; i < cards.length; i++) {
    (function (index) {
      cards[index].addEventListener("click", function () {
        var card = cards[index];
        var pElements = card.querySelectorAll(".productInfos p");
        var productImage = card.querySelector("img");
        var pArray = Array.from(pElements);

        let product = pArray[0].textContent;
        let price = pArray[1].textContent;
        let description = pArray[2].textContent;

        console.log(product + "\t" + price + "\t" + description);
        var url = `anuncio.html?produto=${encodeURIComponent(product)}&preco=${encodeURIComponent(price)}&descricao=${encodeURIComponent(description)}&imgUrl=${encodeURIComponent(productImage.src)}`;
        window.location.href = url;
      });
    })(i);
  }
});

var collapseBtn = document.querySelector("#collapseBtn");

collapseBtn.addEventListener("click", function () {
  var content = document.querySelector("#collapse-content");
  if (content.style.maxHeight) {
    content.style.maxHeight = null;
    content.style.borderStyle = "none";
  } else {
    content.style.maxHeight = content.scrollHeight + "px";
    content.style.borderStyle = "solid";
  }
})

function renderProducts(newProducts) {

  const prodsSection = document.getElementById("resultsContainer");
  const template = document.getElementById("template");
  console.log(newProducts)
  for (let product of newProducts) {
    if(product.NomeArqFoto == null)
      product.NomeArqFoto = "default_img.jpeg"
    let html = template.innerHTML
      .replace("{{prod-image}}", product.NomeArqFoto)
      .replace("{{prod-name}}", product.Titulo)
      .replace("{{prod-price}}", product.Preco)
      .replace("{{prod-desc}}", product.Descricao);
    prodsSection.insertAdjacentHTML("beforeend", html);
  };
}

async function loadProducts() {

  try {
    var response = await fetch("https://ufumix.infinityfreeapp.com/publico/scripts/more-products.php?offset=" + offset);
    if (!response.ok) throw new Error(response.statusText);
    var products = await response.json();
    offset += 6;
  }
  catch (e) {
    console.error(e);
    return;
  }

  renderProducts(products);
}

window.onload = function () {
  console.log(":)")
  loadProducts();
}

window.onscroll = function () {
  if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight - 200) {
    loadProducts();
  }
  setTimeout(function () {
    scrolling = false;
  }, 200);
};