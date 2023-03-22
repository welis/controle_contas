-- criar tabela bancos
CREATE TABLE bancos (
  id_banco INT NOT NULL AUTO_INCREMENT,
  nome_banco VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_banco)
);

insert into bancos (nome_banco) values ('Banco do Brasil');
insert into bancos (nome_banco) values ('Bradesco');


-- criar tabela conta categoria
CREATE TABLE conta_categoria (
  id_conta_categoria INT NOT NULL AUTO_INCREMENT,
  nome_conta VARCHAR(50) NOT NULL,
  tipo VARCHAR(1) NOT NULL,
  PRIMARY KEY (id_conta_categoria)
);

insert into conta_categoria (nome_conta, tipo) values ('Salario', '1');
insert into conta_categoria (nome_conta, tipo) values ('Aluguel', '0');

-- criar tabela contas
CREATE TABLE contas (
  id_conta INT NOT NULL AUTO_INCREMENT,
  data_cad DATETIME NOT NULL,
  id_conta_categoria INT NOT NULL,
  tipo VARCHAR(1) NOT NULL,
  valor DECIMAL(10,2) NOT NULL,
  id_banco INT NOT NULL,
  compensado VARCHAR(1) NOT NULL,
  PRIMARY KEY (id_conta),
  FOREIGN KEY (id_banco) REFERENCES bancos(id_banco),
  FOREIGN KEY (id_conta_categoria) REFERENCES conta_categoria(id_conta_categoria)
);


insert into contas (data_cad, id_conta_categoria, tipo, valor, id_banco, compensado) values ('2018-01-01 00:00:00', 1, '1', 1000, 1, '1');

--apagar todas as informações da tabela
delete from contas;

--somar colunas
select sum(valor) from contas;

select sum(valor) from contas where tipo = 0;

