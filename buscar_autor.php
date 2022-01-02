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
		<a href="pesquisar.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black"> 
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
		<form  method="post" action="buscar_autor.php"> 
			<div class="w3-round-large w3-padding-top-32 w3-text-blue-grey w3-col" style="width:90%;">
				<input class="w3-input w3-border-blue-grey w3-text-blue-grey" name="txtPesquisa" type="text" placeholder = "Digite o nome do autor"><br>
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
		
	</div>
	
	<!--codificacao da pagina-->
	<div class="w3-content w3-justify w3-text-grey">
		 <?php
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "repositorio_institucional";
            $conexao = new mysqli($servername, $username, $password, $dbname);
			$conexao -> set_charset("utf8");
			$pesquisa = "%".trim($_POST['txtPesquisa'])."%";
			
            if ($conexao->connect_error) {
                echo '
				<div class="w3-panel w3-red">';
				die("Connection failed: " . $conexao->connect_error);
				echo '</div>';
            } 
            echo '
                <div class="w3-paddingw3-content w3-margin">
					<table class="w3-table w3-striped w3-bordered">
					<thead>   
						<tr class="w3-grey w3-hoverable">
							<th>Autor</th>
							<th>Tipo Autor</th>
							<th>Título</th>
							<th>Ano</th>
							<th>Curso</th>
							<th>Tipo</th>
							<th>Visualizar</th>
							<th>Abrir</th>
						</tr>
					<thead>
					';
					$sql = "SELECT * FROM publicacao pub INNER JOIN trabalho t ON pub.cod_trabalho = t.cod_trabalho
														 INNER JOIN tipo_trabalho tt ON t.cod_t_trabalho = tt.cod_tipo_trabalho
														 INNER JOIN autor a ON pub.cod_autor = a.cod_autor 
														 INNER JOIN oferta_curso of ON a.cod_oferta_curso = of.cod_oferta_curso
														 INNER JOIN curso cur ON of.cod_curso = cur.cod_curso
														 INNER JOIN pessoa p ON p.cod_pessoa = a.cod_pessoa
														 INNER JOIN tipo_autor ta ON ta.cod_tipo_autor = a.cod_tipo_autor 
														 WHERE primeiro_nome_pessoa LIKE '".$pesquisa."' 
																OR nome_meio_pessoa LIKE '".$pesquisa."' 
																OR ultimo_nome_pessoa LIKE '".$pesquisa."' 
														 GROUP BY a.cod_autor
														 ORDER BY p.primeiro_nome_pessoa, t.titulo_trabalho";
					$resultado = $conexao->query($sql);
					if($resultado != null)
					foreach($resultado as $linha) {
						echo '<tr>';
							echo '<td>'.$linha['primeiro_nome_pessoa'].' '.$linha['nome_meio_pessoa'].' '.$linha['ultimo_nome_pessoa'].'</td>';
							echo '<td>'.$linha['desc_tipo_autor'].'</td>';							
							echo '<td>'.$linha['titulo_trabalho'].'</td>';
							echo '<td>'.$linha['ano_trabalho'].'</td>';
							echo '<td>'.$linha['nome_curso'].'</td>';
							echo '<td>'.$linha['desc_tipo_trabalho'].'</td>';
							echo '<td style="text-align: center"><a href="visualizar.php?codTrab='.$linha['cod_trabalho'].'"><i class="far fa-eye w3-large w3-text-blue"></i></a></td></td>';							
							echo '<td style="text-align: center"><a href='.$linha['local_arq_trabalho'].' target="_blank"><i class="far fa-file-pdf	w3-text-red w3-large"></i></a></td></td>';
						echo '</tr>';
					}
					echo '
                </table>
            </div>';
            $conexao->close();
        ?>
		
	</div>
	
</body>
</html>