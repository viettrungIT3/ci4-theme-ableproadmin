#!/bin/bash

# 🚀 Complete Workflow Manager for CI4 Theme Able Pro Admin
# Usage: ./scripts/workflow.sh [command] [options]

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Function to show help
show_help() {
    echo "🚀 Complete Workflow Manager for CI4 Theme Able Pro Admin"
    echo ""
    echo "Usage: ./scripts/workflow.sh [command] [options]"
    echo ""
    echo "Commands:"
    echo "  setup                   Setup Git workflow"
    echo "  new-feature [name] [desc]  Create new feature branch"
    echo "  start-day               Start development day"
    echo "  commit [message]        Commit changes"
    echo "  push                    Push changes"
    echo "  create-pr               Create Pull Request"
    echo "  pr [command]            PR management (see pr-manager.sh)"
    echo "  status                  Show current status"
    echo "  sync                    Sync with develop"
    echo "  help                    Show this help"
    echo ""
    echo "Examples:"
    echo "  ./scripts/workflow.sh setup"
    echo "  ./scripts/workflow.sh new-feature 'responsive-card' 'Add responsive card component'"
    echo "  ./scripts/workflow.sh start-day"
    echo "  ./scripts/workflow.sh commit 'feat: add responsive card'"
    echo "  ./scripts/workflow.sh create-pr"
    echo "  ./scripts/workflow.sh pr list"
    echo "  ./scripts/workflow.sh status"
}

# Function to setup workflow
setup_workflow() {
    print_status "Setting up Git workflow..."
    ./setup-git-workflow.sh
}

# Function to create new feature
new_feature() {
    local feature_name="$1"
    local feature_desc="$2"
    
    if [ -z "$feature_name" ]; then
        print_error "Feature name is required"
        echo "Usage: ./scripts/workflow.sh new-feature [name] [description]"
        exit 1
    fi
    
    print_status "Creating new feature: $feature_name"
    ./scripts/create-feature.sh "$feature_name" "$feature_desc"
}

# Function to start development day
start_day() {
    print_status "Starting development day..."
    
    # Switch to develop and pull latest
    git checkout develop
    git pull origin develop
    
    # Show current status
    print_status "Current status:"
    git status
    
    # Show available feature branches
    print_status "Available feature branches:"
    git branch -r | grep 'origin/feature/' | head -10
    
    print_success "Ready to start development!"
    print_status "Next steps:"
    echo "1. Switch to feature branch: git checkout feature/001-your-feature"
    echo "2. Start coding!"
    echo "3. Commit changes: ./scripts/workflow.sh commit 'your message'"
    echo "4. Create PR when ready: ./scripts/workflow.sh create-pr"
}

# Function to commit changes
commit_changes() {
    local message="$1"
    
    if [ -z "$message" ]; then
        print_error "Commit message is required"
        echo "Usage: ./scripts/workflow.sh commit [message]"
        exit 1
    fi
    
    print_status "Committing changes..."
    
    # Check if there are changes to commit
    if git diff-index --quiet HEAD --; then
        print_warning "No changes to commit"
        exit 0
    fi
    
    # Add all changes
    git add .
    
    # Commit with message
    git commit -m "$message"
    
    print_success "Changes committed successfully!"
}

# Function to push changes
push_changes() {
    local current_branch=$(git branch --show-current)
    
    print_status "Pushing changes from $current_branch..."
    
    # Push to remote
    git push origin "$current_branch"
    
    if [ $? -eq 0 ]; then
        print_success "Changes pushed successfully!"
    else
        print_error "Failed to push changes"
        exit 1
    fi
}

# Function to create PR
create_pr() {
    print_status "Creating Pull Request..."
    ./scripts/create-pr.sh
}

# Function to manage PRs
manage_pr() {
    shift # Remove 'pr' from arguments
    ./scripts/pr-manager.sh "$@"
}

# Function to show status
show_status() {
    print_status "Current Git status:"
    echo ""
    git status
    echo ""
    
    print_status "Current branch: $(git branch --show-current)"
    echo ""
    
    print_status "Recent commits:"
    git log --oneline -5
    echo ""
    
    print_status "Pull Request status:"
    ./scripts/pr-manager.sh status
}

# Function to sync with develop
sync_develop() {
    local current_branch=$(git branch --show-current)
    
    print_status "Syncing with develop..."
    
    # Switch to develop
    git checkout develop
    git pull origin develop
    
    # Switch back to feature branch
    git checkout "$current_branch"
    
    # Merge develop into feature branch
    git merge develop
    
    print_success "Synced with develop successfully!"
}

# Main script logic
case "$1" in
    "setup")
        setup_workflow
        ;;
    "new-feature")
        new_feature "$2" "$3"
        ;;
    "start-day")
        start_day
        ;;
    "commit")
        commit_changes "$2"
        ;;
    "push")
        push_changes
        ;;
    "create-pr")
        create_pr
        ;;
    "pr")
        manage_pr "$@"
        ;;
    "status")
        show_status
        ;;
    "sync")
        sync_develop
        ;;
    "help"|"--help"|"-h")
        show_help
        ;;
    *)
        print_error "Unknown command: $1"
        echo ""
        show_help
        exit 1
        ;;
esac
