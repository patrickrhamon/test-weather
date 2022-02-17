## Abaout this project
<p>Laravel v9.1.0 (PHP v8.1.0)</p>
<p>Copy and Paste de .env.exemple and rename to .env</p>
<p>This project uses Laravel Passport to create user authentication and use database SQLite.</p>
<p>Run commad: php artisan migrate</p>
<p>Run commad: php artisan passport:install --uuids</p>

<p>Routes:</p>
[GET] / = Default route laravel
[GET] /info = show PHP Info
[GET] /api/weather = route return weather by ip (if authenticated save the IP in the user)
[POST] /api/user = create a user