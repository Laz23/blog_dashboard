<VirtualHost *:80>
    ServerName www.example.com
    ServerAlias example.com
    ServerAdmin webmaster@example.com
    DocumentRoot /var/www/html/www.example.com

    CustomLog ${APACHE_LOG_DIR}/www.example.com-access.log combined
    ErrorLog ${APACHE_LOG_DIR}/www.example.com-error.log

    <Directory /var/www/html/www.example.com>
        Options All
        AllowOverride None
    </Directory>
</VirtualHost>
