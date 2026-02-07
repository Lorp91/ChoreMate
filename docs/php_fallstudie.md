# Fallstudie OOP mit PHP Entwurf

## 1. Einleitung

Ziel dieser Fallstudie ist die Entwicklung einer webbasierten Haushaltsverwaltungsanwendung unter Verwendung von PHP und dem Framework Laravel. Die Anwendung soll dabei helfen, wiederkehrende Haushaltsaufgaben übersichtlich zu planen, zu organisieren und zuverlässig auszuführen.

Ausgangspunkt des Projekts ist der eigene Haushalt, in dem alltägliche Aufgaben wie Putzen, Aufräumen oder andere organisatorische Tätigkeiten regelmäßig anfallen und häufig vergessen oder ungleich verteilt werden. Die Anwendung ist jedoch bewusst so konzipiert, dass sie grundsätzlich für unterschiedliche Haushaltsformen wie Paare oder Wohngemeinschaften geeignet ist und perspektivisch auch von einer größeren Nutzergruppe verwendet werden könnte.

Ziel der Anwendung ist es, eine zentrale Übersicht über anstehende Aufgaben bereitzustellen. Aufgaben können dabei einmalig oder wiederkehrend angelegt werden, beispielsweise monatliche Reinigungsaufgaben wie das Putzen von Fenstern. Nach dem Erledigen einer Aufgabe wird diese automatisch erneut für den nächsten vorgesehenen Zeitraum geplant. Zusätzlich sollen vordefinierte Aufgaben zur Verfügung stehen, um Nutzern den Einstieg zu erleichtern, die noch keinen eigenen Haushaltsplan erstellt haben.

Die Umsetzung des Projekts erfolgt als Laravel-Webanwendung mit Benutzerverwaltung, Login-System und Datenbankanbindung. Laravel eignet sich besonders gut für dieses Projekt, da es eine klare Struktur vorgibt und die Entwicklung moderner Webanwendungen unterstützt. Gleichzeitig bietet das Projekt einen idealen Anwendungsfall für objektorientierte Programmierung, da zentrale Konzepte wie Benutzer, Haushalte, Räume und Aufgaben als eigenständige Objekte mit klar definierten Eigenschaften und Methoden modelliert werden können.

## 2. Aufgabenstellung/Problemstellung

Im aktuellen Haushalt existiert kein festes System zur Organisation von Haushaltsaufgaben. Aufgaben werden meist spontan erledigt oder mündlich abgesprochen, was regelmäßig zu Missverständnissen oder vergessenen Tätigkeiten führt. Eine zentrale Übersicht über anstehende Aufgaben fehlt, ebenso eine klare Struktur zur fairen und regelmäßigen Verteilung der anfallenden Arbeiten.

Bei der Recherche nach bestehenden Lösungen zeigte sich, dass viele vergleichbare Anwendungen zwar ähnliche Funktionen anbieten, jedoch häufig kostenpflichtig sind. Insbesondere das Hinzufügen weiterer Personen zu einem Haushalt ist oft nur über kostenpflichtige Abonnements möglich, die monatliche Gebühren verursachen. Diese Einschränkungen stellten einen zusätzlichen Anreiz dar, eine eigene Lösung zu entwickeln, die den gewünschten Funktionsumfang ohne laufende Kosten abbildet.

Ziel der Anwendung ist die Entwicklung eines ersten funktionsfähigen Produkts (Minimum Viable Product, MVP), das einen soliden Grundstein für spätere Erweiterungen bietet. Dabei liegt der Fokus bewusst auf den zentralen Kernfunktionen, um ein überschaubares und wartbares System zu schaffen und einem sogenannten „Scope Creep“ entgegenzuwirken.

Konkret soll die Anwendung folgende Funktionen bereitstellen:

- Erstellung und Verwaltung von Benutzerkonten mit Login-System
- Anlegen und Verwalten von Haushalten bzw. Wohngemeinschaften
- Hinzufügen mehrerer Mitglieder zu einem Haushalt
- Strukturierung des Haushalts in einzelne Räume
- Anlegen von einmaligen und wiederkehrenden Aufgaben
- Automatische Erneuerung wiederkehrender Aufgaben nach Erledigung
- Übersicht über täglich oder aktuell anstehende Aufgaben
- Möglichkeit, Aufgaben als erledigt zu markieren

Zu den fachlichen Anforderungen zählen insbesondere eine übersichtliche Benutzeroberfläche, die Automatisierung wiederkehrender Aufgaben sowie die Unterstützung mehrerer Benutzer innerhalb eines Haushalts. Darüber hinaus soll die Anwendung von Beginn an so entworfen werden, dass sie erweiterbar bleibt, beispielsweise für spätere Funktionen wie Statistiken, Benachrichtigungen oder eine detailliertere Aufgabenverteilung.

Zusätzlich wird Wert auf eine saubere technische Basis gelegt. Die Anwendung soll containerfähig sein, um eine einfache lokale Bereitstellung sowie eine mögliche spätere Skalierung in einer Cloud-Umgebung zu ermöglichen. Durch diesen Ansatz wird die Wartbarkeit und Zukunftssicherheit der Anwendung weiter erhöht.

## 3. Analyse & Planung

### 3.1 Fachliche Analyse

Im Rahmen der fachlichen Analyse werden die zentralen Objekte identifiziert, die für die Abbildung eines Haushalts und dessen Organisation erforderlich sind. Ziel ist es, reale Gegebenheiten eines Haushalts möglichst nah an der Realität zu modellieren und in eine strukturierte, objektorientierte Form zu überführen.

Die wichtigsten fachlichen Objekte der Anwendung sind:

#### Benutzer (User)

Ein Benutzer repräsentiert eine Person, die die Anwendung verwendet. Ein Benutzer kann Mitglied in einem oder mehreren Haushalten sein und besitzt innerhalb eines Haushalts eine bestimmte Rolle.

- Eigenschaften:
  - Name
  - E-Mail-Adresse
  - Passwort
  - Rolle im Haushalt (z. B. Admin oder Benutzer)
- Aktionen:
  - Einloggen
  - Aufgaben einsehen
  - Aufgaben als erledigt markieren

#### Haushalt

Ein Haushalt stellt eine organisatorische Einheit dar, beispielsweise eine Wohnung oder Wohngemeinschaft. Er bildet den zentralen Bezugspunkt für alle weiteren Objekte.

- Eigenschaften:
  - Name des Haushalts
  - Erstellungsdatum
- Aktionen:
  - Mitglieder verwalten
  - Räume anlegen
  - Aufgaben organisieren

#### Mitgliedschaft (User–Haushalt-Beziehung)

Da ein Benutzer mehreren Haushalten angehören kann und ein Haushalt mehrere Benutzer enthält, wird diese Beziehung durch ein eigenes Objekt abgebildet. Zusätzlich wird hier die jeweilige Rolle gespeichert.

- Eigenschaften:
  - Benutzer
  - Haushalt
  - Rolle (Admin oder Benutzer)
- Aktionen:
  - Rolle prüfen
  - Berechtigungen verwalten

#### Raum

Räume dienen zur Strukturierung eines Haushalts, beispielsweise Küche, Bad oder Schlafzimmer. Aufgaben können gezielt einem Raum zugeordnet werden, um die Übersichtlichkeit zu erhöhen.

- Eigenschaften:
  - Name des Raums
  - Zugehöriger Haushalt
- Aktionen:
  - Aufgaben zuordnen
  - Raum verwalten

#### Aufgabe (Task)

Eine Aufgabe repräsentiert eine konkrete Tätigkeit, die im Haushalt erledigt werden soll. Aufgaben können einmalig oder wiederkehrend sein und optional einem Raum zugeordnet werden.

- Eigenschaften:
  - Titel
  - Beschreibung
  - Fälligkeitsdatum
  - Wiederholungsintervall (z. B. täglich, wöchentlich, monatlich)
  - Zugehöriger Raum
  - Zugehöriger Haushalt
  - Optional zugewiesener Benutzer
  - Notizfeld für zusätzliche Hinweise (z. B. Waschprogramme)
- Aktionen:
  - Erstellen
  - Bearbeiten
  - Als erledigt markieren
  - Automatisch neu planen bei wiederkehrenden Aufgaben

#### Aufgabenvorlage

Aufgabenvorlagen dienen dazu, vordefinierte Aufgaben bereitzustellen, um den Einstieg in die Anwendung zu erleichtern.

- Eigenschaften:
  - Titel
  - Beschreibung
  - Empfohlenes Intervall
  - Optional empfohlener Raum
- Aktionen:
  - Aufgabe aus Vorlage erstellen

Durch die Trennung in diese fachlichen Objekte wird eine klare Struktur geschaffen, die sowohl die reale Haushaltsorganisation widerspiegelt als auch eine saubere technische Umsetzung ermöglicht.

### 3.2 Objektorientierter Ansatz

Die Entwicklung der Anwendung erfolgt unter konsequenter Verwendung objektorientierter Programmierung (OOP). Ziel ist es, die fachlichen Anforderungen des Projekts in klar strukturierte Klassen und Objekte zu überführen und so eine wartbare und erweiterbare Softwarearchitektur zu schaffen.

Aus vorherigen Projekten und Übungen wurden bereits Erfahrungen mit prozeduraler Programmierung gesammelt, unter anderem in Python. Dabei zeigte sich, dass prozedurale Ansätze bei wachsenden Projekten schnell unübersichtlich werden, da Logik, Datenhaltung und Darstellung häufig vermischt sind. Insbesondere bei Anwendungen mit mehreren Funktionen und Zuständen steigt der Wartungsaufwand erheblich.

Die objektorientierte Programmierung bietet hier deutliche Vorteile. Fachliche Konzepte wie Benutzer, Haushalte, Räume oder Aufgaben lassen sich direkt als Klassen modellieren. Jede Klasse kapselt dabei ihre eigenen Daten und stellt klar definierte Methoden zur Verfügung, um auf diese Daten zuzugreifen oder sie zu verändern. Dadurch wird der Code verständlicher, besser strukturiert und leichter zu erweitern.

Ein weiterer Vorteil von OOP ist die Wiederverwendbarkeit von Code. Gemeinsame Funktionalitäten müssen nicht mehrfach implementiert werden, sondern können zentral in Klassen oder Basisklassen abgebildet werden. Dies reduziert Redundanzen und erleichtert spätere Anpassungen. Gerade im Hinblick auf mögliche zukünftige Erweiterungen der Anwendung ist dieser Aspekt besonders wichtig.

Laravel unterstützt den objektorientierten Ansatz in besonderem Maße. Durch die Verwendung des MVC-Prinzips (Model-View-Controller) wird die Anwendung klar in Verantwortungsbereiche aufgeteilt. Die fachlichen Objekte der Anwendung werden als Eloquent Models umgesetzt, welche die Datenbanktabellen repräsentieren und gleichzeitig Geschäftslogik kapseln. Controller übernehmen die Steuerung der Anwendungslogik, während Views für die Darstellung der Benutzeroberfläche zuständig sind.

Durch diese Architektur entsteht eine klare Trennung von Zuständigkeiten, die nicht nur die Wartbarkeit verbessert, sondern auch die Zusammenarbeit in einem Team erleichtert. Da Laravel in dem bevorstehenden Praktikum eingesetzt wird, bietet dieses Projekt zudem die Möglichkeit, praxisnahe Erfahrungen mit objektorientierter Softwareentwicklung in einem realistischen Anwendungsfall zu sammeln.

## 4. Entwurf der Klassenstruktur

### 4.1 Klassendiagramm

**Vereinfachtes Klassendiagramm**

Das vereinfachte Klassendiagramm zeigt die zentralen Klassen der Anwendung sowie deren Beziehungen untereinander. Der Fokus liegt hierbei auf der Struktur der Anwendung und weniger auf technischen Details wie Datentypen oder Methoden.

- User
- Haushalt
- Mitgliedschaft
- Raum
- Aufgabe
- Aufgabenvorlage

Beziehungen:

- Ein User kann Mitglied in mehreren Haushalten sein
- Ein Haushalt kann mehrere User enthalten
- Die Beziehung zwischen User und Haushalt wird durch die Klasse Mitgliedschaft abgebildet
- Ein Haushalt besitzt mehrere Räume
- Ein Raum besitzt mehrere Aufgaben
- Eine Aufgabe kann optional einem User zugewiesen sein
- Eine Aufgabenvorlage dient zur Erstellung neuer Aufgaben

Dieses Diagramm eignet sich besonders zur Darstellung der grundlegenden Architektur der Anwendung und bietet eine gute Übersicht über die wichtigsten fachlichen Zusammenhänge.

```md
TODO: gegen UML-Diagramme austauschen
Das erweiterte Klassendiagramm ergänzt das vereinfachte Diagramm um exemplarische Attribute und Methoden. Es dient dazu, den objektorientierten Ansatz detaillierter darzustellen.

User
Attribute:
id
name
email
password
Methoden:
getHaushalte()
getAufgaben()

Haushalt
Attribute:
id
name
Methoden:
addMitglied()
removeMitglied()
getRaeume()

Mitgliedschaft

Attribute:
user_id
haushalt_id
rolle
Methoden:
isAdmin()

Raum

Attribute:
id
name
haushalt_id
Methoden:
getAufgaben()

Aufgabe

Attribute:
id
titel
beschreibung
faellig_am
intervall
notiz
raum_id
user_id
Methoden:
markierenAlsErledigt()
neuPlanen()

Aufgabenvorlage

Attribute:
id
titel
beschreibung
intervall

Methoden:
erstelleAufgabe()
```

### 4.2 Beschreibung der Klassen

#### Klasse: User

Die Klasse User repräsentiert einen registrierten Benutzer der Anwendung. Sie verwaltet grundlegende Benutzerdaten und stellt Methoden bereit, um auf zugehörige Haushalte und Aufgaben zuzugreifen.

- Zweck:
  - Repräsentation eines Benutzers
- Attribute:
  - Name, E-Mail-Adresse, Passwort
- Methoden:
  - Zugriff auf Haushalte
  - Anzeige zugewiesener Aufgaben

#### Klasse: Haushalt

Die Klasse Haushalt stellt eine organisatorische Einheit dar, in der mehrere Benutzer zusammenarbeiten. Sie dient als zentraler Bezugspunkt für Räume und Aufgaben.

- Zweck:
  - Organisation eines Haushalts
- Attribute:
  - Name des Haushalts
- Methoden:
  - Verwaltung von Mitgliedern
  - Zugriff auf Räume

#### Klasse: Mitgliedschaft

Die Klasse Mitgliedschaft bildet die Beziehung zwischen Benutzer und Haushalt ab. Zusätzlich speichert sie die Rolle eines Benutzers innerhalb eines Haushalts.

- Zweck:
  - Abbildung von Rollen und Berechtigungen
- Attribute:
  - Rolle (Admin oder Benutzer)
- Methoden:
  - Überprüfung von Berechtigungen

#### Klasse: Raum

Die Klasse Raum dient zur Strukturierung eines Haushalts. Aufgaben können einem Raum zugeordnet werden, um eine bessere Übersicht zu ermöglichen.

- Zweck:
  - Gruppierung von Aufgaben
- Attribute:
  - Raumname
- Methoden:
  - Zugriff auf Aufgaben

#### Klasse: Aufgabe

Die Klasse Aufgabe repräsentiert eine konkrete Tätigkeit innerhalb eines Haushalts. Sie unterstützt sowohl einmalige als auch wiederkehrende Aufgaben.

- Zweck:
  - Verwaltung von Haushaltsaufgaben
- Attribute:
  - Titel, Fälligkeitsdatum, Intervall, Notiz
- Methoden:
  - Als erledigt markieren
  - Automatische Neuterminierung

#### Klasse: Aufgabenvorlage

Die Klasse Aufgabenvorlage stellt vordefinierte Aufgaben zur Verfügung, die als Grundlage für neue Aufgaben dienen.

- Zweck:
  - Erleichterung der Aufgabenerstellung
- Attribute:
  - Titel, Beschreibung, Intervall
- Methoden:
  - Erstellung neuer Aufgaben

## 5. Geplante Umsetzung in PHP (Laravel)

Die Umsetzung der Anwendung erfolgt als Webanwendung mit dem PHP-Framework Laravel. Laravel stellt bereits eine klare Projektstruktur sowie zahlreiche bewährte Konzepte zur Verfügung, an denen sich die Entwicklung orientiert. Dadurch kann der Fokus auf die fachliche Logik der Anwendung gelegt werden, ohne grundlegende Strukturen selbst implementieren zu müssen.

### 5.1 Klassen & Konstruktoren

Die fachlichen Objekte der Anwendung werden als Eloquent Models umgesetzt. Jede zentrale Entität wie Benutzer, Haushalt, Raum oder Aufgabe entspricht dabei einer eigenen Klasse, die eine Datenbanktabelle repräsentiert.

Objekte werden in Laravel in der Regel über die zugehörigen Models erzeugt. Konstruktoren stellen dabei sicher, dass Objekte nur in einem gültigen Zustand erstellt werden. Beispielsweise kann eine Aufgabe nur mit einem Titel und einem zugehörigen Haushalt angelegt werden. Dadurch wird bereits bei der Objekterstellung auf Datenkonsistenz geachtet.

Durch diese Struktur wird eine klare Trennung zwischen Datenhaltung und Anwendungslogik erreicht, während Laravel viele wiederkehrende Aufgaben wie Datenbankzugriffe abstrahiert.

### 5.2 Sichtbarkeiten & Kapselung

Ein zentrales Prinzip der objektorientierten Programmierung ist die Kapselung. Attribute von Klassen werden nicht direkt von außen verändert, sondern über definierte Methoden oder Mechanismen kontrolliert.

Laravel unterstützt dieses Prinzip, indem der direkte Zugriff auf Attribute durch Eloquent Models geregelt wird. Änderungen an Daten erfolgen über klar definierte Schnittstellen, beispielsweise durch Methoden oder validierte Eingaben in Controllern. Dadurch wird verhindert, dass inkonsistente oder ungültige Zustände entstehen.

Die Kapselung sorgt dafür, dass interne Implementierungsdetails einer Klasse verborgen bleiben und spätere Änderungen am Code möglich sind, ohne andere Teile der Anwendung zu beeinflussen.

### 5.3 Wiederverwendung & Struktur

Statt klassischer Vererbung wird in der Anwendung überwiegend auf Komposition und klar definierte Verantwortlichkeiten gesetzt. Rollen wie „Admin“ oder „Benutzer“ werden nicht über eigene Unterklassen abgebildet, sondern über die Mitgliedschaft eines Benutzers in einem Haushalt.

Gemeinsame Logik wird zentral implementiert und kann von mehreren Komponenten genutzt werden. Laravel fördert diesen Ansatz durch die Verwendung von Services, Traits und klar getrennten Verantwortungsbereichen innerhalb der Anwendung.

Durch die Orientierung an den Laravel-Konventionen entsteht eine übersichtliche und erweiterbare Struktur, die sowohl für die aktuelle Umsetzung als auch für zukünftige Erweiterungen geeignet ist.

## 6. Beispielhafter Programmablauf

Zur Veranschaulichung der Funktionsweise der Anwendung werden im Folgenden zwei typische Nutzungsszenarien beschrieben. Diese zeigen, wie die zuvor beschriebenen Klassen und Konzepte im Zusammenspiel verwendet werden.

### 6.1 Szenario 1: Haushalt erstellen und Benutzer einladen

Nach der Registrierung und dem Login wird ein Haushaltsobjekt angelegt und automatisch eine Mitgliedschaft zwischen dem Benutzer und dem Haushalt erstellt. Der Ersteller des Haushalts erhält dabei die Rolle „Admin“.

Anschließend kann der Admin weitere Benutzer zu dem Haushalt einladen. Wird eine Einladung angenommen, entsteht eine weitere Mitgliedschaft, die den eingeladenen Benutzer mit dem Haushalt verknüpft. Die Rolle des neuen Mitglieds wird dabei als normaler Benutzer festgelegt.

Durch diese Struktur können mehrere Benutzer gemeinsam in einem Haushalt arbeiten, während administrative Aufgaben wie das Hinzufügen oder Entfernen von Mitgliedern klar geregelt sind.

### 6.2 Szenario 2: Aufgabe anzeigen, erledigen und neu planen

Ein Benutzer öffnet die Aufgabenübersicht der Anwendung. Dort werden alle aktuell anstehenden Aufgaben des Haushalts angezeigt, sortiert nach Fälligkeit oder Raum. Wiederkehrende Aufgaben erscheinen automatisch, sobald ihr geplantes Datum erreicht ist.

Der Benutzer sieht beispielsweise die Aufgabe „Handtücher austauschen“, die dem Raum „Badezimmer“ zugeordnet ist. Nach dem Erledigen der Aufgabe markiert der Benutzer diese als erledigt. Der Status der Aufgabe wird aktualisiert und sie verschwindet aus der aktuellen Übersicht.

Handelt es sich um eine wiederkehrende Aufgabe, wird im Hintergrund automatisch ein neuer Fälligkeitstermin basierend auf dem definierten Intervall berechnet. Die Aufgabe erscheint zu einem späteren Zeitpunkt erneut in der Übersicht, ohne dass sie manuell neu angelegt werden muss.

Durch diesen Ablauf wird sichergestellt, dass regelmäßig anfallende Aufgaben nicht vergessen werden und jederzeit eine aktuelle Übersicht über den Zustand des Haushalts besteht.

## 7. Testing & Qualitätssicherung

Um die Qualität und Zuverlässigkeit der Anwendung sicherzustellen, wird während und nach der Umsetzung gezielt getestet. Dabei kommen sowohl automatisierte Tests als auch manuelle Überprüfungen zum Einsatz.

Für die automatisierten Tests wird das in Laravel integrierte Testframework Pest verwendet. Pest ermöglicht das Schreiben übersichtlicher und gut lesbarer Tests, wodurch Fehler frühzeitig erkannt und einzelne Komponenten der Anwendung gezielt überprüft werden können.

Ein Schwerpunkt liegt auf dem Testen der zentralen fachlichen Funktionen, beispielsweise:

- Erstellung von Haushalten
- Hinzufügen und Entfernen von Benutzern
- Anlegen von Aufgaben
- Markieren von Aufgaben als erledigt
- Korrekte Neuterminierung wiederkehrender Aufgaben

Zusätzlich werden mit Hilfe von Browser-Tests Benutzerinteraktionen überprüft. Dabei wird das Verhalten der Anwendung aus Sicht eines echten Benutzers simuliert, beispielsweise das Einloggen, das Aufrufen der Aufgabenübersicht oder das Abhaken einer Aufgabe. Auf diese Weise kann sichergestellt werden, dass nicht nur die Logik im Hintergrund korrekt funktioniert, sondern auch die Benutzeroberfläche erwartungsgemäß reagiert.

Ergänzend zu den automatisierten Tests erfolgt eine manuelle Prüfung mit verschiedenen Testdaten. Hierbei werden typische Nutzungsszenarien sowie mögliche Fehleingaben durchgespielt, um die Stabilität und Benutzerfreundlichkeit der Anwendung weiter zu erhöhen.

Durch die Kombination aus automatisierten Tests und manuellen Prüfungen wird eine solide Qualitätssicherung erreicht, die sowohl funktionale Fehler als auch Probleme im Ablauf frühzeitig sichtbar macht.

## 8. Fazit & Ausblick

Im Rahmen dieser Fallstudie wurde die Konzeption einer webbasierten Haushaltsverwaltungsanwendung unter Verwendung objektorientierter Programmierung mit PHP und Laravel erarbeitet. Ziel war es, einen realitätsnahen Anwendungsfall zu planen, der sowohl fachlich sinnvoll als auch technisch gut strukturiert ist.

Durch das Projekt konnte insbesondere das praktische Arbeiten mit dem Framework Laravel vertieft werden. Während grundlegende Kenntnisse der objektorientierten Programmierung bereits vorhanden waren, lag der Schwerpunkt dieser Arbeit auf der Anwendung dieser Konzepte innerhalb einer realen Webanwendung. Darüber hinaus spielte die strukturierte Planung der Anwendung eine zentrale Rolle, da sie die Grundlage für eine saubere und erweiterbare Architektur bildet.

```text
TODO: Eine detaillierte Bewertung der Umsetzung sowie mögliche Verbesserungen sollen bewusst erst nach der tatsächlichen Implementierung erfolgen. Dadurch kann die Reflexion auf realen Erfahrungen basieren und konkrete Erkenntnisse aus der Entwicklungsphase berücksichtigen.
```

Für die Zukunft bieten sich zahlreiche Erweiterungsmöglichkeiten an. Denkbar sind unter anderem statistische Auswertungen zur Aufgabenverteilung, eine mobile Anwendung mit Push-Benachrichtigungen zur Erinnerung an anstehende Aufgaben sowie ein Punktesystem zur spielerischen Motivation der Benutzer. Auch technische Erweiterungen wie der konsequente Einsatz von Docker und eine spätere Bereitstellung in einer Cloud-Umgebung sind vorgesehen. Perspektivisch könnte zudem eine Monetarisierung der Anwendung in Betracht gezogen werden.

Insgesamt stellt das Projekt eine solide Grundlage dar, auf der sowohl funktionale als auch technische Erweiterungen aufgebaut werden können. Die Anwendung ist so konzipiert, dass sie mit steigenden Anforderungen wachsen kann und langfristig weiterentwickelbar bleibt.

## XXX. Editor Notizen

- vllt kuerzen falls zu lang
- kapitel 5-7 auf ist zustand nach der bearbeitung schreiben
- UML-Diagramme erstellen und dazu packen
- codebeispiele?
- HouseholdSelector aufgegeben schreiben
  - habe "modernen" aufbau nicht hinbekommen und wegen zeitdruck dann zu "normalen" aufbau gewechselt
  - richtiger ansatz waere wohl mit react/vue und dann inertia?
  - haette ich das gewusst haette ich von anfang an den auf seiten getrennten weg genommen
- RoomPolicy entfernt und habe jetzt HouseholdPolicy als kern fuer authorization
  - view -> user, manage -> admin/owner

```css
@plugin "daisyui/theme" {
  name: "pastel";
  default: false;
  prefersdark: false;
  color-scheme: "light";
  --color-base-100: oklch(100% 0 0);
  --color-base-200: oklch(98.462% 0.001 247.838);
  --color-base-300: oklch(92.462% 0.001 247.838);
  --color-base-content: oklch(20% 0 0);
  --color-primary: oklch(81% 0.111 293.571);
  --color-primary-content: oklch(49% 0.265 301.924);
  --color-secondary: oklch(89% 0.058 10.001);
  --color-secondary-content: oklch(51% 0.222 16.935);
  --color-accent: oklch(90% 0.093 164.15);
  --color-accent-content: oklch(50% 0.118 165.612);
  --color-neutral: oklch(55% 0.046 257.417);
  --color-neutral-content: oklch(92% 0.013 255.508);
  --color-info: oklch(95% 0.045 203.388);
  --color-info-content: oklch(52% 0.105 223.128);
  --color-success: oklch(87% 0.15 154.449);
  --color-success-content: oklch(52% 0.154 150.069);
  --color-warning: oklch(90% 0.076 70.697);
  --color-warning-content: oklch(55% 0.195 38.402);
  --color-error: oklch(80% 0.114 19.571);
  --color-error-content: oklch(50% 0.213 27.518);
  --radius-selector: 1rem;
  --radius-field: 1rem;
  --radius-box: 1rem;
  --size-selector: 0.28125rem;
  --size-field: 0.25rem;
  --border: 2px;
  --depth: 1;
  --noise: 0;
}
```
