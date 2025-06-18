## ⚙️ Cara Install & Menjalankan Aplikasi

### 1. Clone Repository

```bash
git clone https://github.com/ilhanmanzis/pos.git
cd pos

```

### 2. Install Dependency

```
composer install
npm install
```

### 3. Konfigurasi Environment

```
cp .env.example .env
```

Edit file .env, contoh:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kasir
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Key

```
php artisan key:generate
```

### 5. Migrasi Database dan Seeder

```
php artisan migrate --seed
```

### 6. Jalankan Aplikasi

```
php artisan serve
```

### 7. link storage

```
php artisan storage:link
```

##

### Develpoment

```
npm run dev
```

### Build Vite

```
npm run build
```

## ERD

![ERD](screenshots/gudang.jpg)
