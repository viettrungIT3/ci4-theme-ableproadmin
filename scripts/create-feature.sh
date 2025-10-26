#!/bin/bash

# 🚀 Create Feature Branch Script for CI4 Theme Able Pro Admin
# Usage: ./scripts/create-feature.sh [feature-name] [description]

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

# Check if we're in a git repository
if [ ! -d ".git" ]; then
    print_error "Not in a Git repository. Please run this script from the project root."
    exit 1
fi

# Get parameters
feature_name="${1}"
feature_description="${2}"

if [ -z "$feature_name" ]; then
    print_error "Feature name is required"
    echo "Usage: ./scripts/create-feature.sh [feature-name] [description]"
    echo "Example: ./scripts/create-feature.sh 'responsive-card' 'Add responsive card component'"
    exit 1
fi

# Convert feature name to kebab-case
feature_name=$(echo "$feature_name" | tr '[:upper:]' '[:lower:]' | tr ' ' '-')

# Get next feature number
print_status "Finding next feature number..."

# Get all feature branches and extract numbers
feature_numbers=($(git branch -r | grep 'origin/[0-9][0-9]/feature/' | sed 's/.*\([0-9][0-9]\)\/feature\/.*/\1/' | sort -n))

if [ ${#feature_numbers[@]} -eq 0 ]; then
    next_number="01"
else
    # Find the highest number and increment
    highest_number=${feature_numbers[-1]}
    next_number=$(printf "%02d" $((highest_number + 1)))
fi

# Create branch name
branch_name="$next_number/feature/$feature_name"

print_status "Creating feature branch: $branch_name"

# Switch to develop branch
print_status "Switching to develop branch..."
git checkout develop
if [ $? -ne 0 ]; then
    print_error "Failed to switch to develop branch"
    exit 1
fi

# Pull latest changes
print_status "Pulling latest changes from develop..."
git pull origin develop
if [ $? -ne 0 ]; then
    print_error "Failed to pull latest changes"
    exit 1
fi

# Create feature branch
print_status "Creating feature branch: $branch_name"
git checkout -b "$branch_name"
if [ $? -ne 0 ]; then
    print_error "Failed to create feature branch"
    exit 1
fi

# Push to remote
print_status "Pushing branch to remote..."
git push -u origin "$branch_name"
if [ $? -ne 0 ]; then
    print_error "Failed to push branch to remote"
    exit 1
fi

# Create initial commit
print_status "Creating initial commit..."

# Create feature description file
cat > "FEATURE_$next_number.md" << EOF
# Feature #$next_number: $feature_name

## Description
$feature_description

## Tasks
- [ ] Task 1
- [ ] Task 2
- [ ] Task 3

## Acceptance Criteria
- [ ] Criterion 1
- [ ] Criterion 2
- [ ] Criterion 3

## Notes
- Add any additional notes here

## Related Issues
- Closes #$next_number
EOF

# Add and commit
git add "FEATURE_$next_number.md"
git commit -m "feat: initialize feature #$next_number - $feature_name

- Created feature branch
- Added feature description
- Set up initial structure

Closes #$next_number"

# Push initial commit
git push origin "$branch_name"

print_success "Feature branch created successfully!"
print_status "Branch Details:"
echo "  Name: $branch_name"
echo "  Number: #$next_number"
echo "  Description: $feature_description"
echo "  Base: develop"

# Show next steps
echo ""
print_status "Next Steps:"
echo "1. Start development: git checkout $branch_name"
echo "2. Make changes and commit"
echo "3. Create PR: ./scripts/create-pr.sh"
echo "4. View feature file: cat FEATURE_$next_number.md"

# Ask if user wants to switch to the new branch
read -p "Switch to new feature branch now? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    print_status "Switching to feature branch..."
    git checkout "$branch_name"
    print_success "Switched to $branch_name"
fi
