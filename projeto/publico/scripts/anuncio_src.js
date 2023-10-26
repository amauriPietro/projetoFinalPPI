var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);


var produto = urlParams.get("produto");
var preco = urlParams.get("preco");
var descricao = urlParams.get("descricao");
var imagem = urlParams.get("imgUrl");

var imageElement = document.querySelector(".anuncio img");
var description = document.getElementById("descriptionField")
var price = document.getElementById("priceField")
var title = document.getElementById("title")

description.querySelector('p').textContent = descricao;
price.querySelector('p').textContent = preco;
title.querySelector('h3').textContent = produto;
imageElement.src = imagem;