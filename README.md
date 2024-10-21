# Blog developpé avec Laravel et TailwinCss

Une fois le téléchargement du projet terminé, décompressez le fichier du projet.

Ouvrez le dossier du projet, vérifiez le fichier env, et mettre à jour les informations d'identification de la base de données.

Créez une base de données MySQL avec le nom fourni à l'intérieur du fichier env.

Ensuite, ouvrez le projet dans le Terminal ou l’Invite de commandes .

Installer les dépendances du compositeur : composer install

Pour la base de données, créez une base de données avec le nom fourni dans le fichier env Lancer la commande : php artisan migrate

Ensuite, générez les seeders : php artisan db:seed

Et enfin, exécutez le projet : php artisan serve

Il démarrera l'application et vous donnera une URL.

Enfin, ouvrez l’URL dans votre navigateur préféré ; nous vous recommandons d’utiliser Google Chrome.

