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
	
	<!-- Programação -->
	<div class="w3-content w3-justify w3-text-grey w3-padding-16" id="about">
	 <?php
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "repositorio_institucional";
            $conexao = new mysqli($servername, $username, $password, $dbname);
			$conexao -> set_charset("utf8");
			$pesquisa = $_GET['codTrab'];
			$hoje = date('d M. Y');
			
            if ($conexao->connect_error) {
                echo '
				<div class="w3-panel w3-red">';
				die("Connection failed: " . $conexao->connect_error);
				echo '</div>';
            } 
			
            echo '
			<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
				';
				$sql = "SELECT t.local_arq_trabalho, UPPER(t.titulo_trabalho) as titulo, t.ano_trabalho, tt.desc_tipo_trabalho, c.nome_curso, ac.nome_area_curso, tc.nome_tipo_curso
							FROM publicacao pub INNER JOIN trabalho t ON pub.cod_trabalho = t.cod_trabalho
												INNER JOIN tipo_trabalho tt  ON tt.cod_tipo_trabalho = t.cod_t_trabalho
												INNER JOIN autor a ON a.cod_autor = pub.cod_autor
												INNER JOIN oferta_curso of ON of.cod_oferta_curso = a.cod_oferta_curso
												INNER JOIN curso c ON c.cod_curso = of.cod_curso
												INNER JOIN area_curso ac ON ac.cod_area_curso = c.cod_area_curso
												INNER JOIN tipo_curso tc ON tc.cod_tipo_curso = c.cod_tipo_curso
												WHERE t.cod_trabalho = '".$pesquisa."'
												GROUP BY t.cod_trabalho";
												
				$resultado = $conexao->query($sql);
				if($resultado != null)
				foreach($resultado as $linha) {
					echo ' <h2 class="w3-text-light-grey">'.$linha['titulo'].'</h2>';
					echo ' <hr style="width:200px" class="w3-opacity">';
					echo ' <p>'.$linha['ano_trabalho'].' | '.$linha['desc_tipo_trabalho'].'</p>';
					echo ' <p>'.$linha['nome_curso'].' | '.$linha['nome_tipo_curso'].' | '.$linha['nome_area_curso'].'</p>';
					echo ' <p><a href='.$linha['local_arq_trabalho'].' style="text-decoration:none" target="_blank">
						   <i class="far fa-file-pdf w3-text-red w3-large"></i> | Visualizar PDF</a></p>';

				}	
			echo '
            </div>';
			
			echo '
			<h3 class=" w3-text-light-grey">Autores</h3> 
			<table class="w3-table w3-card-4" style="width:80%">
			';
			$sql = "SELECT p.primeiro_nome_pessoa, p.nome_meio_pessoa, p.ultimo_nome_pessoa, ta.desc_tipo_autor, em.email FROM publicacao pub INNER JOIN trabalho t ON t.cod_trabalho = pub.cod_trabalho
																								 INNER JOIN autor a ON a.cod_autor = pub.cod_autor
																								 INNER JOIN pessoa p ON p.cod_pessoa = a.cod_pessoa
																								 INNER JOIN tipo_autor ta ON ta.cod_tipo_autor = a.cod_tipo_autor
																								 LEFT OUTER JOIN email em ON p.cod_pessoa = em.cod_pessoa
																								 WHERE t.cod_trabalho = '".$pesquisa."'";
;
			$resultado = $conexao->query($sql);
			if($resultado != null)
			foreach($resultado as $linha) {
				echo '<tr>';
					echo '<td style="text-align: center"><a><i class="fa fa-user-circle w3-xlarge"></i></a></td>';
					echo '<td>'.$linha['primeiro_nome_pessoa'].' '.$linha['nome_meio_pessoa'].' '.$linha['ultimo_nome_pessoa'].'</td>';
					echo '<td>'.$linha['desc_tipo_autor'].'</td>';
					echo '<td>'.$linha['email'].'</td>';					
				echo '</tr>';	
			}
			echo '</table>';
			
			echo '
			<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
				<h3 class="w3-text-light-grey">Resumo</h3> 
				';
				$sql = "SELECT * FROM trabalho WHERE cod_trabalho = '".$pesquisa."'";
			
				$resultado = $conexao->query($sql);
				if($resultado != null)
				foreach($resultado as $linha) {
					echo '<p>'.$linha['resumo_trabalho'].'</p>';
				}
				
				echo ' 
					<h5>Palavras-chave:</h5>
				';
				$sql = "SELECT pc.palavra_chave FROM trabalho t INNER JOIN palavra_chave_trabalho pct ON t.cod_trabalho = pct.cod_trabalho 
																INNER JOIN palavra_chave pc ON pc.cod_palavra_chave = pct.cod_palavra_chave
																WHERE t.cod_trabalho = '".$pesquisa."'";
				$resultado = $conexao->query($sql);
				if($resultado != null)
				foreach($resultado as $linha) {
					echo '<ul class="w3-ul">';
						echo '<li class="w3-padding-small">	• '.$linha['palavra_chave'].'</li>';					
					echo '</ul>';	
				}
				echo '</table>';
			echo '
			</div>';
			
			echo '
			<div class="w3-content w3-justify w3-text-grey w3-padding-6" id="about">
				';
				$sql = "SELECT ie.nome_instituicao_ensino, eie.logradouro_endereco_instituicao_ensino, cid.nome_cidade, est.nome_estado, ps.nome_pais
					FROM publicacao pub INNER JOIN trabalho t ON pub.cod_trabalho = t.cod_trabalho
										INNER JOIN autor a ON a.cod_autor = pub.cod_autor
										INNER JOIN oferta_curso of ON of.cod_oferta_curso = a.cod_oferta_curso
										INNER JOIN endereco_instituicao_ensino eie ON eie.cod_endereco_instituicao_ensino = of.cod_endereco_instituicao_ensino
										INNER JOIN instituicao_ensino ie ON ie.cod_instituicao_ensino = eie.cod_instituicao_ensino
										INNER JOIN cidade cid ON cid.cod_cidade = eie.cod_cidade
										INNER JOIN estado est ON est.cod_estado = cid.cod_estado
										INNER JOIN pais ps ON ps.cod_pais = est.cod_pais
										WHERE t.cod_trabalho = '".$pesquisa."'
										GROUP BY t.cod_trabalho;";
			
			$resultado = $conexao->query($sql);
			if($resultado != null)
			foreach($resultado as $linha) {
				echo '<h3 class="w3-text-light-grey">'.$linha['nome_instituicao_ensino'].'</h3>';
				echo '<p>'.$linha['logradouro_endereco_instituicao_ensino'].'</p>';
				echo '<p>'.$linha['nome_cidade'].' - '.$linha['nome_estado'].'</p>';
				echo '<p>'.$linha['nome_pais'].'</p>';
				echo '<br>';
			}
			echo '
			</div>';
			
			echo '
			<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
				<h3 class="w3-text-light-grey">Citação</h3> 
				<div class="w3-display w3-padding-large w3-border w3-text-grey w3-left-align">
					';
					$sql = "SELECT GROUP_CONCAT(CONCAT(COALESCE(UPPER(p.ultimo_nome_pessoa),''), ', ', 
													   COALESCE(p.primeiro_nome_pessoa, ''), ' ', 
													   COALESCE(p.nome_meio_pessoa,'')) SEPARATOR '; ') as autor,
													   t.titulo_trabalho, cid.nome_cidade, est.nome_estado, ie.nome_instituicao_ensino, t.ano_trabalho, t.local_arq_trabalho
								   FROM publicacao pub INNER JOIN trabalho t ON pub.cod_trabalho = t.cod_trabalho
													   INNER JOIN tipo_trabalho tt ON tt.cod_tipo_trabalho = t.cod_t_trabalho
													   INNER JOIN autor a ON a.cod_autor = pub.cod_autor
													   INNER JOIN tipo_autor ta ON a.cod_tipo_autor = ta.cod_tipo_autor
													   INNER JOIN pessoa p ON a.cod_pessoa = p.cod_pessoa
													   INNER JOIN oferta_curso of ON of.cod_oferta_curso = a.cod_oferta_curso
													   INNER JOIN endereco_instituicao_ensino eie ON eie.cod_endereco_instituicao_ensino = of.cod_endereco_instituicao_ensino
													   INNER JOIN instituicao_ensino ie ON ie.cod_instituicao_ensino = eie.cod_instituicao_ensino
													   INNER JOIN cidade cid ON cid.cod_cidade = eie.cod_cidade
													   INNER JOIN estado est ON est.cod_estado = cid.cod_estado
								   WHERE ta.cod_tipo_autor = 1 AND t.cod_trabalho = '".$pesquisa."'
								   GROUP BY t.cod_trabalho";
			
				$resultado = $conexao->query($sql);
				if($resultado != null)
				foreach($resultado as $linha) {
					echo '<p>'.$linha['autor'].'. '.$linha['titulo_trabalho'].'. '.$linha['nome_cidade'].' - '.$linha['nome_estado'].': '.$linha['nome_instituicao_ensino'].', '
						  .$linha['ano_trabalho'].'. Dispponível em: '.$linha['local_arq_trabalho'].'. Acesso em: '.$hoje.'. </p>';
					echo '<br>';
				}
				echo '
				</div>
			</div>';
 
            $conexao->close();
        ?>
	</div>
	
</body>
</html>
