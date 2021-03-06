# API - Tecnologia utilizada

- Framework Laravel: 8

- JWT-AUTH: 1.0

## Versão do PHP

- Compatível com a versão 7.3 ou superior

## Versão do Mysql

- Utilizada versão 5.7 ou superior

## 1 - Instalação

Fazendo build da aplicação.

Na raiz do projeto:
```
$composer install
```

Gerar chave secreta
```
$php artisan jwt:generate
```
Adicionar os arquivos com as configurações do banco: config/database.php

Permissão 777 em todo diretório storage:
```
$cd /var/www/html/seudiretorio
```
```
$chmod -R 777 storage
```
## 2 - Configuração

As tabelas da base de dados da API são criadas através de migrations e populadas pelas seeds.

Após certificar que a conexão com o banco está correta, executar as migrations:
```
$php artisan migrate
```
Para realizar o dump do arquivo autoload, execute o comando:
```
$composer dump-autoload
```
Para executar as seeds, execute o comando:
```
$php artisan db:seed
```
Para inicializar o servidor php, execute o comando:
```
$php artisan serve
```
Por padrão o servidor PHP será inicializado na porta :8000 do servidor local.

Com isso a API está instalada.

## endpoints disponíveis para teste

###### Login

    method: POST
    url: http://localhost:8000/api/auth/login
    body: form-data
    e-mail: admin@admin.com
    senha: desafio01
