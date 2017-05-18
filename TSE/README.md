<p align="center">
<img src="http://up.mackenzie.br/fileadmin/CONFIGURACOES/SITES/UP_MACKENZIE/Resources/Public/Icons/Touch/196.png" width="140px">
</p>


`Última Sprint: 10/05/2017`

# Radar Politico
È uma plataforma de dados para análise do cenário político brasileiro
que, em uma visão objetiva e sintética, demonstra a performance dos políticos eleitos através da comparação de projetos aprovados, reação pública (tweets), zona eleitoral e princípios partidários de seus políticos.
Diferentemente do RANKING POLÍTICOS (http://www.politicos.org.br/), que avalia e “rankeia” apenas políticos de acordo com sua performance legislativa
nosso produto/solução compara a percepção pública, ideais políticos e projetos aprovados em uma visão que avalia partidos e políticos auxiliando na análise e decisão sobre os votos do eleitorado.Para desenvolvimento do projeto, ficaram divididos em 3 grupos, onde:
* API Twitter
* API Câmara dos Deputados
* Dados do TSE


`Última atualização: 10/05/2017`

## API TSE
O grupo ficou responsavel por análisar dados de votações por deputados federais por zonas em todo o Brasil apartir do ano de 2014. Para a Coleta dos dados, será utilizado a base dados da própria instituição que provem os dados em formato CSV. 
* <strong>Site da Coleta dos dados</strong>: http://www.tse.jus.br/hotSites/pesquisas-eleitorais/candidatos.html

## Integrantes
Os Participantes que compoem o grupo, são:
* <strong>P.O</strong>: Rafaela;
* <strong>SCRUM MASTER</strong>: Giuline;
* <strong>TEAM MEMBER</strong>: Eduardo;
* <strong>DATA CREATIVE</strong>: Flávio;
* <strong>DATA DEVELOPER</strong>: Jairo;
* <strong>DATA RESEARCHER</strong>: Hermes;

`Última atualização: 10/05/2017`


## Metodologia de Trabalho
O Desenvolvimento desse software segue as boas práticas de desenvolvimento com Scrum, agilizando processos e entregando conteúdo no menor tempo possível. Seguindo o cronograma:
* Reuniões de Sprint : Reunião para definia a proxima funcionalidade a ser implementada, realizada 15 em 15 dias.
* Reuniões de Review: Realizada no final da implementação de cada funcionalidade.
* Link do Trello para acompanhamento : https://trello.com/b/CBGbg5HX/radar-politico
* App BrandStorming : http://realtimeboard.com

`Última atualização: 10/05/2017`


## Ferramentas Utilizadas
* Software XAMMP - Ambiente PHP para rodar o script criado;
* Mysql - Banco de Dados para salvar os arquivos csv em formato de tabelas;
* MySql Workbench - Ferramenta para Visualizar as tabelas (Cli-mysql);
* MongoDB - Banco de dados NoSQL onde iremos importar os arquivos já filtrados através do script PHP;

`Última atualização: 17/05/2017`


## Passo a passo
* Instalar o XAMPP.
* Instalar o Mysql Workbench ou qualquer outra Cli-Mysql e criar as tabelas, exemplo:

```
  CREATE TABLE db_tse.{NOMEDATABELA} (
  `DATA_GERACAO` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `HORA_GERACAO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ANO_ELEICAO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `NUM_TURNO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DESCRICAO_ELEICAO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `SIGLA_UF` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `SIGLA_UE` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `CODIGO_MUNICIPIO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `NOME_MUNICIPIO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `NUMERO_ZONA` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `CODIGO_CARGO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `NUMERO_CAND` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `SQ_CANDIDATO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `NOME_CANDIDATO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `NOME_URNA_CANDIDATO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DESCRICAO_CARGO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `COD_SIT_CAND_SUPERIOR` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DESC_SIT_CAND_SUPERIOR` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `CODIGO_SIT_CANDIDATO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DESC_SIT_CANDIDATO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `CODIGO_SIT_CAND_TOT` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DESC_SIT_CAND_TOT` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `NUMERO_PARTIDO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `SIGLA_PARTIDO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `NOME_PARTIDO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `SEQUENCIAL_LEGENDA` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `NOME_COLIGACAO` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `COMPOSICAO_LEGENDA` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `TOTAL_VOTOS` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `TRANSITO` varchar(255) CHARACTER SET latin1 DEFAULT NULL)
  ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

```

*Salvar os arquivos CSV em algum diretorio e importar para o banco MySql, exemplo:

```
	LOAD DATA LOCAL INFILE '{CAMINHO ONDE ESTA O SEU CSV OU TXT/EXEMPLO.txt}' INTO TABLE db_tse.{TABELACRIADA}
	FIELDS TERMINATED BY ';'
	OPTIONALLY ENCLOSED BY '"' 
	LINES TERMINATED BY '\n'
	IGNORE 1 LINES

```
* Abrir o script e alterar o SELECT feito em SQL como os dados de campos e tabelas que você deseja alterar;

* Copiar o script alterado que tranforma os dados de SQL para JSON dentro da pasta 'htdocs' do XAMPP;

* Execultar o XAMPP e abrir no navegador o script através do endereço: 'localhost/mysql_for_php.php';

* Ao execultar o edereço no navegador, deverá automaticamente fazer o downlod de um novo arquivo 'TSE>JSON' com os dados já serializados no formato JSON, como no documento 'estrutura_mongo_tse.json';

* Inicie o servidor do mongo;

* Inicie o mongo-cli e digite o comando para importar o arquivo: <strong>mongoimport --db db_tse --collection tse --type json --file tse.json --jsonArray</strong>

* Ao final desse passo, você importou os dados para o mysql, fez o parse para JSON através do Script e importou para o mongo db, voce pode conferir através do cli-mongo como o comando <strong>show dbs</strong>.


`Última atualização: 18/05/2017`

## Links interessantes para estudo ou resolver problemas:
* https://www.digitalocean.com/community/tutorials/como-instalar-a-pilha-linux-apache-mysql-php-lamp-no-ubuntu-14-04-pt
* https://mongodbwise.wordpress.com/2014/05/22/mongodb-guia-rapido/comment-page-1/
* https://secure.php.net/manual/pt_BR/configuration.file.php
* https://zaiste.net/posts/importing_json_into_mongodb/
* http://profanderson.blog.etecarmine.com.br/json-criando-o-web-service/
* http://jordankobellarz.github.io/php/mongodb/2015/08/14/usando-driver-mongodb-php.html
* https://docs.mongodb.com/ecosystem/drivers/php/

## Para clonar o projeto para seu computador, use o git:
RadarPolitico:

```
> https://github.com/guigows/RadarPolitico.git
> cd RadarPolitico
> git init
> git add .

```

`Última atualização: 17/05/2017`


