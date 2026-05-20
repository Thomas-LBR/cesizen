# Cahier de tests CESIZen

## Objectif

Ce cahier de tests formalise les scénarios utilisés pour valider l'application CESIZen. Il couvre les trois familles demandées :

- tests unitaires ;
- tests fonctionnels ;
- tests de non-régression.

Les deux modules obligatoires retenus sont :

- comptes utilisateurs et authentification ;
- diagnostic de stress.

Le module au choix retenu est :

- pages d'information.

## Automatisation

Les tests automatisés sont implémentés avec PHPUnit et l'outillage de test CodeIgniter.

Commande Docker :

```bash
docker compose exec app vendor/bin/phpunit
```

Commande locale :

```bash
vendor/bin/phpunit
```

La configuration est centralisée dans `phpunit.xml.dist`. Les rapports générés sont disponibles dans `build/logs/` :

- `testdox.txt` ;
- `testdox.html` ;
- `logfile.xml`.

## Synthèse des tests automatisés

| Type | Fichiers | Objectif |
| --- | --- | --- |
| Unitaires | `tests/unit/HolmesRaheDiagnosticServiceTest.php` | Vérifier le calcul du score et les niveaux de stress |
| Unitaires | `tests/unit/DiagnosticResultConfigModelTest.php` | Vérifier l'ordre des configurations de résultat |
| Fonctionnels | `tests/feature/AuthFeatureTest.php` | Vérifier les accès connexion, compte et administration |
| Fonctionnels | `tests/feature/DiagnosticFeatureTest.php` | Vérifier l'accès au questionnaire, à l'historique et à la configuration admin |
| Fonctionnels | `tests/feature/InformationPagesFeatureTest.php` | Vérifier l'affichage des pages d'information |
| Non-régression | `tests/feature/PwaRegressionTest.php` | Vérifier les éléments PWA et le formulaire de connexion mobile |

## Tests unitaires

### Diagnostic de stress

| ID | Scénario | Données | Résultat attendu | Automatisé |
| --- | --- | --- | --- | --- |
| TU-DIAG-001 | Score faible | 40 + 30 points | Score `70`, niveau `Stress faible` | Oui |
| TU-DIAG-002 | Score modéré | 100 + 73 points | Score `173`, niveau `Stress modéré` | Oui |
| TU-DIAG-003 | Score élevé | 100 + 73 + 65 + 63 points | Score `301`, niveau `Stress élevé` | Oui |
| TU-DIAG-004 | Configuration personnalisée | Seuil admin `0-120` | Le niveau et le message configurés sont utilisés | Oui |

### Configuration des résultats

| ID | Scénario | Données | Résultat attendu | Automatisé |
| --- | --- | --- | --- | --- |
| TU-CONF-001 | Tri des seuils | Configurations 300, 0, 150 | Retour dans l'ordre 0, 150, 300 | Oui |

## Tests fonctionnels

### Module comptes utilisateurs

| ID | Scénario | Précondition | Action | Résultat attendu | Automatisé |
| --- | --- | --- | --- | --- | --- |
| TF-AUTH-001 | Affichage de la connexion | Visiteur anonyme | Ouvrir `/connexion` | Le formulaire email/mot de passe s'affiche | Oui |
| TF-AUTH-002 | Protection du compte | Visiteur anonyme | Ouvrir `/compte` | Redirection vers la connexion | Oui |
| TF-AUTH-003 | Accès administrateur | Session admin | Ouvrir `/admin` | Le tableau de bord s'affiche | Oui |
| TF-AUTH-004 | Refus utilisateur simple | Session utilisateur | Ouvrir `/admin` | Redirection hors administration | Oui |
| TF-AUTH-005 | Connexion valide | Compte actif existant | Saisir email et mot de passe corrects | L'utilisateur accède à son espace | Manuel |
| TF-AUTH-006 | Connexion invalide | Compte existant | Saisir un mauvais mot de passe | Un message d'erreur est affiché | Manuel |

### Module diagnostic de stress

| ID | Scénario | Précondition | Action | Résultat attendu | Automatisé |
| --- | --- | --- | --- | --- | --- |
| TF-DIAG-001 | Affichage du questionnaire | Données de démonstration chargées | Ouvrir `/diagnostic` | Les événements et le bouton de calcul sont visibles | Oui |
| TF-DIAG-002 | Historique protégé | Visiteur anonyme | Ouvrir `/diagnostic/resultats` | Redirection vers la connexion | Oui |
| TF-DIAG-003 | Historique utilisateur | Session utilisateur | Ouvrir `/diagnostic/resultats` | La page d'historique s'affiche | Oui |
| TF-DIAG-004 | Configuration admin des résultats | Session admin | Ouvrir `/admin/diagnostic/resultats` | La liste déroulante de configuration s'affiche | Oui |
| TF-DIAG-005 | Diagnostic visiteur | Visiteur anonyme | Sélectionner des événements puis calculer | Le score s'affiche sans sauvegarde | Manuel |
| TF-DIAG-006 | Diagnostic connecté | Session utilisateur | Sélectionner des événements puis calculer | Le score s'affiche et l'historique est alimenté | Manuel |

### Module pages d'information

| ID | Scénario | Précondition | Action | Résultat attendu | Automatisé |
| --- | --- | --- | --- | --- | --- |
| TF-INF-001 | Affichage des informations en accueil | Pages publiées existantes | Ouvrir `/` | Les pages publiées apparaissent | Oui |
| TF-INF-002 | Consultation d'une page publiée | Page publiée existante | Ouvrir `/page/comprendre-le-stress` | Le contenu est affiché | Oui |
| TF-INF-003 | Exclusion des brouillons | Page non publiée | Appeler le scope `published()` | La page brouillon n'est pas retournée | Oui |
| TF-INF-004 | Création d'une page | Session admin | Créer une page publiée | La page apparaît côté public | Manuel |
| TF-INF-005 | Dépublication | Session admin | Passer une page en brouillon | La page n'est plus accessible côté public | Manuel |

## Tests de non-régression

| ID | Scénario | Risque couvert | Résultat attendu | Automatisé |
| --- | --- | --- | --- | --- |
| TNR-001 | Santé de la configuration | Régression de bootstrap CodeIgniter | `APPPATH` existe et `baseURL` reste valide | Oui |
| TNR-002 | PWA déclarée dans le layout | Perte de l'installation mobile | Le layout contient manifest, service worker et theme color | Oui |
| TNR-003 | Manifest valide | Régression de l'installation PWA | Le manifest contient `CESIZen`, `standalone`, `/` | Oui |
| TNR-004 | Connexion mobile | Régression du login sur Safari mobile | Le formulaire a une action explicite vers `/connexion` | Oui |
| TNR-005 | CSS responsive | Régression visuelle mobile | Le bouton d'inscription reste positionnable via `.register-link` | Manuel |
| TNR-006 | Docker MariaDB | Régression d'environnement | L'application utilise MariaDB dans Docker et les migrations passent | Manuel |

## Recette manuelle conseillée

Avant livraison, exécuter les vérifications suivantes :

1. Lancer l'environnement Docker avec `docker compose up -d`.
2. Ouvrir l'application sur PC : `http://localhost:8080`.
3. Ouvrir l'application sur mobile via l'IP du PC : `http://<ip-du-pc>:8080`.
4. Se connecter avec `admin@cesizen.test / Admin123!`.
5. Configurer un message de résultat dans `/admin/diagnostic/resultats`.
6. Réaliser un diagnostic anonyme et vérifier l'absence de sauvegarde.
7. Réaliser un diagnostic connecté et vérifier la présence dans l'historique.
8. Créer ou modifier une page d'information en admin.
9. Vérifier l'installation PWA depuis Safari mobile.
10. Relancer `docker compose exec app vendor/bin/phpunit` avant commit.
