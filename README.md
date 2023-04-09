# <a href="http://mystore-app.ddns.net/SysSite/" target="_blank">SysSite</a>
Site com sistema integrado para gerenciamento de seu próprio conteúdo.
Este sistema possui um site onde o mesmo é genrenciado pelo mesmo.

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [Servidor Apache](https://httpd.apache.org/download.cgi), [MySQL](https://www.mysql.com/downloads/) e [PHP](https://www.php.net/downloads.php) ou [XAMPP](https://www.apachefriends.org/). 
Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/)

## 🔧 Bibliotecas utilizadas

* **[PdfToText](https://www.phpclasses.org/package/9732-PHP-Extract-text-contents-from-PDF-files.html)**
* **[phpmailer](https://github.com/PHPMailer/PHPMailer)**
* **[random_compat]()**
* **[bootstrap v4.1.3](https://getbootstrap.com/)**
* **[fontawesome-free 5.8.2](https://fontawesome.com)**
* **[chart.js v2.8.0](https://www.chartjs.org)**
* **[datatables 1.10.19](https://www.datatables.net/)**
* **[jquery v3.4.1](https://jquery.com/)**
* **[datepicker](https://www.eyecon.ro/bootstrap-datepicker/)**
* **[select v1.13.18](https://developer.snapappointments.com/bootstrap-select/)**
* **[phpPasswordHashingLib](https://github.com/superandrew/phpPasswordHashingLib)**

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

# No arquivo /assets/php/conf.php conferir/alterar as seguintes variáveis globais para a seguinte maneira
$ $GLOBALS['base_server'] = $_SERVER['DOCUMENT_ROOT'] . "/system/";
$ $GLOBALS['base_url'] = "http://" . $_SERVER['SERVER_NAME'] . "/system/";

# No arquivo /dao/GenericDAO.php especificar no atributo $host o IP ou nome do domínio
$ $this->host='localhost' 

# Execute o script de banco de dados.
$ mysql -u {NOME_USUÁRIO_DE_BANCO_DE_DADOS} -p {NOME_BANCO_DE_DADOS} < /system/sql/system.sql

# Abra no navegador
$ http://localhost/system

```

## 🎲 Executando projeto

```bash

# Clone o projeto.
$ git clone https://srgeverson@github.com/system.git

# Acessando a pasta clonada
$ cd system/

# No arquivo /assets/php/conf.php conferir/alterar as seguintes variáveis globais para a seguinte maneira
$ $GLOBALS['base_server'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$ $GLOBALS['base_url'] = "http://" . $_SERVER['SERVER_NAME'] . "/";

# Crie um banco de dados e adicione ao arquivo .env na raiz do projeto as seguintes configurações: 
$ BANCO_HOST_IP=db_system
$ BANCO_PORTA=3306
$ BANCO_USUARIO=root
$ BANCO_SENHA=12345678
$ BANCO_NOME=system

# Para ciar variável de ambiente no linux:
$ export BANCO_HOST_IP="db_system"

# Para ciar variável de ambiente no windows:
$ setx BANCO_HOST_IP db_system /m

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
$ cd C:\Program Files\MySQL\MySQL Server 8.0\

# Autenticando no banco de dados em seguida será solicitado a senha
$ mysql -u root -p

# Saindo da autenticação
$ exit;

# Salvando dados
$ mysqldump -u root -p system > {PASTA_DE_DESTINO_DO_BACACKUP}/backup_db_system.sql

# Resraurando
$ mysql -u root -p system < {PASTA_ONDE_O_PROJETO_FOI_CLONADO}/system/sql/system.sql

```

## 👨‍💻 Equipe de Desenvolvimento

* **Geverson Souza** - [Geverson Souza](https://www.linkedin.com/in/srgeverson/)
## ✒️ Autores

* **Geverson Souza** - [Geverson Souza](https://www.linkedin.com/in/srgeverson/)

## 📌 Versão 1.0.1

Nós usamos [Github](https://github.com/) para controle de versão.
