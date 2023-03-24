# Makisine

## Comment développer sur notre projet?

### Github

1. S'assurer que Git est bien installé. S'il ne l'est pas, l'installer en suivant le lien : `https://git-scm.com/download/win`.
2. Pour commencer, il faudra "cloner" le projet dans son VSCode. Pour se faire, il suffit d'aller sur VSCode, ouvrir son terminal, se déplacer dans son répertoire XAMP, puis "htdocs" et cloner le projet dans ce fichier. Voici comment :
   En écrivant cette commande : `git clone https://github.com/TiziSil/Projet_Annuel_1ere_Annee.git` puis faire "entrer".

Une fois le projet cloner, il faudra utiliser, au même endroit, les commandes suivantes :

- `git checkout -b Hello` : pour créer et se positionner directement dans la branche "Hello". A partir d'ici, vous pourrez donc commencer à coder.
- Une fois que vous avez terminé de coder sur cette branche, tapez :
- `git add *` : pour ajouter tout le contenu que vous avez modifié. ATTENTION, cependant à \*, qui signifie TOUT ajouter, elle est assez dangereuse. C'est pourquoi, pour s'assurer que tout se passe bien et que vous ne faites pas d'erreur, vous allez taper :
- `git status` : pour vérifier où vous avez modifié du code (normalement, vous n'êtes censé n'avoir qu'une seule ligne, si vous avez modifié qu'un seul fichier).
- `git commit -m '' :  ici vous écrirez un descriptif rapide de ce que vous avez modifié"` ATTENTION, votre message doit commencer par une minuscule et non une majuscule et sans accent.
- `git push` : pour "pousser" la branche sur laquelle vous avez codé, sur la branche
  principale où nous trois avons accès.

#### Par la suite :

Faire une "Pull Request" à chaque fois que votre partie du code est terminé (pour que Github puisse comparer le code de la branche que vous avez créée et comparer la branche principale "Main", afin d'éviter tout conflit).  
Pour se faire, une fois que vous avez "pushé" votre branche, rendez-vous directement sur Github (https://github.com/TiziSil/Projet_Annuel_1ere_Annee), cliquer sur le bouton "Compare & Pull Request" et cliquer sur "Create Pull Request" en indiquant en titre, la description du code effectué.

Pour récupérer le code qui a été mis sur la branche principale :
`git checkout main` puis `git pull` et refaire les premières commande vues en haut de ce mémo.
