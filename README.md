## Setup

### Clone the project from Git and cd into your preferred PHP environment.

<p>git clone https://github.com/philipokumu/hr-policy-management-system.git</p>
<p> cd company-management-system</p>

### Install backend dependencies

composer install

### Install frontend dependencies

npm install

npm run dev

### Create a database in your php localhost

### Clone .env file and set your database details in the environment variables

cp .env.example .env

### Migrate the database

php artisan migrate:fresh --seed

### Start your server and access the project from the link provided

php artisan serve
