create schema socializer default char set utf8;
use socializer;

create table usuario (
    id int(15) not null,
	email varchar (50) not null,
    nome varchar (30) not null,
    sobrenome varchar(45) not null,
	user varchar(10) not null unique,
	senha varchar(700) not null,
    sexo varchar (2),
	primary key (email)
);

CREATE TABLE amizades (
  id int(11) NOT NULL,
  de varchar(100) NOT NULL,
  para varchar(100) NOT NULL,
  status varchar(20) not null,
  primary key (id)
  /*foreign key(de) references usuario (id),
  foreign key(para) references usuario (id)*/
);

CREATE TABLE mensagens (
  id int(11) NOT NULL,
  de varchar(100) NOT NULL,
  para varchar(100) NOT NULL,
  texto text NOT NULL,
  imagem text NOT NULL,
  data date NOT NULL,
  status int(11) NOT NULL DEFAULT '0',
  primary key (id)
);

    
select * from amizades;
select * from mensagens;
select * from usuario 
order by id;
show tables;