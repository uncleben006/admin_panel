
############### php artisan command ###############

# Create a new user
php artisan backpack:user

# Create nodes
php artisan make:migration:schema create_nodes_table --model=0 --schema="group:string,country:string,region:string,ip:ipAddress,hostname:string,connection:tinyInteger,monitor:tinyInteger"
php artisan migrate
php artisan backpack:crud node

# Update column
php artisan make:migration add_status_to_nodes_table --table=nodes

# Create groups
php artisan make:migration:schema create_groups_table --model=0 --schema="group:string,user_id:integer,status:tinyInteger"
php artisan migrate
php artisan backpack:crud group

# Rename column name
php artisan make:migration rename_nodes_column
php artisan migrate

# Refresh groups migration
php artisan migrate:refresh --path=/database/migrations/2022_03_19_141420_create_groups_table.php

# Add group relationship to user
php artisan make:migration add_group_id_to_users_table --table=users

############### php artisan command ###############

############### init command ###############

# Generate key
php artisan key:generate

# Migrate database schema
php artisan migrate
php artisan db:seed

############### init command ###############
