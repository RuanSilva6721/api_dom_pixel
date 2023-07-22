-- Cria um novo usuário
CREATE USER "RuanFelipe" WITH PASSWORD 'password';

-- Cria um novo banco de dados e atribui permissões ao usuário
CREATE DATABASE your_database;
GRANT ALL PRIVILEGES ON DATABASE your_database TO "RuanFelipe";

-- Cria o banco de dados "dom_pixel"
CREATE DATABASE dom_pixel;
