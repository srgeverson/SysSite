# system - Sistema de Disponibilização de Folha de Pagamento
Este sistema servirá para disponibilizar folha de pagamento dos funcionários, onde o usuário ira realizar o updload dos contra-cheques em pdf e o sistema ler os arquivos e vincula aos respectivos funcionários.

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [Servidor Apache](https://httpd.apache.org/download.cgi), [MySQL](https://www.mysql.com/downloads/) e [PHP](https://www.php.net/downloads.php) ou [XAMPP](https://www.apachefriends.org/). 
Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/)

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
# 
$ docker run -d php:7.4-apache
* ou
$ docker inspect \ -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' \ apache_server
$ docker run -tid \ -p 8000:80 \ --name apache_server \ -v YOUR_HOST_WWW_ROOT:/var/www/html \ php:7.4-apache
# Clone o projeto.
$ git clone https://srgeverson@github.com/system.git

# Execute o script de banco de dados.
$ mysql -u {NOME_USUÁRIO_DE_BANCO_DE_DADOS} -p {NOME_BANCO_DE_DADOS} < /system/br/com/system/sql/system.sql

# Abra no navegador
$ http://localhost/system

```

## 👨‍💻 Equipe de Desenvolvimento

* **Geverson Souza** - [Geverson Souza](https://www.linkedin.com/in/srgeverson/)
## ✒️ Autores

* **Geverson Souza** - [Geverson Souza](https://www.linkedin.com/in/srgeverson/)

## 📌 Versão 1.0.1

Nós usamos [Github](https://github.com/) para controle de versão.
