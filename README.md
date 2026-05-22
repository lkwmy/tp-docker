
<div align="center">

```
██████╗  ██████╗  ██████╗██╗  ██╗███████╗██████╗
██╔══██╗██╔═══██╗██╔════╝██║ ██╔╝██╔════╝██╔══██╗
██║  ██║██║   ██║██║     █████╔╝ █████╗  ██████╔╝
██║  ██║██║   ██║██║     ██╔═██╗ ██╔══╝  ██╔══██╗
██████╔╝╚██████╔╝╚██████╗██║  ██╗███████╗██║  ██║
╚═════╝  ╚═════╝  ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
```

# TP Docker — Flask API × PHP Apache

**Projet pédagogique** · Architecture multi-conteneurs · Docker Compose

[![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)
[![Python](https://img.shields.io/badge/Python_3.11-3776AB?style=for-the-badge&logo=python&logoColor=white)](https://www.python.org/)
[![Flask](https://img.shields.io/badge/Flask-000000?style=for-the-badge&logo=flask&logoColor=white)](https://flask.palletsprojects.com/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Apache](https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white)](https://httpd.apache.org/)

</div>

---

## ⚡ Vue d'ensemble

Ce projet met en place une infrastructure Docker complète composée de deux services interconnectés :

| Service | Technologie | Port |
|--------|-------------|------|
| 🐍 **API REST** | Python 3.11 + Flask | `5000` |
| 🌐 **Site Web** | PHP + Apache | `80` |

Les deux conteneurs communiquent via un **réseau Docker Compose interne**, sans exposition inutile au monde extérieur.

---

## 🗂️ Architecture du projet

```
tp-docker/
│
├── 🐳 docker-compose.yml      # Orchestration des deux services
├── 🐍 student_age.py          # API Flask (endpoint GET /pozos/api/v1.0/get_student_ages)
├── 📊 student_age.json        # Données des étudiants (monté en volume dans /data)
├── 📦 requirements.txt        # Dépendances Python
├── 📄 Dockerfile              # Image du conteneur API
├── 🌐 index.php               # Frontend PHP (appel API + affichage tableau)
│
└── 📁 website/                # Fichiers servis par Apache
```

---

## 🚀 Démarrage rapide

### 1. Cloner le dépôt

```bash
git clone https://github.com/lkwmy/tp-docker.git
cd tp-docker
```

### 2. Construire & lancer

```bash
docker-compose up --build
```

> 💡 L'API sera disponible sur `http://localhost:5000`
> Le site web sera accessible sur `http://localhost:80`

---

## 🔧 Commandes utiles

```bash
# ✅ Vérifier les conteneurs en cours
docker ps

# 📋 Suivre les logs en temps réel
docker-compose logs -f

# 🛑 Arrêter tous les conteneurs
docker-compose down

# 🔄 Rebuild complet (sans cache)
docker-compose build --no-cache

# 🐚 Entrer dans le conteneur API
docker exec -it tp-api-1 bash
```

---

## 📦 Détail des conteneurs

### 🐍 API Flask

> Conteneur léger basé sur **Python 3.11 Slim**

- Installe les dépendances système requises par `python-ldap`
- Expose le port **5000**
- Dépendances Python :

```txt
flask==2.3.3
flask-basicauth==0.2.0
python-ldap==3.4.4
```

### 🌐 Site Web Apache/PHP

> Basé sur l'image officielle **php:apache**

- Sert les pages PHP statiques et dynamiques
- Communique avec l'API via le réseau interne Docker
- Exemple d'appel vers l'API depuis PHP :

```php
$url = "http://api:5000/your-endpoint";
```

---

## 🌐 Réseau Docker

```
┌─────────────────────────────────────────┐
│           Docker Network (interne)       │
│                                         │
│  ┌──────────────┐    ┌───────────────┐  │
│  │  php:apache  │───▶│  Flask :5000  │  │
│  │  (website)   │    │  (api)        │  │
│  └──────────────┘    └───────────────┘  │
│         │                               │
└─────────┼───────────────────────────────┘
          ▼
     :80 (public)
```

Les services se trouvent sur le même réseau Compose et se résolvent par **nom de service** (`api`, `website`).

---

## 🛠️ Technologies utilisées

- **Docker** & **Docker Compose** — Conteneurisation et orchestration
- **Python 3.11** — Runtime de l'API
- **Flask** — Framework web léger pour l'API REST
- **Apache** — Serveur web du frontend
- **PHP** — Langage du site web
- **python-ldap** — Intégration annuaire LDAP

---

<div align="center">

Made with 🐳 & ☕ · Projet pédagogique Docker

</div>
