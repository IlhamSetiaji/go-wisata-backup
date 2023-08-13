# go-wisata.id

> https://go-wisata.id/login = page login user 

> https://go-wisata.id/login-admin = page login admin


# daftar roles 
> id  name

> 1 = admin 	as Super Admin

> 2 = wisata 	as Admin Wisata

> 3 = kuliner as Admin Kuliner

> 4 = penginapan as Admin Penginapan

> 5 = pelanggan as User	

> 6 = desa 	  as Admin Desa

> 7 = event & sewa tempat 	

> 8 = seni & budaya 

> 9 = kota

# daftar user
> admin
email: admin@gmail.com
password: admin@gmail.com

> kota
email: adminkota@gmail.com
password: adminkota@gmail.com

> desa
email: kare@gmail.com
password: kare@gmail.com


# how to use 
1. git pull using https
2. composer  install (if required)
3. Import "gowisata_new.sql" to your own database
4. php artisan migrate --path=/database/migrations/2023_04_04_100533_add_parent_id_to_users_table.php
5. php artisan migrate --path=/database/migrations/2023_05_31_203158_add_city_to_tb_tempat_table.php
6  php artisan migrate --path=/database/migrations/2023_08_13_185704_create_images_table.php
7. php artisan db:seed
8. run on localhost port 8000










