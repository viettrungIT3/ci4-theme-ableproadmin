#!/bin/bash

# 🚀 Pull Request Manager Script for CI4 Theme Able Pro Admin
# Usage: ./scripts/pr-manager.sh [command] [options]

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

# Check if GitHub CLI is installed
if ! command -v gh &> /dev/null; then
    print_error "GitHub CLI (gh) is not installed. Please install it first:"
    echo "  brew install gh  # macOS"
    echo "  apt install gh   # Ubuntu"
    echo "  choco install gh # Windows"
    exit 1
fi

# Function to show help
show_help() {
    echo "🚀 Pull Request Manager for CI4 Theme Able Pro Admin"
    echo ""
    echo "Usage: ./scripts/pr-manager.sh [command] [options]"
    echo ""
    echo "Commands:"
    echo "  list                    List all PRs"
    echo "  list-open              List open PRs"
    echo "  list-mine              List PRs assigned to you"
    echo "  list-review            List PRs you need to review"
    echo "  view [number]          View specific PR"
    echo "  open [number]          Open PR in browser"
    echo "  review [number]        Start review process"
    echo "  approve [number]       Approve PR"
    echo "  request-changes [number] [comment]  Request changes"
    echo "  comment [number] [comment]          Add comment"
    echo "  merge [number]         Merge PR"
    echo "  close [number]         Close PR"
    echo "  status                 Show PR status"
    echo "  help                   Show this help"
    echo ""
    echo "Examples:"
    echo "  ./scripts/pr-manager.sh list"
    echo "  ./scripts/pr-manager.sh view 123"
    echo "  ./scripts/pr-manager.sh approve 123"
    echo "  ./scripts/pr-manager.sh request-changes 123 'Please fix the validation'"
    echo "  ./scripts/pr-manager.sh merge 123"
}

# Function to list PRs
list_prs() {
    local state="${1:-all}"
    
    case $state in
        "open")
            print_status "Listing open PRs..."
            gh pr list --state open
            ;;
        "closed")
            print_status "Listing closed PRs..."
            gh pr list --state closed
            ;;
        "merged")
            print_status "Listing merged PRs..."
            gh pr list --state merged
            ;;
        "mine")
            print_status "Listing PRs assigned to you..."
            gh pr list --assignee @me
            ;;
        "review")
            print_status "Listing PRs you need to review..."
            gh pr list --review-requested @me
            ;;
        *)
            print_status "Listing all PRs..."
            gh pr list
            ;;
    esac
}

# Function to view PR
view_pr() {
    local pr_number="$1"
    
    if [ -z "$pr_number" ]; then
        print_error "PR number is required"
        echo "Usage: ./scripts/pr-manager.sh view [number]"
        exit 1
    fi
    
    print_status "Viewing PR #$pr_number..."
    gh pr view "$pr_number"
}

# Function to open PR in browser
open_pr() {
    local pr_number="$1"
    
    if [ -z "$pr_number" ]; then
        print_error "PR number is required"
        echo "Usage: ./scripts/pr-manager.sh open [number]"
        exit 1
    fi
    
    print_status "Opening PR #$pr_number in browser..."
    gh pr view "$pr_number" --web
}

# Function to review PR
review_pr() {
    local pr_number="$1"
    
    if [ -z "$pr_number" ]; then
        print_error "PR number is required"
        echo "Usage: ./scripts/pr-manager.sh review [number]"
        exit 1
    fi
    
    print_status "Starting review for PR #$pr_number..."
    gh pr review "$pr_number"
}

# Function to approve PR
approve_pr() {
    local pr_number="$1"
    
    if [ -z "$pr_number" ]; then
        print_error "PR number is required"
        echo "Usage: ./scripts/pr-manager.sh approve [number]"
        exit 1
    fi
    
    print_status "Approving PR #$pr_number..."
    gh pr review "$pr_number" --approve
    print_success "PR #$pr_number approved!"
}

# Function to request changes
request_changes() {
    local pr_number="$1"
    local comment="$2"
    
    if [ -z "$pr_number" ]; then
        print_error "PR number is required"
        echo "Usage: ./scripts/pr-manager.sh request-changes [number] [comment]"
        exit 1
    fi
    
    if [ -z "$comment" ]; then
        comment="Please address the review comments and make the requested changes."
    fi
    
    print_status "Requesting changes for PR #$pr_number..."
    gh pr review "$pr_number" --request-changes --body "$comment"
    print_success "Changes requested for PR #$pr_number"
}

# Function to add comment
comment_pr() {
    local pr_number="$1"
    local comment="$2"
    
    if [ -z "$pr_number" ]; then
        print_error "PR number is required"
        echo "Usage: ./scripts/pr-manager.sh comment [number] [comment]"
        exit 1
    fi
    
    if [ -z "$comment" ]; then
        print_error "Comment is required"
        echo "Usage: ./scripts/pr-manager.sh comment [number] [comment]"
        exit 1
    fi
    
    print_status "Adding comment to PR #$pr_number..."
    gh pr review "$pr_number" --comment --body "$comment"
    print_success "Comment added to PR #$pr_number"
}

# Function to merge PR
merge_pr() {
    local pr_number="$1"
    local merge_type="${2:-merge}"
    
    if [ -z "$pr_number" ]; then
        print_error "PR number is required"
        echo "Usage: ./scripts/pr-manager.sh merge [number] [merge-type]"
        echo "Merge types: merge, squash, rebase"
        exit 1
    fi
    
    print_status "Merging PR #$pr_number with $merge_type..."
    gh pr merge "$pr_number" --"$merge_type"
    print_success "PR #$pr_number merged successfully!"
}

# Function to close PR
close_pr() {
    local pr_number="$1"
    
    if [ -z "$pr_number" ]; then
        print_error "PR number is required"
        echo "Usage: ./scripts/pr-manager.sh close [number]"
        exit 1
    fi
    
    print_status "Closing PR #$pr_number..."
    gh pr close "$pr_number"
    print_success "PR #$pr_number closed!"
}

# Function to show PR status
show_status() {
    print_status "Showing PR status..."
    gh pr status
}

# Main script logic
case "$1" in
    "list")
        list_prs "$2"
        ;;
    "list-open")
        list_prs "open"
        ;;
    "list-mine")
        list_prs "mine"
        ;;
    "list-review")
        list_prs "review"
        ;;
    "view")
        view_pr "$2"
        ;;
    "open")
        open_pr "$2"
        ;;
    "review")
        review_pr "$2"
        ;;
    "approve")
        approve_pr "$2"
        ;;
    "request-changes")
        request_changes "$2" "$3"
        ;;
    "comment")
        comment_pr "$2" "$3"
        ;;
    "merge")
        merge_pr "$2" "$3"
        ;;
    "close")
        close_pr "$2"
        ;;
    "status")
        show_status
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
