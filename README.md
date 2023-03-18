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

## 🛠️ Configurando o ambiente

```bash
# Navegue até sua pasta do servidor.
$ cd /vaw/www/html
* ou
$ cd C:\xampp

# Clone o projeto.
$ git clone https://srgeverson@github.com/system.git

# Execute o script de banco de dados.
$ mysql -u {NOME_USUÁRIO_DE_BANCO_DE_DADOS} -p {NOME_BANCO_DE_DADOS} < /system/br/com/system/sql/system.sql

# Abra no navegador
$ http://localhost/system

```

## 🎲 Executando projeto

```bash

# Clone o projeto.
$ git clone https://srgeverson@github.com/system.git

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

## 👨‍💻 Equipe de Desenvolvimento

* **Geverson Souza** - [Geverson Souza](https://www.linkedin.com/in/srgeverson/)
## ✒️ Autores

* **Geverson Souza** - [Geverson Souza](https://www.linkedin.com/in/srgeverson/)

## 📌 Versão 1.0.1

Nós usamos [Github](https://github.com/) para controle de versão.
