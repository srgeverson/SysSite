# system - Sistema de Disponibilização de Folha de Pagamento
Este sistema servirá para disponibilizar folha de pagamento dos funcionários, onde o usuário ira realizar o updload dos contra-cheques em pdf e o sistema ler os arquivos e vincula aos respectivos funcionários.

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [Servidor Apache](https://httpd.apache.org/download.cgi), [MySQL](https://www.mysql.com/downloads/) e [PHP](https://www.php.net/downloads.php) ou [XAMPP](https://www.apachefriends.org/). 
Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/)

## 🔧 Bibliotecas utilizadas

* **PdfToText**
* **phpmailer**
* **random_compat**
* **bootstrap**
* **fontawesome-free**
* **chart.js**
* **datatables**
* **jquery**

## 🛠️ Configurando o ambiente

```bash
# Navegue até sua pasta do servidor.
$ cd /vaw/www/html
* ou
$ cd C:\xampp

# Clone o projeto.
$ git clone https://srgeverson@github.com/system.git

# Acessando a pasta clonada
$ cd system/

# No arquivo /br/com/system/assets/php/conf.php conferir/alterar as seguintes variáveis globais para a seguinte maneira
$ $GLOBALS['base_server'] = $_SERVER['DOCUMENT_ROOT'] . "/system/";
$ $GLOBALS['base_url'] = "http://" . $_SERVER['SERVER_NAME'] . "/system/";

# No arquivo /br/com/system/dao/GenericDAO.php especificar no atributo $host o IP ou nome do domínio
$ $this->host='localhost' 

# Execute o script de banco de dados.
$ mysql -u {NOME_USUÁRIO_DE_BANCO_DE_DADOS} -p {NOME_BANCO_DE_DADOS} < /system/br/com/system/sql/system.sql

# Abra no navegador
$ http://localhost/system

```

## 🎲 Executando projeto

```bash

# Clone o projeto.
$ git clone https://srgeverson@github.com/system.git

# Acessando a pasta clonada
$ cd system/

# No arquivo /br/com/system/assets/php/conf.php conferir/alterar as seguintes variáveis globais para a seguinte maneira
$ $GLOBALS['base_server'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$ $GLOBALS['base_url'] = "http://" . $_SERVER['SERVER_NAME'] . "/";

# No arquivo /br/com/system/dao/GenericDAO.php especificar no atributo $host o nome do serviço do docker
$ $this->host='db_system' 

# Baixar as imagems e executar os containers em modo não iterativo(deve ser utilizado na primeira execução)
$ docker-compose up -d

# Baixar as imagems e executar os containers em modo iterativo(deve ser utilizado na primeira execução)
$ docker-compose up

# Inicializa quando precisa executar os container depois da primeira vez
$ docker-compose start

# Para os containers
$ docker-compose stop

# Reiniciar os containers
$ docker-compose restart

# Apagar as imagems e parar os containers (deve ser utilizado quando precisar recriar as imagens)
$ docker-compose down

# Instalar driver de banco de dados
$ docker-compose exec site_system docker-php-ext-install pdo pdo_mysql mysqli

# Abra no navegador
$ http://localhost

```

## 📃 Backup/Restore de dados

```bash
# Em ambientes windows execute o seguinte comando
$ cd C:\Program Files\MySQL\MySQL Server 8.0\bin\

# Autenticando no banco de dados em seguida será solicitado a senha
$ mysql -u root -p

# Saindo da autenticação
$ exit;

# Salvando dados
$ mysqldump -u root -p system > {PASTA_DE_DESTINO_DO_BACACKUP}/backup_db_system.sql

# Resraurando
$ mysql -u {NOME_USUÁRIO_DE_BANCO_DE_DADOS} -p {NOME_BANCO_DE_DADOS} < {PASTA_ONDE_O_PROJETO_FOI_CLONADO}/system/br/com/system/sql/system.sql

```

## 👨‍💻 Equipe de Desenvolvimento

* **Geverson Souza** - [Geverson Souza](https://www.linkedin.com/in/srgeverson/)
## ✒️ Autores

* **Geverson Souza** - [Geverson Souza](https://www.linkedin.com/in/srgeverson/)

## 📌 Versão 1.0.1

Nós usamos [Github](https://github.com/) para controle de versão.
