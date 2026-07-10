# Usa a imagem oficial do PHP com Apache integrado
FROM php:8.2-apache

# Copia os arquivos do seu projeto para o diretório padrão do Apache
COPY ./index.php /var/www/html/

# Cria o arquivo de status inicial para evitar erros de permissão
RUN touch /var/www/html/led_status.txt

# Define o dono dos arquivos como o usuário do Apache (www-data) 
# para que o PHP consiga alterar o arquivo de texto
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

# Expõe a porta 80 do container
EXPOSE 80
