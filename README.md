# WooCommerce cPanel Account Plugin

Das WooCommerce cPanel Account Plugin ermöglicht es Ihnen, neue cPanel-Konten für Ihre Kunden zu erstellen, wenn sie ein Hosting-Paket in Ihrem WooCommerce-Shop kaufen. Es bietet auch die Möglichkeit, zusätzlichen Speicherplatz für die erstellten cPanel-Konten zu verkaufen.

## Funktionen

- Erstellen neuer cPanel-Konten basierend auf dem gekauften Hosting-Paket
- Automatische Zuweisung von Benutzernamen, Passwörtern und Domains für die erstellten Konten
- Möglichkeit, zusätzlichen Speicherplatz für cPanel-Konten zu verkaufen
- Integration mit WooCommerce-Abonnements für nahtlose Verlängerungen
- Shortcode zum Anzeigen der cPanel-Kontodaten auf der Bestellübersichtsseite
- Webhooks für die Benachrichtigung bei Kontenerstellung
- Einstellungen zum Konfigurieren der WHM-API-Anmeldeinformationen

## Installation

1. Laden Sie die neueste Version des Plugins aus dem [GitHub-Repository](https://github.com/macbaydigital/woocommerce-cpanel-account-plugin) herunter.
2. Entpacken Sie die ZIP-Datei und laden Sie den Ordner `woocommerce-cpanel-account-plugin` in den Ordner `/wp-content/plugins/` Ihrer WordPress-Installation hoch.
3. Aktivieren Sie das Plugin über die Plugin-Verwaltung in WordPress.
4. Navigieren Sie zu "WooCommerce" > "Einstellungen" > "cPanel Account Plugin" und konfigurieren Sie Ihre WHM-API-Anmeldeinformationen.

## Verwendung

1. Erstellen Sie ein neues Produkt in WooCommerce und weisen Sie ihm ein Hosting-Paket zu.
2. Wenn ein Kunde dieses Produkt kauft, wird automatisch ein neues cPanel-Konto für ihn erstellt.
3. Fügen Sie den Shortcode `[cpanel_account_details order_id="123"]` auf der Bestellübersichtsseite ein, um die Kontodaten anzuzeigen (ersetzen Sie `123` durch die tatsächliche Bestellungs-ID).
4. Verkaufen Sie zusätzlichen Speicherplatz, indem Sie ein separates Produkt für Speicherplatz-Upgrades erstellen.

## Häufig gestellte Fragen

### Wie kann ich die WHM-API-Anmeldeinformationen konfigurieren?

Navigieren Sie zu "WooCommerce" > "Einstellungen" > "cPanel Account Plugin" und geben Sie Ihre Anmeldeinformationen in den entsprechenden Feldern ein.

### Kann ich dieses Plugin auch mit anderen Hosting-Panels als cPanel verwenden?

Derzeit unterstützt dieses Plugin nur die Integration mit cPanel/WHM. Die Unterstützung für andere Hosting-Panels kann in zukünftigen Versionen hinzugefügt werden.

### Wie kann ich Updates für das Plugin erhalten?

Dieses Plugin unterstützt automatische Updates direkt aus dem GitHub-Repository. Stellen Sie sicher, dass Sie Ihr GitHub-Zugriffstoken in den Plugin-Einstellungen konfiguriert haben, um Updates zu erhalten.

## Support

Wenn Sie Probleme mit dem Plugin haben oder Funktionsanfragen haben, öffnen Sie bitte ein neues Issue im [GitHub-Repository](https://github.com/macbaydigital/woocommerce-cpanel-account-plugin).

## Mitwirkende

Dieses Plugin wurde von [Macbay Digital](https://macbay.net) entwickelt. Mitwirkende sind herzlich willkommen!

## Lizenz

Dieses Plugin ist unter der [GNU General Public License v3.0](LICENSE) lizenziert.
