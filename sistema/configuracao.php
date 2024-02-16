<?php

//Arquivo de configuração do sistema
//define o fuso horario

use sistema\Nucleo\Helpers;

date_default_timezone_set('America/Sao_Paulo');


//informações do sistema
define('SITE_NOME', 'ATHORIUS');
define('SITE_DESCRICAO', 'ARTHORIUS - Tecnologias');

//urls do sistema
define('URL_PRODUCAO', 'https://unset.com.br');
define('URL_DESENVOLVIMENTO', 'http://localhost/arthorius');

if (Helpers::localhost()) {
    //dados de acesso ao banco de dados
    define('DB_HOST', 'localhost');
    define('DB_PORTA', '3306');
    define('DB_NOME', 'posts');
    define('DB_USUARIO', 'root');
    define('DB_SENHA', '');
    
    define('URL_SITE', 'arthorius/');
    define('URL_ADMIN', 'arthorius/admin/');
}else {
    //dados de acesso ao banco de dados na hospedagem
    define('DB_HOST', 'localhost');
    define('DB_PORTA', '3306');
    define('DB_NOME', '');
    define('DB_USUARIO', '');
    define('DB_SENHA', '');

    define('URL_SITE', '/');
    define('URL_ADMIN', '/admin/');
}

//autenticação do servidor de emails
define('EMAIL_HOST', 'smtp.gmail.com');
define('EMAIL_PORTA', '465');
define('EMAIL_USUARIO', 'josetadeu33217610@gmail.com');
define('EMAIL_SENHA', 'pywzxdzggruasrku');
define('EMAIL_REMETENTE', ['email' => EMAIL_USUARIO, 'nome' => SITE_NOME]);