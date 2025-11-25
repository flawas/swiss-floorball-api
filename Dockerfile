FROM wordpress:latest

# Copy the current directory (plugin files) to the WordPress plugins directory
COPY . /var/www/html/wp-content/plugins/swiss-floorball-api
