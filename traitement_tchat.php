<?php

session_start();
require_once 'connexion.php';

$sql = "INSERT INTO messages 
        (messages_pseudo, messages_dateM, messages_contenu) 
        VALUES
        (:messages_pseudo, NOW(), :messages_contenu)";

$sql -> bindParam(:messages_pseudo, $pseudo);


?>