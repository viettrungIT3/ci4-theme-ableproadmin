# CI4 Base Project

A clean CodeIgniter 4 base project with Docker setup for development.

## 🚀 Features

- **CodeIgniter 4** with PHP 8.2
- **Docker** setup for development
- **MySQL 8.0** database
- **Basic project structure** ready for development

## 📋 Prerequisites

- Docker & Docker Compose
- Make (required for all commands)

## 🛠️ Quick Start

### 1. Setup

```bash
# Switch to development environment
make dev-env

# Complete setup
make setup   # build + up + composer + migrate
```

### 2. Start Development Environment

```bash
make up
```

### 3. Access Application

- **Web Application**: http://localhost:8090
- **Database**: localhost:3308 (MySQL)

## 🔧 Development Commands

### Using Makefile

```bash
# Core
make help              # Show help
make setup             # Build, start, install, migrate
make up                # Start services
make down              # Stop services
make logs              # View logs
make shell             # Open shell in web container
make composer-install  # Run composer install
make status            # Show container status
make info              # Show project info

# Database
make migrate           # Run migrations
make db-backup         # Backup database
make db-restore FILE=backup.sql  # Restore database

# Quality & Tests
make quality           # Lint + static analysis
make test              # Run tests
make test-coverage     # Generate coverage report

# Production
make prod-build        # Build production images
make prod-up           # Start production services
make prod-down         # Stop production services

# Cleanup
make clean             # Remove containers/images/volumes
```

## 🗄️ Database

The database is automatically initialized with basic CI4 structure.

## 📁 Project Structure

```
ci4-base/
├── docker/                    # Docker configurations
│   ├── apache/               # Apache Dockerfile & config
│   └── mysql/                # MySQL Dockerfile & init scripts
├── src/                      # CodeIgniter 4 application
│   ├── app/                  # Application code
│   │   ├── Controllers/      # Controllers
│   │   ├── Models/           # Models
│   │   ├── Database/         # Migrations & Seeds
│   │   └── Views/            # Views
│   ├── public/               # Web root
│   └── composer.json         # PHP dependencies
├── docker-compose.yml        # Development services
├── docker-compose.prod.yml   # Production overrides
├── Makefile                  # Development commands
└── README.md                 # This file
```

## 🌍 Environment Management

Project uses **single `.env` file** with `ENVIRONMENT` variable:

### **Environment Switching**
```bash
make dev-env    # Switch to development
make prod-env   # Switch to production
make env-status # Check current environment
```

### **Automatic Configuration**
- **Development:** Port 8090, database ci4, 256M memory
- **Production:** Port 80, database ci4_prod, 512M memory
- **Auto-overrides:** Makefile automatically applies production settings

See [ENVIRONMENT.md](ENVIRONMENT.md) for detailed configuration.

## 🔧 Configuration

### Environment Variables

Key variables in `.env` file:

```bash
ENVIRONMENT=development                    # Environment type
SERVICE_PORT=8090                          # Web server port
MYSQL_DATABASE=ci4                         # Database name
MYSQL_ROOT_PASSWORD=secret                 # Database password
MYSQL_PORT=3308                            # Database port
MYSQL_HOSTNAME=codeigniter4-db.localhost.com # Database host
UID=1000                                   # Local user id for container
```

**Production overrides** (applied automatically when `ENVIRONMENT=production`):
- `SERVICE_PORT=80`
- `MYSQL_DATABASE=ci4_prod`
- `MYSQL_ROOT_PASSWORD=your-secure-production-password`
- `MYSQL_PORT=3306`
- `MYSQL_HOSTNAME=db.yourdomain.com`

## 📄 License

This project is licensed under the MIT License.
