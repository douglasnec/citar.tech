# rodar composer install na raiz do projeto
composer install
# criar um banco de dados no seu mysql
# abrir arquivo na raiz ".env" e definir dados de conexão com o banco
# rodar a migração
php artisan migrate
# rodar os seeds
php artisan db:seed 

# iniciar app
php artisan serve

# rodar testes na raiz do projeto
vendor\bin\phpunit