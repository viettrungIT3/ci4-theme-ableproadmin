#!/bin/bash

# 🚀 Create Pull Request Script for CI4 Theme Able Pro Admin
# Usage: ./scripts/create-pr.sh [feature-name] [description]

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

# Check if we're in a git repository
if [ ! -d ".git" ]; then
    print_error "Not in a Git repository. Please run this script from the project root."
    exit 1
fi

# Get current branch
current_branch=$(git branch --show-current)

# Check if we're on a feature branch
if [[ ! $current_branch =~ ^[0-9][0-9]/feature/ ]]; then
    print_error "Not on a feature branch. Current branch: $current_branch"
    print_status "Please switch to a feature branch first:"
    echo "  git checkout 01/feature/your-feature-name"
    exit 1
fi

# Extract feature number and name from branch
if [[ $current_branch =~ ^([0-9][0-9])/feature/(.+)$ ]]; then
    feature_number="${BASH_REMATCH[1]}"
    feature_name="${BASH_REMATCH[2]}"
else
    print_error "Invalid feature branch format. Expected: 01/feature/feature-name"
    exit 1
fi

# Get parameters
feature_description="${1:-$feature_name}"
pr_title="${2:-feat(component): Add $feature_description}"
base_branch="${3:-develop}"

# Validate base branch - NO MASTER ALLOWED
if [[ "$base_branch" == "master" ]]; then
    print_error "❌ CANNOT CREATE PR TO MASTER BRANCH!"
    print_status "Only admins can merge to master (production)"
    print_status "Please use develop branch instead:"
    echo "  ./scripts/create-pr.sh \"$feature_description\" \"$pr_title\" develop"
    exit 1
fi

print_status "Creating Pull Request for feature #$feature_number: $feature_name"
print_status "Target branch: $base_branch (NOT master)"

# Check if there are uncommitted changes
if ! git diff-index --quiet HEAD --; then
    print_warning "You have uncommitted changes. Please commit them first:"
    echo "  git add ."
    echo "  git commit -m 'feat: your commit message'"
    exit 1
fi

# Check if branch is pushed to remote
if ! git show-ref --verify --quiet refs/remotes/origin/$current_branch; then
    print_status "Pushing branch to remote..."
    git push -u origin $current_branch
    if [ $? -ne 0 ]; then
        print_error "Failed to push branch to remote"
        exit 1
    fi
    print_success "Branch pushed to remote"
fi

# Create PR body
pr_body="## 📋 Description
$feature_description

## 🎯 Type of Change
- [x] New feature
- [ ] Bug fix
- [ ] Documentation update
- [ ] Code refactoring
- [ ] Performance improvement

## 🧪 Testing
- [ ] Unit tests added/updated
- [ ] Integration tests pass
- [ ] Manual testing completed
- [ ] Cross-browser testing done

## 📱 Responsive Testing
- [ ] Desktop (1920x1080)
- [ ] Laptop (1366x768)
- [ ] Tablet (768x1024)
- [ ] Mobile (375x667)

## ♿ Accessibility
- [ ] ARIA labels added
- [ ] Keyboard navigation works
- [ ] Screen reader compatible
- [ ] Color contrast adequate

## 📸 Screenshots
[Add screenshots if applicable]

## 🔗 Related Issues
Closes #$feature_number

## 📝 Checklist
- [ ] Code follows project style guidelines
- [ ] Self-review completed
- [ ] Documentation updated
- [ ] No console.log statements left
- [ ] No TODO comments left
- [ ] All tests passing"

# Create Pull Request
print_status "Creating Pull Request..."

gh pr create \
  --title "$pr_title" \
  --body "$pr_body" \
  --base "$base_branch" \
  --head "$current_branch" \
  --assignee @me \
  --label "enhancement,component,phase-1" \
  --draft

if [ $? -eq 0 ]; then
    print_success "Pull Request created successfully!"
    print_status "PR Details:"
    echo "  Title: $pr_title"
    echo "  Branch: $current_branch"
    echo "  Base: develop"
    echo "  Number: #$feature_number"
    
    # Open PR in browser
    read -p "Open PR in browser? (y/n): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        gh pr view --web
    fi
    
    # Show next steps
    echo ""
    print_status "Next Steps:"
    echo "1. Add reviewers: gh pr edit $feature_number --add-reviewer @reviewer1,@reviewer2"
    echo "2. View PR: gh pr view $feature_number"
    echo "3. Open in browser: gh pr view $feature_number --web"
    echo "4. Check status: gh pr status"
    
else
    print_error "Failed to create Pull Request"
    exit 1
fi
