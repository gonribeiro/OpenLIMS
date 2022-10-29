# Open LIMS
## Projeto em Construção

## 🚴 Sobre

LIMS (Laboratory information management system) é um sistema de gerenciamento de informações com recursos que suportam as operações de um laboratório.

Open LIMS surgiu como uma solução de código aberto com o intuito de apoiar a comunidade que atua na área da química e afins oferecendo uma solução gratuita para gerenciar seu laboratório de pesquisa / produção.

## 🚀 Tecnologias

- [Laravel](https://laravel.com/)

## 🔖 Layout

Em breve

## 📝 Desafios e recursos

Este projeto tem um desafio em especial. Fornecer uma implementação em API que possa ser utilizada por um projeto frontend dedicado e a mesma implementação sendo fornecida para a camada de <a href="https://laravel.com/docs/master/blade" target="_blank" rel="noopener noreferrer">visualização do próprio Laravel</a>.

- Mas, por que? E qual é a diferença?

Digamos que você é um desenvolvedor experiente e possui conhecimentos em diversas linguagens ou frameworks incluindo a de frontend ou possui uma equipe capacitada a lidar com desafios. Provavelmente você deve querer oferecer a melhor experiência de usuário possível para o seu cliente disponibilizando a ele acessos ao sistema via SPA e/ou Mobile. Neste caso, a API é recomendada. (<a href="https://github.com/Honokai/open_lims" target="_blank" rel="noopener noreferrer">Existe um projeto web em desenvolvimento utilizando Next.JS</a>).

Agora digamos que você é o único(a) TI do seu laboratório. Sabemos bem como é desafiador manter tudo funcionando e um LIMS ajudaria muito a sua instituição. Entretanto, a aquisição de um sistema é caro e lhe resta apenas desenvolver um próprio. Ter um projeto construído em uma mesma linguagem que requer uma única infraestrutura para o seu funcionamento é muito mais fácil para se manter e atualizar. Neste caso, o MVC é a sua solução.

O grande motivo desse projeto ser desenvolvido em Laravel é devido ao framework ser poderoso para atender ao seu negócio, possuir uma linguagem de fácil aprendizado e uma documentação que "só falta pegar você no colo e te carregar para onde desejar, rs".

- Etapas:
    - ☑️ Métodos implementados para API
    - 🔳 Métodos implementados para MVC
    - 🔳 Validações dos Request
    - 🔳 Testes automatizados de backend
    - 🔳 Swagger
    - 🔳 FrontEnd do MVC
    - 🔳 Testes automatizados do frontend MVC
    - 🔳 Logs
    - 🔳 Emails
    - 🔳 Login
    - 🔳 ...

- Recursos:
    - Usuários
    - Amostras e sub amostras (alíquotas)
    - Análises (tipos de análises realizadas pelo laboratório)
    - Testes e resultados
    - Custódia e localização das amostras
    - Incidentes e Não conformidades
    - ...

## ⚡ Requisitos e Instalação
    - PHP 8.0+
    - MariaDB 10.5+
- Faça uma cópia do projeto e acesse a pasta
```
git clone https://github.com/gonribeiro/OpenLIMS.git

cd OpenLIMS
```
- Faça uma cópia do arquivo .env.example renomeando para .env
- Informe as configurações do seu banco de dados alterando conforme o necessário
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=openlims
DB_USERNAME=root
DB_PASSWORD=
```
- Instale
```
composer install
```
- Crie as tabelas do banco de dados (se desejar, semeia as tabelas com dados falsos)
```
php artisan migrate

php artisan db:seed # opcional
```
- Execute
```
php artisan serve
```

- O projeto ficará disponível pelo endereço: http://localhost:8000/
    - Na pasta .github há o arquivo "OpenLIMS_Insomnia.json". Este arquivo contém todos os parâmetros e chamadas da API. Com ele poderá conhecer o funcionamento e testar o que está implementado até o momento (em breve o Swagger será implementado disponibilizando uma documentação adequada para o projeto).
    - Documentação API com Swagger em construção: http://localhost:8000/api/docs
