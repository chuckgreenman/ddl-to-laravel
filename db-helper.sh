#!/bin/bash

# Database helper script for managing Docker volumes and containers

case "$1" in
    start)
        echo "Starting databases with persistent volumes..."
        docker-compose up -d
        echo "Waiting for databases to be ready..."
        docker-compose exec mysql mysqladmin ping -h localhost -u root -proot --wait=30
        docker-compose exec postgres pg_isready -U test_user -d test_db
        echo "Databases are ready!"
        ;;
    
    stop)
        echo "Stopping databases..."
        docker-compose down
        ;;
    
    reset)
        echo "Resetting databases (this will delete all data)..."
        docker-compose down
        docker volume rm ddl-mysql-data ddl-postgres-data 2>/dev/null || true
        echo "Database volumes removed. Next start will re-initialize from SQL files."
        ;;
    
    status)
        echo "Database container status:"
        docker-compose ps
        echo ""
        echo "Database volumes:"
        docker volume ls | grep ddl-
        ;;
    
    logs)
        docker-compose logs -f
        ;;
    
    *)
        echo "Usage: $0 {start|stop|reset|status|logs}"
        echo ""
        echo "  start  - Start databases (data persists between restarts)"
        echo "  stop   - Stop databases (data is preserved)"
        echo "  reset  - Remove volumes and reinitialize databases"
        echo "  status - Show container and volume status"
        echo "  logs   - Follow container logs"
        exit 1
        ;;
esac