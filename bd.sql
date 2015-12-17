# Com o "MySql Command Line Client" aberto: Cole o COMANDO ABAIXO e Tecle ENTER
# source C:/xampp/htdocs/PHP/bd.sql;

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` text,
  `valor` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
  
insert  into `produtos`(`id`,`nome`,`descricao`,`valor`) values (1,'Caneta','Caneta azul','3,00');
insert  into `produtos`(`id`,`nome`,`descricao`,`valor`) values (2,'Caderno','Caderno 200 páginas','8,00');
insert  into `produtos`(`id`,`nome`,`descricao`,`valor`) values (3,'Borracha','Borracha para lápis','1,00');
insert  into `produtos`(`id`,`nome`,`descricao`,`valor`) values (4,'Mochila','Mochila escolar preta','35,00');