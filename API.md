# API Documentation

## Base URL
```
http://localhost:8090/api
```

## Authentication
Currently no authentication is implemented. This is a base project ready for development.

## Endpoints

### Health Check
```http
GET /api/health
```

**Response:**
```json
{
    "status": 200,
    "message": "System is healthy",
    "data": {
        "status": "healthy",
        "timestamp": "2025-10-23 12:15:48",
        "version": "1.0.0",
        "environment": "development",
        "database": true,
        "services": {
            "web": "running",
            "database": "connected"
        }
    }
}
```

### Users

#### Get All Users
```http
GET /api/users
```

#### Get User by ID
```http
GET /api/users/{id}
```

#### Create User
```http
POST /api/users
Content-Type: application/json

{
    "username": "newuser",
    "email": "newuser@example.com",
    "password": "password123",
    "first_name": "New",
    "last_name": "User",
    "is_active": 1
}
```

#### Update User
```http
PUT /api/users/{id}
Content-Type: application/json

{
    "username": "updateduser",
    "email": "updated@example.com",
    "first_name": "Updated",
    "last_name": "User"
}
```

#### Delete User
```http
DELETE /api/users/{id}
```

#### Get Active Users Only
```http
GET /api/users/active
```

## Response Format

All API responses follow this format:

```json
{
    "status": 200,
    "message": "Success message",
    "data": {
        // Response data
    }
}
```

## Error Responses

### 400 Bad Request
```json
{
    "status": 400,
    "message": "Bad Request",
    "data": null
}
```

### 404 Not Found
```json
{
    "status": 404,
    "message": "User not found",
    "data": null
}
```

### 422 Validation Error
```json
{
    "status": 422,
    "message": "Validation failed",
    "data": {
        "username": "Username is required",
        "email": "Please enter a valid email address"
    }
}
```

## Testing with cURL

### Health Check
```bash
curl -X GET http://localhost:8090/api/health
```

### Get All Users
```bash
curl -X GET http://localhost:8090/api/users
```

### Create User
```bash
curl -X POST http://localhost:8090/api/users \
  -H "Content-Type: application/json" \
  -d '{
    "username": "testuser",
    "email": "test@example.com",
    "password": "password123",
    "first_name": "Test",
    "last_name": "User"
  }'
```

### Update User
```bash
curl -X PUT http://localhost:8090/api/users/1 \
  -H "Content-Type: application/json" \
  -d '{
    "username": "updateduser",
    "email": "updated@example.com"
  }'
```

### Delete User
```bash
curl -X DELETE http://localhost:8090/api/users/1
```
