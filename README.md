# ZR-KRG

Aplikacja dotycząca zadania rekrutacyjnego od KR Group.

# Rekomendowane środowisko

1. NGINX 1.23.4, 
2. PHP 8.2, 
3. MYSQL 8.0.33, 
4. Composer 2.5.5, 
5. Docker 23.0.5 & docker compose v2.17.3.

# Instalacja i uruchomienie

1. Pobranie repozytorium:

```bash
git clone https://github.com/devkacper/zr-krg.git
```

2. Instalacja pakietów composer:

```bash
composer install
```

3. Przekopiowanie pliku .env-example do .env  i uzupełnienie ustawień według lokalnej konfiguracji serwera i bazy danych.

4. Uruchomienie migracji:
```bash
php artisan migrate
```
5. Uruchomienie seederów:
```bash
php artisan db:seed
```

6. Wygenerowanie klucza aplikacji:

```bash
php artisan key:generate
```

7. Start aplikacji:
```bash
php artisan serve
```

# Weryfikacja funkcjonalności

Endpointy API:

```bash
POST: /api/authenticate
Autoryzacja użytkownika i zwrócenie tokenu API.

POST: /api/currencies/store
Dodanie kursu waluty.

GET: /api/currency
Lista kursów walut z danego dnia.
 
GET: /api/currency/{currency}
Pobranie kursu dla wybranej waluty z danego dnia. 
```

Polecenie artisan zapisujące aktualne kursy walut:

```bash
php artisan currencies:rates
```
