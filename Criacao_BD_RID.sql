create database repositorio_institucional;

use repositorio_institucional;

create table pais (
			 cod_pais int(11) auto_increment,
             nome_pais varchar (100) not null,
             constraint pk_pais primary key (cod_pais));

create table estado (
			 cod_estado int(11) auto_increment,
             nome_estado varchar (100) not null,
			 cod_pais int(11),
             constraint pk_estado primary key (cod_estado),
             constraint fk_pais foreign key (cod_pais) references pais (cod_pais));

create table cidade (
			 cod_cidade int(11) auto_increment,
             nome_cidade varchar (100) not null,
			 cod_estado int(11),
             constraint pk_cidade primary key (cod_cidade),
             constraint fk_estado foreign key (cod_estado) references estado (cod_estado));

create table instituicao_ensino (
			 cod_instituicao_ensino int(11) auto_increment,
             nome_instituicao_ensino varchar(100) not null,
             constraint pk_instituicao_ensino primary key (cod_instituicao_ensino));

create table endereco_instituicao_ensino (
			 cod_endereco_instituicao_ensino int(11) auto_increment,
			 logradouro_endereco_instituicao_ensino varchar(100) not null,
			 cod_cidade int(11),
			 cod_instituicao_ensino int(11),
			 constraint pk_endereco_instituicao_ensino primary key (cod_endereco_instituicao_ensino),
			 constraint fk_cidade foreign key (cod_cidade) references cidade (cod_cidade),
             constraint fk_end_instituicao_ensino foreign key (cod_instituicao_ensino) references instituicao_ensino (cod_instituicao_ensino));

create table tipo_curso (
			 cod_tipo_curso int(11) auto_increment,
			 nome_tipo_curso varchar(100) not null,
			 constraint pk_tipo_curso primary key (cod_tipo_curso));
			 
create table area_curso (
			 cod_area_curso int(11) auto_increment,
			 nome_area_curso varchar(100) not null,
			 constraint pk_area_curso primary key (cod_area_curso));

create table curso (
			 cod_curso int(11) auto_increment,
			 nome_curso varchar (150) not null,
			 cod_area_curso int(11),
			 cod_tipo_curso int(11),
			 constraint pk_curso primary key (cod_curso),
			 constraint fk_area_curso foreign key (cod_area_curso) references area_curso (cod_area_curso),
			 constraint fk_tipo_curso foreign key (cod_tipo_curso) references tipo_curso (cod_tipo_curso));

create table oferta_curso (
			 cod_oferta_curso int(11) auto_increment,
			 cod_curso int(11),
			 cod_endereco_instituicao_ensino int(11),
			 constraint pk_oferta_curso primary key (cod_oferta_curso),
			 constraint fk_curso foreign key (cod_curso) references curso (cod_curso),
			 constraint fk_of_instituicao_ensino foreign key (cod_endereco_instituicao_ensino) references endereco_instituicao_ensino (cod_endereco_instituicao_ensino));
			 
create table pessoa (
			 cod_pessoa int(11) auto_increment,
			 primeiro_nome_pessoa varchar(15) not null,
			 nome_meio_pessoa varchar(100) not null,
			 ultimo_nome_pessoa varchar(15) not null,			 
			 constraint pk_pessoa primary key (cod_pessoa));

create table email (
			 cod_email int(11) auto_increment,
             email varchar (100) not null,
			 cod_pessoa int(11),
             constraint pk_email primary key (cod_email),
             constraint fk_pessoa foreign key (cod_pessoa) references pessoa (cod_pessoa));

create table tipo_autor (
			 cod_tipo_autor int(11) auto_increment,
			 desc_tipo_autor varchar(50) not null,
			 constraint pk_tipo_autor primary key (cod_tipo_autor));
			 
create table autor (
			 cod_autor int(11) auto_increment,
             local_arq_autorizacao_autor varchar (200),		
			 cod_tipo_autor int(11),
			 cod_oferta_curso int(11),
			 cod_pessoa int(11),
			 nome_arq_autorizacao_autor varchar (45),
			 constraint pk_autor primary key (cod_autor),
			 constraint fk_tipo_autor foreign key (cod_tipo_autor) references tipo_autor (cod_tipo_autor),
			 constraint fk_oferta_curso foreign key (cod_oferta_curso) references oferta_curso (cod_oferta_curso),
			 constraint fk_aut_pessoa foreign key (cod_pessoa) references pessoa (cod_pessoa));
			 
create table tipo_trabalho (
			 cod_tipo_trabalho int(11) auto_increment,
			 desc_tipo_trabalho varchar(30) not null,
			 constraint pk_tipo_trabalho primary key (cod_tipo_trabalho));			 
			 
create table trabalho (
			 cod_trabalho int(11) auto_increment,
			 titulo_trabalho varchar (250) not null,
			 ano_trabalho year(4) not null,
			 resumo_trabalho longtext,
			 local_arq_trabalho varchar (200) not null,
			 nome_arq_trabalho varchar (30) not null,
			 cod_t_trabalho int(11),
             constraint pk_trabalho primary key (cod_trabalho),
             constraint fk_t_trabalho foreign key (cod_t_trabalho) references tipo_trabalho (cod_tipo_trabalho));

create table palavra_chave (
			 cod_palavra_chave int(11) auto_increment,
             palavra_chave varchar (50) not null,
             constraint pk_palavra_chave primary key (cod_palavra_chave));
			 
create table palavra_chave_trabalho (
             cod_palavra_chave int (11),
			 cod_trabalho int(11),
             constraint pk_palavra_chave_trabalho primary key (cod_palavra_chave,cod_trabalho),
			 constraint fk_palavra_chave foreign key (cod_palavra_chave) references palavra_chave (cod_palavra_chave),
			 constraint fk_palavra_chave_trabalho foreign key (cod_trabalho) references trabalho (cod_trabalho));

create table publicacao (
             cod_autor int (11),
			 cod_trabalho int(11),
             constraint pk_publicacao primary key (cod_autor,cod_trabalho),
			 constraint fk_autor foreign key (cod_autor) references autor (cod_autor),
			 constraint fk_trabalho foreign key (cod_trabalho) references trabalho (cod_trabalho));
			 