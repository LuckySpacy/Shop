<?php


# Zugangsdaten
$db_server = 'rdbms.strato.de';
$db_benutzer = 'U4209323';
$db_passwort = 'WL3e72CDYootH8vzfJV8';
$db_name = 'DB4209323';

# Verbindungsaufbau
if(mysql_connect($db_server, $db_benutzer, $db_passwort)) {
    echo 'Server-Verbindung erfolgreich, w�hle Datenbank aus...
';
    if(mysql_select_db($db_name)) {
        echo 'Datenbank erfolgreich ausgew�lt, alle Tests abgeschlossen.';
    }
    else {
        echo 'Die angegebene Datenbank konnte nicht ausgew�hlt werden, bitte die Eingabe pr�fen!';
        
    }
}
else {
    echo 'Verbindung nicht m�glich, bitte Daten pr�fen!
        
';
    echo 'MYSQL-Fehler: '.mysql_error();
}

?>