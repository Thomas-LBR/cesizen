# Cahier de tests synthétique

## Comptes utilisateurs

| Scénario | Précondition | Action | Résultat attendu |
| --- | --- | --- | --- |
| Création de compte | Visiteur non connecté | Remplir le formulaire d'inscription | Le compte est créé et l'utilisateur peut se connecter |
| Connexion valide | Compte actif existant | Saisir email et mot de passe corrects | L'utilisateur accède à l'application |
| Connexion invalide | Compte existant | Saisir un mauvais mot de passe | Un message d'erreur est affiché |
| Désactivation | Administrateur connecté | Désactiver un compte | Le compte ne peut plus se connecter |

## Informations

| Scénario | Précondition | Action | Résultat attendu |
| --- | --- | --- | --- |
| Consultation | Page publiée existante | Ouvrir une page d'information | Le contenu est affiché |
| Création | Administrateur connecté | Créer une page publiée | La page apparaît côté public |
| Brouillon | Administrateur connecté | Dépublier une page | La page n'est plus accessible côté public |

## Diagnostic de stress

| Scénario | Précondition | Action | Résultat attendu |
| --- | --- | --- | --- |
| Diagnostic visiteur | Visiteur anonyme | Sélectionner des événements et calculer | Le score est affiché sans sauvegarde |
| Diagnostic connecté | Utilisateur connecté | Sélectionner des événements et calculer | Le score est affiché et enregistré |
| Seuil faible | Score inférieur à 150 | Calculer le diagnostic | Le niveau est "Stress faible" |
| Seuil modéré | Score entre 150 et 299 | Calculer le diagnostic | Le niveau est "Stress modéré" |
| Seuil élevé | Score supérieur ou égal à 300 | Calculer le diagnostic | Le niveau est "Stress élevé" |
| Configuration | Administrateur connecté | Modifier les points d'un événement | Le questionnaire utilise la nouvelle valeur |
