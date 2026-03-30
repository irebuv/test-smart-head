# Test assignment for Smart Head

Laravel v.12 + Bootstrap

# How to install

1. Clone the repository
2. Copy env.example and change values to yours (Database)
3. Up docker containers: docker compose up -d --build

# Install dependencies + add app key + make migrations + symlink 

4. docker compose exec backend composer install
5. docker compose exec backend php artisan key:generate
6. docker compose exec backend php artisan migrate
7. docker compose exec backend php artisan storage:link

