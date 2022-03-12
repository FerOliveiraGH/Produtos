## Software para cadastro de produtos.
- Este software tem como objetivo implementar o modelo Clean Architecture no framework Laravel 8.0.

### Pacotes
 - PHP 7.4
 - Laravel 8.0
 - Composer 2

### Estrutura
    - app
        - Business (UseCases)
            - Products
        - Domain (Entities)
            - Products
        - Http (Infra)
            - Controllers
            - Repositories
            - Models

### Instalar
    - composer run-script install
    - php artisan serve

### Padrão Estrutural

![](docs/imgs/produtos.png)

Fernando Oliveira - [feroliveira.com.br](http://feroliveira.com.br)