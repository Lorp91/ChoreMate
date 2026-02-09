# Taskliste fuer ChoreMate

## Phase 0: Vorbereitung und Setup

- [x] Projektstruktur anlegen
  - [x] Git initialisieren
- [x] Datenbank vorbereiten
- [x] Frontend-Basis
  - [x] Tailwind + DaisyUI installieren
  - [x] Tailwind + DaisyUI konfigurieren

## Phase 1: Authentifizierung

- [x] User Model erweitern
- [x] Registrierung hinzufuegen
- [x] Login hinzufuegen
- [x] Middleware und protected Routes einrichten
- [x] Tests schreiben

## Phase 2: Haushaltsverwaltung

- [x] Haushalt Model+Migration
- [x] Mitgliedschaft Model+Migration
  - [x] Beziehungen in Models
- [x] HaushaltController erstellen
  - [x] Authorization mit isOwner()
  - [x] update function implementieren
  - [x] destroy function implementieren
- [x] Views erstellen
  - [ ] edit-modal fertigstellen
    - [ ] input-values fuellen
    - [ ] delete form implementieren
    - [ ] eigene form errors(gerade beides 'name')
- [ ] Tests schreiben

## Phase 3: Raum

- [x] Raum Model+Migration
  - [x] Beziehungen in Model
- [x] RaumController erstellen
- [x] Views erstellen
- [ ] Tests schreiben

## Phase 4: Aufgaben

- [x] Aufgabe Model+Migration
  - [x] Beziehungen in Model
- [ ] completedTask Model+Migration
  - [ ] Beziehungen in Models
  - [ ] in completeTask completedTask erstellen
- [ ] AufgabenVorlage Model+Migration
  - [ ] Methode erstelleAufgabe()
- [ ] AufgabeController erstellen
  - [ ] CRUD
  - [ ] Aufgabe erledigen()
  - [ ] Automatische Neuterminierung
- [ ] Views erstellen
- [ ] Tests schreiben

## Phase 5: Benutzeroberflaeche

- [ ] Sidebar auslagern in eigene Datei
  - [ ] SidebarComposer einrichten (viewComposer mit SidebarDaten)
  - [ ] Daten in SidebarComposer cachen und limiten
- [ ] Alle Seiten mit DaisyUI finalisieren
  - [ ] Dashboard
- [ ] Filterfunktionen

## Phase 6: Automatisierung und Hintergrundprozesse

- [ ] EventListener ErstelleNeueAufgabeWennWiederkehrend()

## Phase 7: Tests und Qualitaetssicherung

- [ ] Unit Tests
- [ ] Feature Tests
- [ ] Browser Tests
- [ ] Manuelle Tests

## Phase 8: Deployment

- [ ] Docker/Docker Compose
- [ ] Production Build
- [ ] Dokumentation

## Phase 9: Fallstudie

- [ ] Fallstudie Dokument fertigstellen
- [ ] Praesentation vorbereiten

## Phase 10: Erweiterungen/Ausblick

- [ ] Statistiken ueber Aufgaben
- [ ] weitere Ideen formulieren/verarbeiten
