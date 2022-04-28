<p align="center"><a href="#" target="_blank"></a>AGROCALLIDOS</p>

## Descrição

<p>Aqui sera listado os requisitos necessários, o gia de instalação do programa, e fluxo de atividade.</p>

## Lista de requisitos
Logo abaixo será listado os requisitos necessários para instalação do programa.

- [PHP ^8 ou ^7.3](https://www.apachefriends.org/pt_br/download_success.html).
- [Mysql](https://www.apachefriends.org/pt_br/download_success.html).
- [Home Assistant](https://www.home-assistant.io/).

## Guia de instalação
- [Instalação Home Assistant](https://www.home-assistant.io/installation/).
- [Instalação do Mysql no Home Assistant](https://www.home-assistant.io/integrations/recorder/).
- Clone o repositorio do projeto no diretorio raiz do projeto.
``` bash    
    git clone https://github.com/iotnoagro/IoT-no-Agro.git
```
- Baixa todos as dependencias do projeto.
``` bash    
    composer install 
```
- Criar .env.
``` bash    
    cp .env-example .env 
```
- Altere os valores de conexão com o banco de dados do arquivo `.env`
### OBS: Todos os valores devem ser inseridos de acorco com o que foi colocado no <a href="https://www.home-assistant.io/integrations/recorder/" target="_blank">Home Assistant</a>.
```env
  DB_CONNECTION=mysql
  DB_HOST=host
  DB_PORT=3306
  DB_DATABASE=dbname
  DB_USERNAME=dbuser
  DB_PASSWORD=dbpass
```
### OBS: conando abaixo, recomendavel no terminal git bash
- Adiciona todas as permissões na pasta storage.
``` bash    
    $ chmod -R 777 storage
```
- Gera a chave da aplicação.
``` bash    
    $ php artisan key:generate
```
- Cria um link simbólico entre as pastas /public/storage -> /storage/app/public.
``` bash    
    $ php artisan key:generate
```
- Agora execute as migrations.
``` bash    
    $ php artisan migrate
```
- Criar clientes do Laravel Passport <a href="https://laravel.com/docs/8.x/passport" target="_blank">(Saiba mais)</a>.
``` bash    
    $ php artisan passport:install
```

### Detro do arquivo .env possui o seguinte conteudo:

``` env 
    PASSPORT_PERSONAL_ACCESS_CLIENT_ID= "CLIENT_ID"
    PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET= "CLIENT_SECRET"
```

- Subistitua os valores de acordo os <b>"CLIENT_ID"</b> e <b>"CLIENT_SECRET"</b>. pelos valores que você recebeu ao rodar o comando <b>php artisan passport:install</b>.



## Fluxo de atividade

O fluxo de atividades segui o seguinte padrão:
- Fazer o cadastro das <b>Medidas</b>
- Fazer o cadastro da <b>Proiedade</b>
- Fazer o cadastro da <b>Contatos</b>
- Fazer o cadastro do <b>Usuário</b>


## Licença
- [Apache License 2.0](https://choosealicense.com/licenses/apache-2.0/).
