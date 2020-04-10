## Get Started
- composer install
- npm install
- sudo cp .env.example .env
- php artisan key:generate

## Feature
- CRUD API GENERATOR
- ROUTE LIST
- Faker Factory

### CRUD API GENERATOR
- `php artisan generate:crud {name}`, The name should be like the table of migration you made, singular and used PascalCase, ex:NewTransaction
- edit the model where its generated. fill the fillable column and the relation table.
- edit the controller validation if u need it.

### ROUTE LIST
- route can be see on localhost:8000/routes

### FAKER FACTORY
- make seeder using this command `php artisan make:seeder {name}`
- make factory file on this path `database/Factory/{FactoryName}`