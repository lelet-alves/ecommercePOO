# Mini E-commerce

Este projeto é um exemplo de e-commerce simples desenvolvido em PHP utilizando o padrão MVC e Programação Orientada a Objetos.

## Funcionalidades
- Cadastro e login de usuários
- Listagem, cadastro e remoção de produtos
- Carrinho de compras
- Finalização de pedido (checkout)
- Mensagens de feedback (flash)

## Como rodar com XAMPP
1. Coloque a pasta do projeto em `c:/xampp/htdocs/ecommerce`
2. Importe o arquivo `db/schema.sql` para criar o banco de dados
3. Verifique se o usuário e senha do MySQL em `app/config/Database.php` estão corretos (padrão do XAMPP: usuário `root`, senha vazia)
4. Inicie o Apache e MySQL pelo painel do XAMPP
5. Acesse no navegador: `http://localhost/ecommerce/public/index.php`

## Requisitos
- PHP 7.4+
- MySQL
- Servidor local (XAMPP, WAMP, etc)

## Créditos
Desenvolvido por Ana Leticia.
