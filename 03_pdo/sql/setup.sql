create table tecnologias (
    -> id INT auto_increment primary key,
    -> nome varchar(100) not null,
    -> categoria varchar(50) not null,
    -> descricao text,
    -> ano_criacao int,
    -> criado_em timestamp default current_timestamp);

INSERT INTO tecnologias (nome, categoria, descricao, ano_criacao) VALUES
    -> ('HTML',       'Frontend',  'Linguagem de marcação para estrutura de páginas web.', 1993),
    -> ('CSS',        'Frontend',  'Linguagem de estilos para apresentação visual de páginas.', 1996),
    -> ('PHP',        'Backend',   'Linguagem server-side amplamente usada para web dinâmica.', 1994),
    -> ('MariaDB',    'Banco de Dados', 'Sistema de gerenciamento de banco de dados relacional open-source.', 2009),
    -> ('JavaScript', 'Frontend',  'Linguagem de programação para interatividade no navegador.', 1995),
    -> ('Git',        'DevOps',    'Sistema de controle de versão distribuído.', 2005);