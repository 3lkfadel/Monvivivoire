monvivivoire/
├── app/                # Contrôleurs, modèles, middlewares
├── database/           # Migrations et seeders
├── public/             # Assets publics, stockage d'images
├── resources/          # Fichiers Blade (vues) et assets frontaux
├── routes/             # Fichiers de routes (web.php, api.php)
├── storage/            # Stockage de fichiers et logs
├── tests/              # Tests unitaires et fonctionnels
├── .env.example        # Fichier d'exemple de configuration
├── package.json        # Gestion des dépendances JS
└── composer.json       # Gestion des dépendances PHP



Fonctionnalités futures

Notifications en temps réel.
Intégration d'un système de paiement.
Suggestions intelligentes via l'IA pour des produits similaires.


Crédits

Développé par : Bat family

Licence : [Spécifier la licence, ex. De la bat family ]

# **Monvivivoire** - Chat avec IA et Gestion de Produits

### Description
**Monvivivoire** est une plateforme Laravel combinant une place de marché et un système de chat interactif. Les utilisateurs peuvent acheter et vendre des produits tout en interagissant avec une IA intégrée pour poser des questions ou obtenir de l'assistance.

---

## **Fonctionnalités principales**
1. **Gestion des produits :**
   - Ajout, modification et suppression de produits.
   - Filtrage par catégorie, localisation et prix.
   - Affichage des produits avec images.

2. **Chat interactif avec IA :**
   - Posez des questions générales ou spécifiques.
   - Assistance en temps réel via un chatbot.

3. **Système de recherche avancée :**
   - Recherche par mots-clés.
   - Filtres par catégories et localisation.

4. **Gestion utilisateur :**
   - Enregistrement et authentification.
   - Profil utilisateur avec historique des interactions.

---

## **Installation**

### **Prérequis**
- PHP >= 8.1
- Composer
- Laravel 10.x
- MySQL ou tout autre SGBD compatible.
- Node.js et NPM pour la gestion des assets.

### **Étapes d'installation**
1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/votre-repository/monvivivoire.git
   cd monvivivoire



commande a exécuté 

-composer install
npm install
npm run build
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=monvivivoire
DB_USERNAME=root
DB_PASSWORD=yourpassword

php artisan key:generate

php artisan migrate --seed


php artisan storage:link


php artisan serve

fin 

liens figma : https://www.figma.com/design/cnBLL6NqxpwjJ9cdKTWsOp/Untitled?node-id=1-2&t=RzhdLLboilTf6CEf-1

le dossier présentation comporte la présentation power points 
