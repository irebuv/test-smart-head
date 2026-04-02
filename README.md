# Test assignment for Smart Head

Laravel v.12 + Bootstrap + spatie for permissions/media 

# How to install

1. Clone the repository
2. Copy env.example and change values to yours (Database)
3. Up docker containers: docker compose up -d --build

# Install dependencies + add app key + make migrations + symlink

4. docker compose exec backend composer install
5. docker compose exec backend php artisan key:generate
6. docker compose exec backend php artisan migrate:fresh --seed
7. docker compose exec backend php artisan storage:link

# Users (other data create with seeds)

Admin:

- email: admin@mail.com
- password: password

Manager:

- email: manager@mail.com
- password: password

# Example for iframe

<iframe src="http://your-domain.com/widget" height="820" width="500"></iframe>

# Api examples

### Create ticket for iframe

POTS /api/tickets ()
- `name`
- `number`
- `email`
- `theme`
- `description`
- `files[]`

### Statistic for tickets

GET /api/tickets/statistic
{
  "data": {
    "day": 3,
    "week": 12,
    "month": 25
  }
}
