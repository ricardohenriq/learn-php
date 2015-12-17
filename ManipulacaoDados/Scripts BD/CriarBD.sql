# Com o "MySql Command Line Client" aberto: Cole o COMANDO ABAIXO e Tecle ENTER
# source C:/xampp/htdocs/PHP/ManipulacaoDados/Scripts BD/CriarBD.sql;
CREATE DATABASE livro CHARACTER SET utf8 COLLATE utf8_general_ci;
USE livro;
CREATE TABLE famosos(codigo INTEGER, nome VARCHAR(40));
CREATE TABLE pessoa(id INTEGER, nome VARCHAR(40), endereco VARCHAR(40), datanasc DATE, 
sexo CHAR(1), linguas VARCHAR(40), qualifica TEXT);
CREATE TABLE livros(id INTEGER, titulo VARCHAR(40), autor VARCHAR(40), tema CHAR(1), 
editora VARCHAR(40), ano VARCHAR(4), resumo TEXT);
CREATE TABLE nerd(codigo INTEGER, nome VARCHAR(40), telefone CHAR(9));