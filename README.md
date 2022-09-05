# Laravel Opportunities

# Tecnologias Utilizadas

- Php
- Laravel
- Mysql
- Docker

# Requisitos

- Php 8
- Composer
- Docker

# Instalação

- No Terminal rodar o comando:

```sh
composer install --ignore-platform-reqs
```

- Apos instalar as dependencias utilizaremos o Laravel Sail (uma interface de linha de comando para o Docker)
- Verifique se a env esta configurada pois o Sail builda o container utilizando as variaveis da env (vou estar subindo a env com uma configuração padrao para facilitar o setup)
- No Terminal rodar o comando:

```sh
./vendor/bin/sail up -d
```

- Acessar o bash do container:

```sh
./vendor/bin/sail exec laravel.test bash
```

- Para garantir que as dependencias estejam atualizadas de acordo com o container eu gosto de rodar o comando de instalação das dependencias dentro do container sem a necessidade do --ignore-platform-reqs

```sh
composer install 
```

ou

```sh
composer update 
```

- Apos finalizar a instalação, rodar o comando de criação das tabelas do banco junto com as seeds

```sh
php artisan migrate --seed
```

- Para simular a importação, deixei um arquivo csv com os dados requeridos para os testes.
- Disponibilizei a collection do postman contendo a rota para importar

- A rota para importação é:

```
Post localhost/api/v1/freights/import
```

- Como campos obrigatorios ela tem o client_id, que é o id de um cliente cadastrado no sistema (ao rodar as seeds do sistema anteriormente foram cadastrados 2 clientes, com os ids 1 e 2 respectivamente), e o attachment, que é o arquivo csv a ser importado.

- Apos enviar a requisição, por motivos de otimização do sistema, a importação foi colocada em uma fila.

- Para executar a fila, acesse o terminal e execute o comando:

```sh
php artisan queue:work
```

ou, caso esteja fora do bash do container

```sh
./vendor/bin/sail php artisan queue:work
```

- Pronto, os jobs começarão a serem executados e a importação sera iniciada.
