# projeto-restaurante

Projeto que realiza registro de usuário, login e logout e gerenciamento das informações de restaurante, cardápios e produtos utilizando a REST API: https://github.com/karoldiasb/api-projeto-restaurante.

## Instalação do ambiente
```
docker-compose build
```
```
docker-compose up -d
```
## Dar permissão ao usuário (caso seja terminal linux)
```
sudo chown -R user:user ./
```

## Para entrar no docker
```
docker exec -it projeto-restaurante-php bash
```

## Instalar dependências
```
composer install (dentro do docker)
```

## Copie o arquivo ".env.example", cole na raiz do projeto e renomeie para ".env"

## Configuração do ambiente
#### Geração da APP_KEY
```
php artisan key:generate (dentro do docker)
```

## Acesse em:
```
http://localhost:8082/restaurantes
```
