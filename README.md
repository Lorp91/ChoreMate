# ChoreMate - Haushaltsplaner

## Beschreibung

ChoreMate ist eine Webanwendung, die dabei hilft den Haushalt zu organisieren.
Man kann wiederkehrende Haushaltsaufgaben erstellen, die man auf Raeume zuordnet.
Auch das hinzufuegen von anderen Usern zum eigenen Haushalt ist moeglich.

## Voraussetzungen

- PHP + Composer
- Docker + Docker Compose
- optional: PostgreSQL Datenbank

## Installation

1. `.env` einrichten(`.env.example` kopieren und das "example" entfernen)
2. `composer install` um Composer Abhaengigkeiten zu installieren
3. `./vendor/bin/sail up -d --build` um Docker-Container zu starten
4. `./vendor/bin/sail artisan key:generate` um APP_KEY zu generieren
5. `./vendor/bin/sail artisan migrate` fuer die Datenbank-migration
6. Vite fuer HMR(Hot Module Replacement)
    - `./vendor/bin/sail npm i` packages installieren
    - `./vendor/bin/sail npm run dev` vite starten

Danach sollte die App auf `http://localhost:80` erreichbar sein.

## Funktionalitaeten

- Registrierung und Login mit Fehlermeldung
- TODO: features hinzufuegen

## Techstack

- Laravel
- PostgreSQL
- Tailwindcss
- DaisyUI
