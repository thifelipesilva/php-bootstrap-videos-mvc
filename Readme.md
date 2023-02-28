#SK8Play

Projeto em php utilizando a arquitetura mvc, onde é possivel cadastrar um video com um titulo e uma imagem, porém é necessario fazer login para realizar essa ação.

Foram aplicados conceitos importantes como:
orientação a objetos, 
Padrao de repositiorio, 
SQL, 
PDO, 
Outputbuffer, 
autenticao, 
seguranca, 
sessões,
injeção de dependencia - psr11,
traits - herança horizontal
PSR's
Template Engine

pacotes utilizados:
psr/http-message - 1.0,
nyholm/psr7 - 1.5,
nyholm/psr7-server - 1.0,
psr/http-server-handler - 1.0,
league/plates - 3.5,
psr/container - 2.0,
php-di/php-di - 7.0

Para rodar:
git clone https://github.com/thifelipesilva/php-bootstrap-videos-mvc.git 
composer install
php -S localhost:7000 -t public/
