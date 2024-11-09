<?php

class ContactController{

    # Redirect to contact page
    public function index() {
        $view = new View("contact");
        return $view;
    }

    # Send a mail for contact
    public function send(){
        $nom = htmlspecialchars(trim($_POST["nom"]));
        $prenom = htmlspecialchars(trim($_POST["prenom"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = htmlspecialchars(trim($_POST["message"]));

        $view = new View("contact");

        // Vérification de l'adresse e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $view->addValue("isSend", false);
            return $view;
        }

        // Envoi
        if($this->gestionSMTP($email, $nom, $prenom, $message)){
            $view->addValue("isSend", true);
            return $view;
        }else {
            $view->addValue("isSend", false);
            return $view;
        }
    }

    # Gestion du serveur SMTP
    function gestionSMTP($from, $nom, $prenom, $message) {
        // Paramètres SMTP AlwaysData
        $smtp_host = 'smtp-vins.alwaysdata.net';
        $smtp_port = 587; // Port pour TLS
        $smtp_user = 'vins';  // Votre adresse email
        $smtp_pass = 'mcrroot';  // Votre mot de passe email
        $to = 'vincent.faure12@gmail.com';  // Adresse du destinataire
        $subject = 'Mail de ' . $nom . " " . $prenom;  // Sujet de l'email
    
        // Connexion sécurisée au serveur SMTP avec stream_socket_client
        $socket = stream_socket_client("tcp://$smtp_host:$smtp_port", $errno, $errstr, 30);
        if (!$socket) {
            return false;  // Si la connexion échoue, on retourne false
        }
    
        // Lire la réponse du serveur (mais sans echo)
        fgets($socket, 1024);
    
        // Envoi de la commande HELO
        fputs($socket, "HELO localhost\r\n");
        fgets($socket, 1024);
    
        // Demander la sécurisation de la connexion (STARTTLS)
        fputs($socket, "STARTTLS\r\n");
        $response = fgets($socket, 1024);
        if (strpos($response, '220') === false) {
            fclose($socket);
            return false;  // Si STARTTLS échoue, on ferme et on retourne false
        }
    
        // Sécuriser la connexion
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ]);
        $socket = stream_socket_client("tls://$smtp_host:$smtp_port", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $context);
    
        if (!$socket) {
            return false;  // Si la connexion sécurisée échoue, on retourne false
        }
    
        // Lire la réponse après sécurisation
        fgets($socket, 1024);
    
        // Authentification de l'utilisateur (LOGIN)
        fputs($socket, "AUTH LOGIN\r\n");
        fgets($socket, 1024);
    
        // Envoyer le nom d'utilisateur encodé en base64
        fputs($socket, base64_encode($smtp_user) . "\r\n");
        fgets($socket, 1024);
    
        // Envoyer le mot de passe encodé en base64
        fputs($socket, base64_encode($smtp_pass) . "\r\n");
        fgets($socket, 1024);
    
        // Spécifier l'adresse de l'expéditeur
        fputs($socket, "MAIL FROM: <$from>\r\n");
        fgets($socket, 1024);
    
        // Spécifier l'adresse du destinataire
        fputs($socket, "RCPT TO: <$to>\r\n");
        fgets($socket, 1024);
    
        // Envoyer les données de l'email
        fputs($socket, "DATA\r\n");
        fgets($socket, 1024);
    
        // Envoyer le contenu du message
        fputs($socket, "Subject: $subject\r\n");
        fputs($socket, "From: $from\r\n");
        fputs($socket, "To: $to\r\n");
        fputs($socket, "\r\n");  // Séparateur entre les entêtes et le corps
        fputs($socket, "$message\r\n");
    
        // Fin de la commande
        fputs($socket, "\r\n.\r\n");
        fgets($socket, 1024);
    
        // Terminer la connexion
        fputs($socket, "QUIT\r\n");
        fgets($socket, 1024);
    
        fclose($socket);
    
        return true;  // Tout s'est bien passé
    }
    
}