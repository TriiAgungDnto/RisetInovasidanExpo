<p align="center">
    <img src="https://raw.githubusercontent.com/RiyanAmanda/RIE/master/public/assets/logo/rie-dark.png" alt="Riset Dan Inovasi Expo" width="350px" height="100px">
    <hr/>
</p>

### Instalasi
Instal [Composer](https://getcomposer.org/) pada Sistem Operasi agar perintah artisan dapat dijalankan. Masuk ke folder <i>root</i> aplikasi dan jalankan perintah instal pada terminal untuk download vendor yang dibutuhkan.

```javascript
//Download vendor untuk aplikasi
composer install
```

Jalankan perintah berikut untuk <i>copy</i> file `.env`, atau bisa juga <i>copy</i> secara manual. Sesuaikan pengaturan <i>database</i> dengan lokal sistem anda pada file `.env` ini.

```javascript
cp .env.example .env
```

Jalankan perintah artisan untuk generate enkripsi kunci keamanan aplikasi.

```javascript
//Generate key baru
php artisan key:generate
```
Jalankan perintah artisan untuk generate folder yang dibutuhkan oleh aplikasi.

```javascript
//Generate key baru
php artisan directory:generate
```
Jalankan perintah artisan migration dan seeder pada terminal untuk membuat <i>database</i> dan pengguna.

```javascript
//Generate database baru dan user default
php artisan migrate --seed

```

Jalankan artisan serve pada terminal untuk jalankan server default laravel.

```javascript
//Local server default laravel
php artisan serve

```

### User Default Akses

```javascript
//Email login
riset@binadarma.ac.id

//Pass login
12345678
```