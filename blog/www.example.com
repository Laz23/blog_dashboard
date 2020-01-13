<VirtualHost *:80>
    ServerName www.example.com
    ServerAlias example.com
    ServerAdmin webmaster@example.com
    DocumentRoot /var/www/html/www.example.com
   ProxyPassMatch ^/(.*\.php(/.*)?)$ unix:/run/php/php7.3-fpm.sock|fcgi://localhost/var/www/html/www.example.com/


    CustomLog ${APACHE_LOG_DIR}/www.example.com-access.log combined
    ErrorLog ${APACHE_LOG_DIR}/www.example.com-error.log

    <Directory /var/www/html/www.example.com>
        Options All
        AllowOverride None
    </Directory>

   <Directory /var/www/html/www.example.com/top_secret>
    AuthType Basic
    AuthName “Accès restreint aux utilisateurs authentifiés”
    AuthBasicProvider ldap
    AuthLDAPURL ldap://localhost/ou=Personnes,dc=mon-entreprise,dc=com?uid?sub
    Require ip 192.168.0.3
    Require valid-user
   </Directory>
</VirtualHost>
