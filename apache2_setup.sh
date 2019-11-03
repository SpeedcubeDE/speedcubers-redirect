#!/bin/bash
parent_path=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )
ln -s "${parent_path}/www" /var/www/speedcubers_redirect
echo "
<VirtualHost *:80>
        ServerName speedcubers.de
        ServerAlias speedcubers.speedcube.de
        DocumentRoot /var/www/speedcubers_redirect
</VirtualHost>
" > /etc/apache2/sites-available/speedcubers-redirect.conf
a2ensite speedcubers-redirect
