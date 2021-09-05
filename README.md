# projeto-restaurante

Projeto que realiza registro de usuário, login e logout e gerenciamento das informações de restaurante, cardápios e produtos utilizando a REST API: https://github.com/karoldiasb/api-projeto-restaurante.

## Instalação do ambiente
```
docker-compose up --build -d
```

```
composer install (dentro do docker)
```

## Configuração do ambiente
#### Geração da APP_KEY
```
php artisan key:generate (dentro do docker)
```

## Copie o arquivo ".env.example", cole na raiz do projeto e renomeie para ".env"


## Acesse em:
```
http://localhost:8082/restaurantes
```
