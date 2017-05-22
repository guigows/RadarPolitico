<?php
	/* prepara o documento para comunicação com o JSON, as duas linhas a seguir são obrigatórias 
	  para que o PHP saiba que irá se comunicar com o JSON, elas sempre devem estar no ínicio da página */
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=utf-8"); 
	header('Content-disposition: attachment; filename=tse.json');
?>

<?php
// Dados do servidor da Hostinger
	$servidor = '127.0.0.1';
	$usuario  = 'root';
	$senha    = 'root';
	$banco    = 'db_tse';
 
	try {
		$conecta = new PDO("mysql:host=$servidor;dbname=$banco", $usuario , $senha);
		
		$consulta = $conecta->prepare("SELECT hora_geracao,ano_eleicao,descricao_cargo,num_turno,sigla_uf,codigo_municipio,nome_municipio,numero_zona,nome_candidato,nome_partido,total_votos,desc_sit_cand_tot,sigla_partido,nome_urna_candidato FROM SP_VOTACAO where DESCRICAO_CARGO='deputado federal'");
		$consulta->execute(array());  
		$resultadoDaConsulta = $consulta->fetchAll();
 
		$StringJson = "[";
 
	if ( count($resultadoDaConsulta) ) {
		foreach($resultadoDaConsulta as $registro) {
 
			if ($StringJson != "[") {$StringJson .= ",";}
			$StringJson .= '{"hora_geracao":"' . $registro[hora_geracao]  . '",';
			$StringJson .= '"ano_eleicao":"' . $registro[ano_eleicao]  . '",';
			$StringJson .= '"cargo":"' . $registro[descricao_cargo]  . '",';
			$StringJson .= '"turno":"' . $registro[num_turno]  . '",';
			$StringJson .= '"uf":"' . $registro[sigla_uf] . '",';
			$StringJson .= '"codigo_municipio":"' . $registro[codigo_municipio] . '",';
			$StringJson .= '"nome_municipio":"' . $registro[nome_municipio] . '",';
			$StringJson .= '"numero_zona":"' . $registro[numero_zona] . '",';
			$StringJson .= '"nome_candidato":"' . $registro[nome_candidato] . '",';
			$StringJson .= '"nome_urna_candidato":"' . $registro[nome_urna_candidato] . '",';
			$StringJson .= '"sigla_partido":"' . $registro[sigla_partido] . '",';
			$StringJson .= '"nome_partido":"' . $registro[nome_partido] . '",';
			$StringJson .= '"total_votos":"' . $registro[total_votos] . '",';
			$StringJson .= '"desc_sit_cand_tot":"' . $registro[desc_sit_cand_tot] . '"}';

		}  
		echo $StringJson . "]\n\n"; // Exibe o vettor JSON
} 
  
	
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage(); // opcional, apenas para teste
}
?>