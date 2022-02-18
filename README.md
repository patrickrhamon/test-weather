## Abaout this project
<p>Laravel v9.1.0 (PHP v8.1.0)</p>
<p>Copy and Paste de .env.exemple and rename to .env</p>
<p>This project uses Laravel Passport to create user authentication and use database SQLite.</p>
<p>Run commad: php artisan migrate</p>
<p>Run commad: php artisan passport:install --uuids</p>

<p>Routes:</p>
<p>[GET] / = Default route laravel</p>
<p>[GET] /info = show PHP Info</p>
<p>[GET] /api/weather = route return weather by ip (if authenticated save the IP in the user)</p>
<p>[POST] /api/user = create a user</p>











Publicar no github, de forma pública, o seguinte projeto em laravel:

ok- Uma rota não autenticada onde, através da geolocalização do ip do usuário deverá consultar uma api de previsão de tempo para a cidade do mesmo. O retorno da requisição deverá estar no padrão jsonapi;
ok - Adicionar à model User um atributo referente ao último ip e criar um command que rode todo dia às 07hs de America/Sao_Paulo e mande por e-mail a previsão do tempo. O Layout do e-mail é irrelevante para o teste;
- Para cada ação de envio de previsão, seja por consulta http ou command, o sistema deverá registrar os resultados em uma tabela de logs utilizando escuta de eventos;
- Uma rota para consulta das últimas previsões para o determinado usuário.

Obs: Não é preciso se preocupar com banco de dados, o objeto de análise será a estrutura de código e padrões utilizados. Caso queira subir o projeto com DB funcional pode utilizar um sqlite.