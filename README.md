# AngryProton

AngryProton ist ein für die FHNW erstelltes Projekt.

### Systemvoraussetzungen
* Webserver (Apache oder nginx)
* PHP 5.6
* Composer
* **Optional:** NodeJS und GulpJS

### Installation

Das Repo auf dem Webserver-Root (/htdocs, /var/www) klonen:

```sh
$ git clone https://github.com/salvomulas/angryproton.git
```

Mit Composer alle Abhängigkeiten installieren

```sh
$ composer install
```

.env File erzeugen und entsprechend konfigurieren

```sh
$ touch .mv
```

Datenbank migrieren und seeden

```sh
$ php artisan migrate
$ php artisan db:seed
```