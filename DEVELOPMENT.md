# Development Guide

## 🚀 Getting Started

### Prerequisites
- Docker & Docker Compose
- Make (for development commands)

### Quick Setup
```bash
# Clone and setup
git clone <repository-url>
cd ci4-theme-ableproadmin

# Copy environment file
cp .env.example .env

# Complete setup
make setup
```

## 🏗️ Project Structure

```
ci4-base/
├── docker/                    # Docker configurations
│   ├── apache/               # Apache Dockerfile & config
│   └── mysql/                # MySQL Dockerfile & init scripts
├── src/                      # CodeIgniter 4 application
│   ├── app/                  # Application code
│   │   ├── Controllers/      # Controllers
│   │   │   ├── Api/          # API Controllers
│   │   │   ├── ApiController.php  # Base API Controller
│   │   │   ├── Users.php     # Users API Controller
│   │   │   └── Home.php      # Home Controller
│   │   ├── Models/           # Models
│   │   │   └── UserModel.php # User Model
│   │   ├── Database/         # Migrations & Seeds
│   │   │   └── Migrations/   # Database migrations
│   │   ├── Config/           # Configuration
│   │   │   ├── Routes.php    # Main routes
│   │   │   └── Routes/       # Route files
│   │   │       └── api.php   # API routes
│   │   └── Views/            # Views
│   ├── public/               # Web root
│   └── composer.json         # PHP dependencies
├── docker-compose.yml        # Development services
├── docker-compose.prod.yml   # Production overrides
├── Makefile                  # Development commands
├── API.md                    # API Documentation
└── README.md                 # Project documentation
```

## 🔧 Development Commands

### Core Commands
```bash
make help              # Show all available commands
make setup             # Complete setup (build + up + composer + migrate)
make up                # Start services in background
make down              # Stop and remove containers
make restart           # Restart all services
make status            # Show container status
make logs              # Show logs from all services
make shell             # Open shell in web container
```

### Database Commands
```bash
make migrate           # Run database migrations
make migrate-create NAME=CreateTableName  # Create new migration
make db-backup         # Backup database
make db-restore FILE=backup.sql  # Restore database
```

### Code Quality
```bash
make quality           # Run all code quality checks
make lint              # Run PHP CS Fixer (dry run)
make lint-fix          # Fix code style issues
make stan              # Run PHPStan static analysis
```

### Testing
```bash
make test              # Run PHPUnit tests
make test-coverage     # Run tests with coverage report
```

## 🗄️ Database

### Migrations
The project includes a basic User migration with:
- User table with username, email, password
- Proper indexes for performance
- Timestamps (created_at, updated_at)
- Soft delete support ready

### Models
- `UserModel` - Complete user management with validation
- Password hashing on insert/update
- Active user filtering
- Email/username lookup methods

## 🔌 API Development

### Base API Controller
All API controllers should extend `ApiController` which provides:
- Standardized JSON responses
- Success/error response helpers
- Validation error handling
- Consistent response format

### API Routes
- Health check: `GET /api/health`
- User management: `GET|POST|PUT|DELETE /api/users`
- Active users: `GET /api/users/active`

### Response Format
```json
{
    "status": 200,
    "message": "Success message",
    "data": {
        // Response data
    }
}
```

## 🧪 Testing

### Running Tests
```bash
make test              # Run all tests
make test-coverage     # Generate coverage report
```

### Test Structure
```
src/tests/
├── Feature/           # Feature tests
├── Unit/              # Unit tests
└── _support/          # Test support files
```

## 🚀 Production Deployment

### Build for Production
```bash
make prod-build        # Build production images
make prod-up           # Start production services
make prod-down         # Stop production services
```

### Production Considerations
- Environment variables in production
- Database security
- SSL/TLS configuration
- Performance optimization
- Monitoring and logging

## 🔍 Troubleshooting

### Common Issues

#### Container Issues
```bash
make logs              # Check all logs
make logs-web          # Check web service logs
make logs-db           # Check database logs
```

#### Database Connection
```bash
make shell-db          # Open MySQL shell
# Test connection inside container
```

#### Permission Issues
```bash
# Check container permissions
make shell
ls -la /var/www/html/
```

### Health Checks
```bash
make health            # Check application health
curl http://localhost:8090/api/health  # API health check
```

## 📝 Code Standards

### PHP Code Style
- Follow PSR-12 standards
- Use `make lint-fix` to auto-fix issues
- Run `make stan` for static analysis

### Database
- Use migrations for schema changes
- Add proper indexes for performance
- Use foreign keys for relationships

### API Design
- RESTful endpoints
- Consistent response format
- Proper HTTP status codes
- Input validation

## 🎯 Next Steps

1. **Authentication**: Add JWT or session-based auth
2. **Authorization**: Implement role-based access control
3. **Validation**: Add more comprehensive input validation
4. **Testing**: Write comprehensive test suite
5. **Documentation**: Add more detailed API docs
6. **Monitoring**: Add logging and monitoring
7. **Security**: Implement security best practices
