<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/publico/styles/publicStyles.css" />
    <link rel="stylesheet" href="/restrito/restrictStyle.css" />
    <title>Document</title>
  </head>
  <body>
    <header>
      <div class="logo">
        <div>
          <img src="img/logotipo.png" height="100" alt="produto" />
        </div>
        <h1>UFUMix</h1>
      </div>
      <nav>
        <ul class="navbar">
            <li>
                <p style = "color: white;">Olá,<strong><?php echo $_SESSION['username']; ?></strong></p>
            </li>

        </ul>
      </nav>
    </header>
    <main>

        <div class="announceBox mid-page-div">
            <h1 style="text-align: center;">CRIE SEU ANUNCIO:</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="productName">Nome do produto</label>
                <input type="text" class="productName" id="productName" name="productName">
                
                <label for="productDescription">Descrição do produto</label>
                <input type="text" class="productDescription" id="productDescription" name="productDescription">
                
                <label for="productPrice">Preço do produto (R$)</label>
                <input type="number" class="productPrice" id="productPrice" name="productPrice">
                
                <label for="productImage">Foto do produto</label>
                <input type="file" id="productImage" name="productImage">
                
                <input type="submit" value="Enviar">
            </form>
        </div>
    </main>
    <footer></footer>
  </body>
</html>
