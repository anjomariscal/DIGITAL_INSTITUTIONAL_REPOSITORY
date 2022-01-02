<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="autor" content="Jéssica Angel Mariscal Pereira de Sousa Fernandes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	
	<style> body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
			.w3-row-padding img {margin-bottom: 12px}
			.w3-sidebar {width: 120px;background: #222;}
			#main {margin-left: 120px}
			@media only screen and (max-width: 600px) {#main {margin-left: 0}}</style>
	
	<title>REPOSITÓRIO INSTITUCIONAL</title>
</head>
<body class="w3-black">
	<!-- Barra lateral - Deve ser igual em todas as paginas -->
	<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
		<img src="/img/Logo.png" style="width:100%">
		<a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-black"> 
			<i class="fa fa-home w3-xxlarge"></i>
			<p>INICIO</p>
		</a>
		<a href="listar.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black"> 
			<i class="fa fa-list-ul	 w3-xxlarge"></i>
			<p>LISTAR TÍTULOS</p>
		</a>
		<a href="pesquisar.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black"> 
			<i class="fas fa-search w3-xxlarge"></i>
			<p>PESQUISAR</p>
		</a>
		<a href="pesquisar_autor.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black"> 
			<i class="fas fa-user-graduate w3-xxlarge"></i>
			<p>PESQUISAR AUTOR</p>
		</a>
	</nav>

	<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
		<div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
			<a href="index.php" class="w3-bar-item w3-button" style="width:25% !important">INICIO</a>
			<a href="listar.php" class="w3-bar-item w3-button" style="width:25% !important">LISTAR TÍTULOS</a>
			<a href="pesquisar.php" class="w3-bar-item w3-button" style="width:25% !important">PESQUISAR</a>
			<a href="pesquisar_autor.php" class="w3-bar-item w3-button" style="width:25% !important">PESQUISAR AUTOR</a>
		</div>
	</div>
	<!--Fim do que deve ser igual em todas as paginas -->

	<!-- Cabeçalho da Pagina -->
		<div class="w3-padding-large" id="main">
			<header class="w3-container w3-padding-32 w3-center w3-black" id="home">
				<h1 class="w3-jumbo"><span class="w3-hide-small">Repositório Institucional</span></h1>
			</header>
		</div>
	<!-- Fim Cabeçalho da Pagina -->

	<!--HOME PAGE -->
	<!--Área de Pesquisa-->	
	<div class="w3-padding-large" id="main">
		<form  method="post" action="buscar.php"> 
			<div class="w3-round-large w3-padding-top-32 w3-text-blue-grey w3-col" style="width:90%;">
				<input class="w3-input w3-border-blue-grey w3-text-blue-grey" name="txtPesquisa" type="text" placeholder = "Digite o Título a ser pesquisado"><br>
			</div>
			<div class="w3-round-large w3-col" style="width:10%;">
				<button style="text-decoration: none;" class="w3-button w3-round-large w3-padding-top-32"> 
					<i class="fas fa-search w3-xxlarge"></i>
					<p style="font-size: 1em"></p>
				</button>
			</div>
		</form>
	</div><br>
	<!--Fim da Área de Pesquisa-->	
	<!-- Sobre -->
	<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
		<h2 class="w3-text-light-grey">O que é o RID</h2>
		<hr style="width:200px" class="w3-opacity">
		<p>O RID ou Repositório Institucional Digital tem por objetivo a divulgação e disponibilização de produções ciêntificas.</p>
		<p>“Uma educação científica deve preparar o cidadão para assimilar informações de qualidade, aprimorando o seu juízo crítico” (LIMA, 1999)</p>
	</div><br>
	
</body>
</html>