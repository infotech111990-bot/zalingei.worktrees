FROM bitnami/laravel:latest
COPY . /app
WORKDIR /app

# إنشاء مجلدات الكاش والـ Views المفقودة وتعيين الصلاحيات
RUN mkdir -p /app/storage/framework/views \
    && mkdir -p /app/storage/framework/cache/data \
    && mkdir -p /app/storage/framework/sessions \
    && chmod -R 777 /app/storage /app/bootstrap/cache

RUN composer install --no-dev --optimize-autoloader

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]