# Taskliste fuer ChoreMate

## Refactor

- [x] nicht benutzte Dateien loeschen
    - [x] Pest Browser deinstallieren
- [x] Ordnerstruktur
    - [x] Views
    - [x] App-Ordner

## Auth -> auf Fortify geaendert

- [x] Alles nochmal pruefen und auf Standard bringen -> mit Breeze vergleichen?
    - [x] Namen von Klassen und Functions
    - [x] Controller
- [ ] FormRequests

## Household

- [x] Migration
    - [x] Pivottabellenname household_user
- [x] Factory
- [x] Seeding
- [x] Model
    - [x] Beziehungen -> Pivots
    - [x] Logik
- [x] Routing
    - [x] Ressource -> shallow
- [x] Controller
    - [x] Policy -> eine fuer alles
    - [x] Requests -> store und update
    - [x] Services -> nur wenn komplexe logik
    - [x] Actions -> create, update, delete und extra
- [x] Views
- [x] Tests

## Room

- [x] Migration
- [x] Factory
- [x] Seeding
- [x] Model
    - [x] Beziehungen
    - [x] Logik
- [x] Routing
    - [x] Ressource -> shallow
- [x] Controller
    - [x] Policy
    - [x] Requests
    - [x] Services
    - [x] Actions
- [x] Views
- [ ] Tests

## Task

- [x] Migration
- [x] Factory
- [x] Seeding
- [x] Model
    - [x] Beziehungen
    - [x] Logik
- [x] Routing
    - [x] Ressource -> shallow
- [x] Controller
    - [x] Policy
    - [x] Requests
    - [x] Services
    - [x] Actions
- [x] Views
- [ ] Tests

## Benutzeroberflaeche

- [ ] Sidebar fixen
    - [ ] Daten kommen ueber Layout bzw Controller des Views? (testen)
    - [ ] Sidebar Class Component erstellen
        - [ ] Class Component anstatt View Composer testen
        - [ ] falls View Composer bleibt cachen und limiten
    - [ ] Sortierungen der Raeume steuern
- [x] Ueberlegen welche Pages wirklich gebraucht werden
    - [x] Ablaeufe designen? User-Stories bzw User-Flows/Journey
- [ ] Dashboard
- [ ] Filterfunktionen

## Deployment

- [ ] Docker/Docker Compose
- [ ] Production Build
- [ ] Dokumentation

## Erweiterungen/Ausblick

- [ ] aufgaben rueckgaengig machen? (auf nicht completed von completed)
    - wie loescht man aus completedTask den richtigen?
- [ ] Statistiken ueber Aufgaben
- [ ] weitere Ideen formulieren/verarbeiten

## Sonstiges

- [x] Database-Queries gucken und Anzahl verringern - clean machen
- [x] Seeden nochmal richtig machen das nicht mehr erstellt wird als man schreibt
