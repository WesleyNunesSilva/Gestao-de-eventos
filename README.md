# Projeto Gestão de Eventos

O projeto Gestão de Eventos foi desenvolvido para facilitar o gerenciamento de eventos, permitindo organizadores e participantes realizar inscrições, administrar pagamentos e visualizar relatórios financeiros de forma eficiente.

### Tecnologias Utilizadas:

O projeto é construído utilizando o framework Laravel para o backend, juntamente com Docker para facilitar a criação e gestão de ambientes de desenvolvimento. A interface utiliza Bootstrap para garantir um design responsivo 

## Pré-requisitos

Certifique-se de ter os seguintes requisitos instalados na sua máquina:

- Docker: [Instalação do Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Instalação do Docker Compose](https://docs.docker.com/compose/install/)

## Clonando o Projeto

Para clonar o repositório, execute o seguinte comando:

```bash
git clone git@github.com:WesleyNunesSilva/Gestao-de-eventos.git
```
## Configuração Inicial

1. Acesse o diretório do projeto clonado:

   ```bash
   cd Gestao-de-eventos
   ```
2. Crie um arquivo `.env`baseado no `.env.example`

   ```bash
   cp .env.example .env
    ```
3. Faça a instalação do sail:

   ```bash
   composer require laravel/sail --dev
    php artisan sail:install
    ```
## Executando o Projeto

Para iniciar o projeto, siga os passos abaixo:

1. Inicie os contêineres Docker:

   ```bash
   ./vendor/bin/sail up
    ```

2. Execute as migrações do banco de dados e os seeders, se aplicável:

   ```bash
   ./vendor/bin/sail artisan migrate
   ./vendor/bin/sail artisan db:seed
   ```
3. O aplicativo estará disponivel em `http://localhost`.
   


