# API Appliance

Teste em Laravel.

```bash
php: 8.1
laravel: 10
```


## Iniciando

Clone o projeto, usando o comando abaixo (usando HTTPS):

```bash

git clone https://github.com/RuanSilva6721/api-appliance.git
```



Depois de clonar, acesse o repositório e instale as dependências com os comandos abaixo (para isso, utilize o [Composer](https://getcomposer.org/) ):

```bash

cd api-appliance
composer install
```



Após instalar as dependências, duplique o arquivo `.env.example` e renomeie um deles para `.env`.

Gere uma nova chave da aplicação:

```bash

php artisan key:generate
```



Altere as configurações no arquivo `.env` para que o projeto se conecte ao banco de dados.


Execute o comando abaixo para que as tabelas sejam criadas no banco de dados:

```bash

php artisan migrate
```



Inicie o servidor da aplicação com o comando:

```bash

php artisan serve
```



Para ver o projeto em execução, acesse [http://localhost:8000](http://localhost:8000/) .

Caso queira adicionar dados fictícios para o seu usuário no banco:

```bash

php artisan db:seed --class=BrandSeeder & php artisan db:seed --class=ProductSeeder
```



Caso queira fazer testes unitário e de integração:

```bash

php artisan test
```



**Caso queira rodar em Docker, utilize o comando:** 

Inicie o Docker em sua máquina e depois execute para subir o container da aplicação e subir o db postgres:

```bash

cd docker-compose up -d
```

Veja se o container da aplicação e o db postgres estão de pé:

```bash

docker ps
```
Caso não, execute:

```bash

docker-compose restart
```

Para ver o projeto em execução, acesse [http://localhost:9003](http://localhost:9003/) .

Você deve mudar a conexão do banco no `.env` para o banco de sua preferência. Eu adicionei um container como banco PostgreSQL:

```makefile

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=appliance
DB_USERNAME=RuanFelipe
DB_PASSWORD=password
```



Para acessar o container da aplicação, execute:

```bash

docker-compose exec -it [container da aplicação] bash
```

Instale as dependências com os comandos abaixo:

```bash
composer install
```

Execute o comando abaixo para que as tabelas sejam criadas no banco de dados:

```bash

php artisan migrate
```


Caso queira adicionar dados fictícios para o seu usuário no banco:

```bash

php artisan db:seed --class=BrandSeeder & php artisan db:seed --class=ProductSeeder
```



Caso queira fazer testes unitários e de integração:

```bash

php artisan test
```


## Rotas

A API disponibiliza as seguintes rotas:

- `GET /applianceBrand`: Retorna a lista de todas as marcas de eletrodomésticos cadastradas. 
- `GET /applianceBrand/{id}`: Retorna os detalhes de uma marca de eletrodoméstico específica. 
- `POST /applianceBrandCreate`: Cria um novo registro de marca de eletrodoméstico. 
- `PUT /applianceBrand/{id}`: Atualiza uma marca de eletrodoméstico existente. 
- `DELETE /applianceBrand/{id}`: Remove uma marca de eletrodoméstico existente. 
- `GET /applianceProduct`: Retorna a lista de todos os produtos de eletrodomésticos cadastrados. 
- `GET /applianceProduct/{id}`: Retorna os detalhes de um produto de eletrodoméstico específico. 
- `GET /applianceProductOfBrand/{id}`: Retorna os produtos de eletrodomésticos de uma determinada marca. 
- `POST /applianceProductCreate`: Cria um novo registro de produto de eletrodoméstico. 
- `PUT /applianceProduct/{id}`: Atualiza um produto de eletrodoméstico existente. 
- `DELETE /applianceProduct/{id}`: Remove um produto de eletrodoméstico existente.

## Exemplo de Payload de Product

```json
{
    "id": 4,
    "name": "accusamus",
    "description": "Sequi et in est beatae.",
    "voltage": "110v",
    "brand_id": 2,
    "created_at": "2023-06-17T01:13:32.000000Z",
    "updated_at": "2023-06-17T01:13:32.000000Z"
}
```

## Exemplo de Payload de Brand

```json
{
    "id": 4,
    "name": "Philips",
    "icon": "movie",
    "created_at": "2023-06-17T01:13:06.000000Z",
    "updated_at": "2023-06-17T01:13:06.000000Z"
}
```
## Construído com 
- [Laravel](https://laravel.com/)
