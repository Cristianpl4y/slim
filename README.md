# Slim  

Criando um Website com PHP Slim Framework, curso do instrutor [Marcos Pereira](https://www.udemy.com/user/marcus-pereira-4/).<br>
Não é só porque o Slim é um Micro-Framework que significa que não podemos fazer uma aplicação completa com ele, muito pelo contrário, a simplicidade dele é muito poderosa.

## Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina o [mysql](https://www.mysql.com/downloads/).<br>
PHP básico e orientado a objetos.


## Iniciando (servidor)

```bash
# Clone este repositório
$ git clone https://github.com/Cristianpl4y/slim.git

# Acesse a pasta do projeto no terminal/cmd
$ cd slim

# Instale as dependências
$ composer install

# Para Importar o Banco de Dados
$ mysql -uroot -p < mpblog.sql

# Execute a aplicação em modo de desenvolvimento
$  php -S localhost:8000 -t public/

# O servidor inciará na porta:8000 - acesse <http://localhost:8000>
```

Desenvolvendo o projeto eu aprendi: 
  <ul>
    <li>Criar Rotas</li>
    <li>Conceito de Middlewares e aplicação do mesmo</li>
    <li>Criar Controllers para trabalhar com Slim</li>
    <li>Validar inputs com validations</li>
    <li>Autenticação</li>
    <li>Bloqueio de rotas para usuários autenticados</li>
  <ul>
<br>

