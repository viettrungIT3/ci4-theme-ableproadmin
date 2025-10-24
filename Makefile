# CI4 Base Project Makefile
# Usage: make [target]

# Load environment variables
ifneq (,$(wildcard ./.env))
    include .env
    export
endif

# Environment detection
ENVIRONMENT ?= development

# Default configuration
SERVICE_PORT ?= 8090
MYSQL_PORT ?= 3308
MYSQL_DATABASE ?= ci4
MYSQL_ROOT_PASSWORD ?= secret
MYSQL_HOSTNAME ?= codeigniter4-db.localhost.com
UID ?= 1000
COMPOSE_PROJECT_NAME ?= ci4-base
PHP_MEMORY_LIMIT ?= 256M
MYSQL_INNODB_BUFFER_POOL_SIZE ?= 128M
TZ ?= Asia/Ho_Chi_Minh

# Production overrides
ifeq ($(ENVIRONMENT),production)
    SERVICE_PORT = 80
    MYSQL_PORT = 3306
    MYSQL_DATABASE = ci4_prod
    MYSQL_ROOT_PASSWORD = your-secure-production-password
    MYSQL_HOSTNAME = db.yourdomain.com
    COMPOSE_PROJECT_NAME = ci4-prod
    PHP_MEMORY_LIMIT = 512M
    MYSQL_INNODB_BUFFER_POOL_SIZE = 256M
endif

# Docker compose files
COMPOSE_FILE = docker-compose.yml
COMPOSE_PROD_FILE = docker-compose.prod.yml
DOCKER_COMPOSE = docker compose -f $(COMPOSE_FILE)
DOCKER_COMPOSE_PROD = docker compose -f $(COMPOSE_FILE) -f $(COMPOSE_PROD_FILE)

# Container names
WEB_CONTAINER = codeigniter4-services
DB_CONTAINER = codeigniter4-db

# Directories
DB_BACKUP_DIR = _db
TESTS_DIR = src/tests
COVERAGE_DIR = src/tests/coverage

.PHONY: help build up down restart logs shell composer test clean setup

# Default target
help: ## Show this help message
	@echo "CI4 Base Project - Available commands:"
	@echo ""
	@echo "🚀 Core Commands:"
	@echo "  make setup          Complete setup for new developers"
	@echo "  make up             Start services in background"
	@echo "  make down           Stop and remove containers"
	@echo "  make restart        Restart all services"
	@echo "  make status         Show container status"
	@echo "  make logs           Show logs from all services"
	@echo "  make shell          Open shell in web container"
	@echo ""
	@echo "🌍 Environment:"
	@echo "  make dev-env        Switch to development environment"
	@echo "  make prod-env       Switch to production environment"
	@echo "  make env-status     Show current environment status"
	@echo ""
	@echo "📦 Composer:"
	@echo "  make composer-install      Run composer install in container"
	@echo "  make composer-update 		Run composer update in container"
	@echo ""
	@echo "🗄️  Database:"
	@echo "  make migrate        Run database migrations"
	@echo "  make migrate-create Create new migration (usage: make migrate-create NAME=CreateUsersTable)"
	@echo "  make db-backup      Backup database to _db/backup.sql"
	@echo "  make db-restore     Restore database from _db/backup.sql (usage: make db-restore FILE=backup.sql)"
	@echo ""
	@echo "🧪 Testing:"
	@echo "  make test           Run PHPUnit tests"
	@echo "  make test-coverage  Run tests with coverage report"
	@echo ""
	@echo "🔍 Code Quality:"
	@echo "  make quality        Run all code quality checks (lint + stan)"
	@echo ""
	@echo "🏭 Production:"
	@echo "  make prod-build     Build for production"
	@echo "  make prod-up        Start production services"
	@echo "  make prod-down      Stop production services"
	@echo ""
	@echo "🔄 Workflow:"
	@echo "  make dev-start      Start development environment"
	@echo "  make dev-reset      Reset development environment"
	@echo "  make health         Check application health"
	@echo "  make clean          Clean up containers, images, and volumes"

# Docker commands
build: ## Build Docker images
	$(DOCKER_COMPOSE) build

up: ## Start services in background
	$(DOCKER_COMPOSE) up -d

down: ## Stop and remove containers
	$(DOCKER_COMPOSE) down

restart: down up ## Restart all services

logs: ## Show logs from all services
	$(DOCKER_COMPOSE) logs -f

shell: ## Open shell in web container
	$(DOCKER_COMPOSE) exec $(WEB_CONTAINER) bash

# Development commands
composer-install: ## Run composer install in container
	$(DOCKER_COMPOSE) exec -w /var/www/html $(WEB_CONTAINER) composer install

composer-update: ## Run composer update in container
	$(DOCKER_COMPOSE) exec -w /var/www/html $(WEB_CONTAINER) composer update

# Database commands
db-backup: ## Backup database to _db/backup.sql
	@mkdir -p $(DB_BACKUP_DIR)
	$(DOCKER_COMPOSE) exec $(DB_CONTAINER) mysqldump -u root -p$(MYSQL_ROOT_PASSWORD) $(MYSQL_DATABASE) > $(DB_BACKUP_DIR)/backup_$(shell date +%Y%m%d_%H%M%S).sql
	@echo "✅ Database backed up to $(DB_BACKUP_DIR)/backup_$(shell date +%Y%m%d_%H%M%S).sql"

db-restore: ## Restore database from _db/backup.sql (usage: make db-restore FILE=backup.sql)
	$(DOCKER_COMPOSE) exec -T $(DB_CONTAINER) mysql -u root -p$(MYSQL_ROOT_PASSWORD) $(MYSQL_DATABASE) < $(DB_BACKUP_DIR)/$(FILE)
	@echo "✅ Database restored from $(DB_BACKUP_DIR)/$(FILE)"

migrate: ## Run database migrations
	$(DOCKER_COMPOSE) exec -w /var/www/html $(WEB_CONTAINER) php spark migrate -n
	@echo "✅ Database migrations completed"

migrate-create: ## Create new migration (usage: make migrate-create NAME=CreateUsersTable)
	$(DOCKER_COMPOSE) exec -w /var/www/html $(WEB_CONTAINER) php spark make:migration $(NAME)
	@echo "✅ Migration $(NAME) created"

# Testing commands
test: ## Run PHPUnit tests
	$(DOCKER_COMPOSE) exec -w /var/www/html $(WEB_CONTAINER) ./vendor/bin/phpunit
	@echo "✅ Tests completed"

test-coverage: ## Run tests with coverage report
	@mkdir -p $(COVERAGE_DIR)
	$(DOCKER_COMPOSE) exec -w /var/www/html $(WEB_CONTAINER) ./vendor/bin/phpunit --coverage-html $(COVERAGE_DIR)
	@echo "✅ Coverage report generated in $(COVERAGE_DIR)"

# Code quality commands
quality: ## Run all code quality checks
	@echo "🔍 Running code quality checks..."
	$(DOCKER_COMPOSE) exec -w /var/www/html $(WEB_CONTAINER) ./vendor/bin/php-cs-fixer fix
	$(DOCKER_COMPOSE) exec -w /var/www/html $(WEB_CONTAINER) ./vendor/bin/phpstan analyse
	@echo "✅ All quality checks completed"

# Utility commands
clean: ## Clean up containers, images, and volumes
	$(DOCKER_COMPOSE) down -v --rmi all
	docker system prune -f
	@echo "✅ Cleanup completed"

status: ## Show container status
	$(DOCKER_COMPOSE) ps

info: ## Show project information
	@echo "🚀 CI4 Base Project"
	@echo "�� Service Port: $(SERVICE_PORT)"
	@echo "🗄️  Database: $(MYSQL_DATABASE) on port $(MYSQL_PORT)"
	@echo "🌐 Web URL: http://localhost:$(SERVICE_PORT)"
	@echo "📊 Database URL: localhost:$(MYSQL_PORT)"

# Production commands
prod-build: ## Build for production
	@echo "🏭 Building for production environment..."
	@make prod-env
	$(DOCKER_COMPOSE_PROD) build
	@echo "✅ Production build completed"

prod-up: ## Start production services
	@echo "🏭 Starting production services..."
	@make prod-env
	$(DOCKER_COMPOSE_PROD) up -d
	@echo "✅ Production services started"
	@echo "🌐 Production URL: http://localhost:$(SERVICE_PORT)"

prod-down: ## Stop production services
	@echo "🏭 Stopping production services..."
	$(DOCKER_COMPOSE_PROD) down
	@echo "✅ Production services stopped"

# Quick setup for new developers
setup: dev-env build up composer migrate ## Complete setup for new developers
	@echo ""
	@echo "🎉 Setup complete!"
	@echo "🌐 Web Application: http://localhost:$(SERVICE_PORT)"
	@echo "🗄️  Database: localhost:$(MYSQL_PORT)"
	@echo "📊 Status: make status"
	@echo "📝 Logs: make logs"
	@echo ""

# Development workflow
dev-start: dev-env up composer migrate ## Start development environment
	@echo "🚀 Development environment ready!"

dev-reset: dev-env clean build up composer migrate ## Reset development environment
	@echo "🔄 Development environment reset!"

# Health checks
health: ## Check application health
	@echo "🔍 Checking application health..."
	@curl -s http://localhost:$\(SERVICE_PORT\) > /dev/null && echo "✅ Web application is running" || echo "❌ Web application is not responding"
	@$(DOCKER_COMPOSE) ps | grep -q "Up" && echo "✅ Containers are running" || echo "❌ Some containers are not running"

# Environment management
dev-env: ## Switch to development environment
	@echo "🔄 Switching to development environment..."
	@sed -i.bak 's/ENVIRONMENT=.*/ENVIRONMENT=development/' .env
	@echo "✅ Development environment activated"
	@echo "📋 Current settings:"
	@echo "   Environment: $(ENVIRONMENT)"
	@echo "   Service Port: $(SERVICE_PORT)"
	@echo "   Database: $(MYSQL_DATABASE)"
	@echo "   Project: $(COMPOSE_PROJECT_NAME)"

prod-env: ## Switch to production environment
	@echo "🔄 Switching to production environment..."
	@sed -i.bak 's/ENVIRONMENT=.*/ENVIRONMENT=production/' .env
	@echo "✅ Production environment activated"
	@echo "📋 Current settings:"
	@echo "   Environment: $(ENVIRONMENT)"
	@echo "   Service Port: $(SERVICE_PORT)"
	@echo "   Database: $(MYSQL_DATABASE)"
	@echo "   Project: $(COMPOSE_PROJECT_NAME)"

env-status: ## Show current environment status
	@echo "🌍 Current Environment Status:"
	@echo ""
	@if [ -f .env ]; then \
		echo "✅ Environment file: .env"; \
		echo "📋 Current configuration:"; \
		echo "   Environment: $(ENVIRONMENT)"; \
		echo "   Service Port: $(SERVICE_PORT)"; \
		echo "   Database: $(MYSQL_DATABASE)"; \
		echo "   Project: $(COMPOSE_PROJECT_NAME)"; \
		echo "   Memory Limit: $(PHP_MEMORY_LIMIT)"; \
		echo "   Timezone: $(TZ)"; \
	else \
		echo "❌ No .env file found"; \
		echo "💡 Run 'make dev-env' or 'make prod-env' to set up environment"; \
	fi
