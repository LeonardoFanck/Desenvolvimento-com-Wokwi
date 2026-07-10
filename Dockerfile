# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Altera a porta padrão do Apache de 80 para 8080 (Exigência do Fly.io)
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Copia o seu index.php para o diretório do servidor web
COPY ./index.php /var/www/html/

# Cria o arquivo onde o status do LED será salvo
RUN touch /var/www/html/led_status.txt

# Dá permissão para o PHP ler e escrever nesse arquivo
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 775 /var/www/html/

# Expõe a porta 8080
EXPOSE 8080
