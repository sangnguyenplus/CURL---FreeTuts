### This repo use to get all posts from http://freetuts.net with Laravel > 4.2

####- Step 1: Copy all code to your projects

####- Step 2: Autoload "simple_html_dom.php" in composer.json
```
"files": [
  "app/Helpers/simple_html_dom.php"
]
```
####- Step 3: Run migrate to create posts table
```
php artisan migrate
```
