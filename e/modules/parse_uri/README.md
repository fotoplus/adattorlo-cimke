# Az URI feldolgozása

Az oldal URI feldolgozását a PHP végzi, azaz ha az URI nem egy fájlra vezet, akkor az egész át van adva az index.php-nek, de a feldolgozást a parse_uri.php végzi.
Abban az esetben, ha az oldal nem a dokuemntum-gyökérben van, azaz nem saját domainen van, akkor figyelmen kívül kell hagynunk az URI azon részeit amik csak elérési útként szolgálnak az oldalhoz. Ha példul a valami.hu/mappa/ezaz az elérési utunk, akkor az érték 2, azaz 2 mappával beljebbről indulunk. Ha az oldal saját domainen van, akkor az érték 0;

A [.htaccess](/.htaccess) fájlban megadott `RewriteBase` -nek összhangban kell lennie a [config.php](/e/config/config.php) `URI_IGNORE` értékével.

~~~htaccess
RewriteEngine On
RewriteBase "/"
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule !^index\.php$ index.php
~~~
~~~php
define("URI_IGNORE", 4);
~~~
~~~php
$_SERVER['REQUEST_URI_PATH'] = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
$segments = explode('/', trim($_SERVER['REQUEST_URI_PATH'], '/'));
$segments = array_slice ($segments, URI_IGNORE);
~~~



