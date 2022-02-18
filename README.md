## Abaout this project
<p>Laravel v9.1.0 (PHP v8.1.0)</p>
<p>Copy and Paste de .env.exemple and rename to .env</p>
<p>This project uses Laravel Passport to create user authentication and use database SQLite.</p>
<p>Create a file in database/database.sqlite</p>
<p>Run commad: php artisan migrate</p>
<p>Run commad: php artisan passport:install --uuids</p>

<p>Routes:</p>
<p>[GET] / = Default route laravel</p>
<p>[GET] /info = show PHP Info</p>
<p>[GET] | accept-Token: /api/weather = route return weather by ip (if authenticated save the IP in the user)</p>
<p>[GET] | requered-Token: /api/user/weathers = return list of log event of user</p>
<p>[POST]: /api/user = create a user</p>
<p>[POST]: /api/login = login a user</p>
<p>[POST] | requered-Token: /api/logout = logout a user</p>



<p>Inside this project has a Insominia.json with all routes created for this project.</p>