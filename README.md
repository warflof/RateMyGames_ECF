# **RateMyGames by GameSoft - Stalkez vos jeux favoris**
---
>RateMyGames est une application web permettant de suivre le développement des jeux du studio GameSoft.
Cela permet aux utilisateurs d'être tenu informés de l'avancé du développement et établi un ordre de priorité de développement pour les équipes techniques.

---

## Guide d'installation locale

### Prérequis

- Avoir Wamp d'installer sur son ordinateur.
- Configurez Wamp sur la version 8.0.26 de PHP.
- Téléchargez le fichier .zip depuis Github
- Décompressez l'archive et exporter les fichiers dans le dossier 'C:\wamp64\www'

### Variables d'environnements :

##### Configurez le fichier php.ini :

-  Dans le dossier C:\wamp64\bin\php\php8.0.26 , ouvrir le fichier 'php.ini' avec un éditeur de code (VSCode, SublimeText, etc.)
- Chercher dans le document (CTRL + F) '[mail function]'	
- Remplacer la ligne : 'SMTP = localhost' par 'SMTP = smtp.gmail.com'	
- Remplacer la ligne 'smtp_port = 25' par 'smtp_port = 587'	
- Remplacer la ligne 'sendmail_path' par 'sendmail_from ="admin@wampserver.invalid"'	
- Remplacer la ligne 'sendmail_path = " "' par sendmail_path = "*Chemin_des_fichiers_sources_du_site*\lib\sendmail.exe -t -i"
&nbsp;
##### Créez une base de données vide dans votre PHPMyAdmin et donnez lui le nom que vous souhaitez

- Éditez le fichier config.php (../lib/config.php)
- Changez le _DB_NAME, _USER_NAME, _PASSWORD afin de configurer l'accès à votre base de données
- Remplacez le nom du _TOKEN_URL par RateMyGamesECF-main.

#### Lancer l'application :

    - Dans votre navigateur, entrez cette URL : http://localhost/RateMyGamesECF-main/lib/importDb.php



