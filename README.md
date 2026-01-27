# FitBest API

FitBest API is the backend developed with Laravel to manage the business logic and data for the FitBest platform. This API is containerized using Docker to facilitate deployment and development.

## 🚀 Project Context

This project serves as the core service hub for the FitBest application. It provides RESTful endpoints for user management and other related resources.

### Main Technologies
- **Framework**: Laravel 12.x (PHP 8.2+)
- **Database**: MySQL 8.0
- **Web Server**: Nginx
- **Virtualization**: Docker & Docker Compose

## 📋 Prerequisites

Ensure you have the following installed:
- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Git](https://git-scm.com/)

## 🛠️ Installation and Setup

Follow these steps to set up the local development environment:

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/fitbest-api.git
cd fitbest-api
```

### 2. Configure Environment Variables
Copy the example file to create your local configuration:

```bash
cp src/.env.example src/.env
```
> **Note**: Verify the database configuration in `.env` to ensure it matches `docker-compose.yml`.

### 3. Start Containers
Build and start the services defined in Docker:

```bash
docker-compose up -d --build
```

### 4. Install PHP Dependencies
Run composer through the utility container:

```bash
docker-compose run --rm composer install
```

### 5. Generate Application Key
```bash
docker-compose run --rm artisan key:generate
```

### 6. Run Migrations
Prepare the database:

```bash
docker-compose run --rm artisan migrate
```

## 🔌 Service Access

Once the environment is up, you can access:

- **Base API**: [http://localhost:8000](http://localhost:8000)
- **PhpMyAdmin** (DB Management): [http://localhost:8080](http://localhost:8080)
  - *Server*: `mysql`
  - *User/Pass*: See `.env` or `docker-compose.yml`

## 📂 Project Structure

- `docker-compose.yml`: Service orchestration (API, Database, etc.).
- `dockerfiles/`: Specific Docker image configurations (Nginx, PHP).
- `src/`: Laravel application source code.

## 📝 Useful Commands

Run Artisan commands inside the container:
```bash
docker-compose run --rm artisan <command>
# Example: Create a controller
docker-compose run --rm artisan make:controller WorkoutController
```

View application logs:
```bash
docker-compose logs -f api
```
