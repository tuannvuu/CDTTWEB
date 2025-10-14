web: bash -c "mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache && php -S 0.0.0.0:8080 -t public"
post-deploy: mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache && chmod -R 775 storage/framework bootstrap/cache
