<p align="center"><img src="https://github.com/user-attachments/assets/23281aee-e729-42bb-b768-b242547ffac4" width="400">
</p>

# Requirements
- composer
- MySql databse

# How to use
1. copy .env.example paste jadi .env
2. bikin database di MySql
3. setup database credentials di .env, tulis nama DB yang tadi dibuat di .env
4. run composer install di terminal
5. run php artisan key:generate
6. run php artisan migrate
7. run php artisan db:seed buat ngepopulasi database dengan data dummy
8. run php artisan serve untuk menjalankan web
