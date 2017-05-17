<?php

#variaveis de conexão com o mysql
$conecta = mysql_connect("127.0.0.1", "root", "root") or print (mysql_error()); 

#comando para selecionar o banco de dados criado
mysql_select_db("db_tse", $conecta) or print(mysql_error()); 

#query para selecionar os dados que serão utilizados para criar o json
$table = ("SELECT data_geracao,descricao_cargo,ano_eleicao,num_turno,sigla_uf,codigo_municipio,numero_zona,nome_candidato,sigla_partido,total_votos FROM teste") or print (mysql_error());

#resultado da query
$result = mysql_query($table, $conecta);

#A variável $result agora contém e referência um objeto MySQL. Iniciando a iteração ao objeto para resgatar os registros através de um laço até que acabe os registros
while ($row = mysql_fetch_array($result))
{

    $i=0;

    foreach($row as $key => $value)
    {

        if (is_string($key))
        {
         $fields[mysql_field_name($result,$i++)] = $value;
        }

    }
#array final com todos os registros
    $municipio = $fields['nome_municipio'];

#criação de um matriz com os dados estruturados para a criação do arquivo json no formato para ser salvo no mongodb    
    $json_result=array(
	    			    array(  	
	    			    'data da geracao' => $fields['data_geracao'],
	    			  	'ano da eleicao' => $fields['ano_eleicao'],
	    			  	'cargo' => $fields['descricao_cargo'],
	    			  	'turno' => $fields['num_turno'],
	    			  	'UF' => 
	    			  			[$fields['sigla_uf']=>
	    			  								['municipio'=>['codigo_municipio'=>$fields['codigo_municipio'],
	    			  												'nome_candidato'=>$fields['nome_candidato'],
	    			  												'zona'=>['numero_zona'=>$fields['numero_zona'],
	    			  														'nome_candidato'=>$fields['nome_candidato'],
	    			  														'sigla_partio'=>$fields['sigla_partido'],
	    			  														'total_votos'=>$fields['total_votos']
	    			  														]
	    			  											  ]
	    			  								]
	    			  		    ]		  			
	    			  	)
	     	          );
 

}

#matriz salva na variavel $json
$json = json_encode($json_result);

#print_r($json);

#faz o download de um arquivo json com os dados para download
header('Content-disposition: attachment; filename=jsonFile.json');
header('Content-type: application/json');
echo $json;


?>
