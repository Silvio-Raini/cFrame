<?php

// Datenbankkonfiguration
define('DB_HOST', 'localhost');
define('DB_NAME', 'cFrame');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// Debug-Modus aktivieren/deaktivieren
define('DEBUG', true);

// Zeitzone der Anwendung
date_default_timezone_set('Europe/Berlin');

// Pfad zur Anwendung
define('APP_PATH', dirname(__DIR__));

// URL der Anwendung
define('APP_URL', 'http://localhost/your_app');

?>