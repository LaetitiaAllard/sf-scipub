ekyn-learn/sf-scipub
=========



## Création d'une plate-forme de publication de travaux scientifiques.


Les scientifiques désireux de publier sur notre site auront à leur disposition un formulaire de saisi afin de nous soumettre leur travaux (publication).
 
Un espace d'administration permettra à nos modérateurs :
- la gestion des sciences (catégories de publication).
- la gestion des publications (notamment de valider celles soumises par les scientifiques en partie publique).

La partie publique présentera les publications validées, catégorisées par sciences.

### Notes techniques

Les templates de la partie administration seront placés dans le dossier *app/Resources/views*.

La partie publique sera entièrement développée dans le bundle *AppBundle*.

### Partie 1   

1. Créer les entitées *Science* et *Publication*. (Un jeu de test est disponible : *doctrine:fixtures:load*).

    ![Model](app/Resources/doc/model-1.jpg)

2. Développer la partie administration (CRUD):

    - Dans la liste des publications, masquer les colonnes _description_, et _contenu_.
    - Dans la liste des sciences, masquer la colonne description.

3. Développer la partie publique en utilisant les resources fournies par notre intégrateur/designer.

    Ces resources sont situées dans le dossier *integration* à la racine du projet.

    - **Page d'accueil** ( */* ) : afficher les 3 dernières publications (d'après la date de publication). 
Un lien sur le titre permettra d'accéder à la page détail de la publication.
    - **Sciences** ( */sciences* ) : afficher la listes des sciences, par ordre alphabétique. Un lien sur le titre permettra d'accéder à la page détail de la science.
    - **Science** ( */sciences/[id-science]* ) : afficher le détail de la science, et la liste des publications associées.
    - **Publication** ( */sciences/[id-science]/[id-publication]* ) : afficher le détail de la publication.
    - **Publier** ( */publier* ) : afficher un formulaire permettant aux scientifiques de nous soumettre leur publication. 

4. Mettre en place une validation des données (Validator component).

5. Sécuriser la partie administration avec le compte :
    
    - Utilisateur  : **sciAdmin**
    - Mot de passe : **e=mc2**

### Partie 2

1. Modifier la mise en page de la partie publique : dans les pages détail **Science** et **Publication**, afficher une '*sidebar*' présentant la liste des sciences sous forme de liens vers les pages détail **Science** respectives. 

2. Créer un service (DI) de notification (AppBundle\Service\Notifier). Lors de la soumission d'une nouvelle publication par un scientifique, appeler la méthode *notify()* de ce service pour informer les modérateurs. 

### Partie 3

La gestion des sciences et des publications mise en place, nous souhaitons donner la possibilité aux internautes de commenter les publications. Nos modérateurs devront valider les commentaires avant que ces derniers ne soient visibles en partie publique.

1. Créer l'entité Commentaire et l'associer aux publications.

    ![Model](app/Resources/doc/model-2.jpg)

2. Ajouter la gestion des commentaires à l'administation.

2. Ajouter un formulaire de saisie de commentaire dans la page détail **Publication** de la partie publique.

3. Afficher la liste des commentaires validés entre le détail de la publication et le formulaire de saisie de commentaire.  

