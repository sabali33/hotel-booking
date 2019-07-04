php artisan make:model Room -m -c
php artisan make:model RoomType -m -c
php artisan make:model RoomCapacity -m -c
php artisan make:model Customer -m -c
php artisan make:model Booking -m -c
php artisan make:model PriceManager -m -c

//seed commands
php artisan make:seeder RoomSeeder
php artisan make:seeder PriceSeeder
php artisan make:seeder RoomTypeSeeder
php artisan make:seeder RoomCapacitySeeder

// seed Factory
php artisan make:factory PriceFactory
php artisan make:factory RoomTypeFactory
php artisan make:factory RoomCapacityFactory