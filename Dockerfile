FROM bitnami/laravel:latest

# التحويل لمستخدم root لتنفيذ صلاحيات الإنشاء والتعديل
USER root

# نسخ ملفات المشروع
COPY . /app
WORKDIR /app

# إنشاء مجلدات الكاش والـ Views وتحديد الصلاحيات
RUN mkdir -p /app/storage/framework/views \
    && mkdir -p /app/storage/framework/cache/data \
    && mkdir -p /app/storage/framework/sessions \
    && mkdir -p /app/bootstrap/cache \
    && chown -R 1001:root /app/storage /app/bootstrap/cache \
    && chmod -R 777 /app/storage /app/bootstrap/cache

# تثبيت الحزم
RUN composer install --no-dev --optimize-autoloader

# العودة للمستخدم الآمن لـ Bitnami
USER 1001

EXPOSE 8000

# تشغيل migrations قبل بدء Laravel لضمان إنشاء الجداول المطلوبة في Railway
CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]
