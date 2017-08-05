all:
	composer install
	valet link homestead-control
	cp .env.example .env
	php artisan key:generate
