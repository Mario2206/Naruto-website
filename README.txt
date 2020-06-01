Le site web fonctionne à l'origine à l'aide d'un "virtual host" qui redirige toute connexion vers le dossier ./public et les différents chemins sont routés. Les dossiers
sont virtuels, une bonne configuration de l'url de base est donc nécessaire.

2 points de configuration dans le cas d'une configuration sans virtual host :  

1-Définir la constante INTER_DIR qui est dans le fichier /config/config.php. Indiquez à l'intérieur le chemin d'accès au répertoire /public à partir du dossier racine.
Exemple : Dans le cas de Xampp, localhost pointe sur le répertoire htdocs. INTER_DIR = "/raimbault-mathieu/public"

2-Pour certaines fonctionnalités, le site utilise du code Asynchrone, il faut donc spécifier l'url de base. Il suffit pour cela de se situer dans le fichier 
/public/js/package/Ajax.js et de modifier  la propriété domain en y intégrant "http://" + le nom de domaine + les différents sous dossiers qui permettent d'atteindre le répertoire /public/
Exemple : this.domain = http://localhost/raimbault-mathieu/public/

IMPORTANT : le "/" à la fin ne doit pas être spécifié dans le premier cas mais il est obligatoire pour le second .

Dans le cas de l'utilisation d'un virtual host, INTER_DIR = "" et this.domain = nom du virtual host


Le site utilise des fonctionnalités d'emailing, une configuration du serveur est nécessaire.