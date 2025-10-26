#!/bin/bash

# 🚀 Git Workflow Setup Script for CI4 Theme Able Pro Admin
# This script sets up the Git workflow and branch structure

echo "🚀 Setting up Git Workflow for CI4 Theme Able Pro Admin..."

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
    print_error "Not in a Git repository. Please run 'git init' first."
    exit 1
fi

# Check if we're on main branch
current_branch=$(git branch --show-current)
if [ "$current_branch" != "main" ]; then
    print_warning "Not on main branch. Current branch: $current_branch"
    read -p "Do you want to switch to main branch? (y/n): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        git checkout main
        print_success "Switched to main branch"
    else
        print_error "Please switch to main branch manually and run this script again."
        exit 1
    fi
fi

# Create develop branch if it doesn't exist
if ! git show-ref --verify --quiet refs/heads/develop; then
    print_status "Creating develop branch..."
    git checkout -b develop
    git push -u origin develop
    print_success "Created and pushed develop branch"
else
    print_status "Develop branch already exists"
    git checkout develop
fi

# Create staging branch if it doesn't exist
if ! git show-ref --verify --quiet refs/heads/staging; then
    print_status "Creating staging branch..."
    git checkout -b staging
    git push -u origin staging
    print_success "Created and pushed staging branch"
else
    print_status "Staging branch already exists"
fi

# Switch back to develop
git checkout develop

# Create initial feature branches for Phase 1
print_status "Creating Phase 1 feature branches..."

# Feature branches for Phase 1 (with 2-digit numbering and hierarchy)
branches=(
    "01/feature/analyze-reference-structure"
    "02/feature/create-component-library"
    "03/feature/responsive-layout-system"
    "04/feature/navigation-components"
)

for branch in "${branches[@]}"; do
    if ! git show-ref --verify --quiet refs/heads/$branch; then
        print_status "Creating branch: $branch"
        git checkout -b $branch
        git push -u origin $branch
        print_success "Created and pushed $branch"
    else
        print_warning "Branch $branch already exists"
    fi
done

# Switch back to develop
git checkout develop

# Create .gitignore additions if needed
print_status "Checking .gitignore..."

if [ ! -f ".gitignore" ]; then
    print_status "Creating .gitignore file..."
    cat > .gitignore << 'EOF'
# CI4 Theme Able Pro Admin .gitignore

# OS generated files
.DS_Store
.DS_Store?
._*
.Spotlight-V100
.Trashes
ehthumbs.db
Thumbs.db

# IDE files
.vscode/
.idea/
*.swp
*.swo
*~

# Logs
*.log
npm-debug.log*
yarn-debug.log*
yarn-error.log*

# Runtime data
pids
*.pid
*.seed
*.pid.lock

# Coverage directory used by tools like istanbul
coverage/
*.lcov

# nyc test coverage
.nyc_output

# Dependency directories
node_modules/
vendor/

# Optional npm cache directory
.npm

# Optional eslint cache
.eslintcache

# Microbundle cache
.rpt2_cache/
.rts2_cache_cjs/
.rts2_cache_es/
.rts2_cache_umd/

# Optional REPL history
.node_repl_history

# Output of 'npm pack'
*.tgz

# Yarn Integrity file
.yarn-integrity

# dotenv environment variables file
.env
.env.test
.env.production

# parcel-bundler cache (https://parceljs.org/)
.cache
.parcel-cache

# Next.js build output
.next

# Nuxt.js build / generate output
.nuxt
dist

# Gatsby files
.cache/
public

# Storybook build outputs
.out
.storybook-out

# Temporary folders
tmp/
temp/

# Editor directories and files
.vscode/*
!.vscode/extensions.json
.idea
*.suo
*.ntvs*
*.njsproj
*.sln
*.sw?

# Build outputs
build/
dist/
public/build/

# Cache
writable/cache/*
!writable/cache/.gitkeep

# Logs
writable/logs/*
!writable/logs/.gitkeep

# Session files
writable/session/*
!writable/session/.gitkeep

# Uploads
writable/uploads/*
!writable/uploads/.gitkeep

# Database
*.db
*.sqlite

# Backup files
*.bak
*.backup
*.old

# Test files
tests/_support/ci4_sessions/
tests/_support/ci4_sessions/*
!tests/_support/ci4_sessions/.gitkeep
EOF
    print_success "Created .gitignore file"
else
    print_status ".gitignore already exists"
fi

# Create commit message template
print_status "Setting up commit message template..."

if [ ! -f ".gitmessage" ]; then
    cat > .gitmessage << 'EOF'
# <type>(<scope>): <description>
#
# <body>
#
# <footer>
#
# Types: feat, fix, docs, style, refactor, test, chore, perf, ci, build
# Scopes: component, layout, theme, api, validation, responsive, accessibility, performance
#
# Examples:
# feat(component): add responsive card component
# fix(validation): resolve form validation error
# docs(component): update card component documentation
# refactor(theme): optimize CSS structure
EOF
    print_success "Created commit message template"
    
    # Set git config to use the template
    git config commit.template .gitmessage
    print_success "Set commit message template in git config"
else
    print_status "Commit message template already exists"
fi

# Create pre-commit hook
print_status "Setting up pre-commit hook..."

if [ ! -f ".git/hooks/pre-commit" ]; then
    cat > .git/hooks/pre-commit << 'EOF'
#!/bin/sh
# Pre-commit hook for CI4 Theme Able Pro Admin

echo "🔍 Running pre-commit checks..."

# Check for console.log statements
if git diff --cached --name-only | grep -E '\.(js|php)$' | xargs grep -l 'console\.log'; then
    echo "⚠️  Warning: Found console.log statements in staged files"
    echo "Consider removing them before committing to production"
    read -p "Continue anyway? (y/n): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo "❌ Commit aborted"
        exit 1
    fi
fi

# Check for TODO comments
if git diff --cached --name-only | grep -E '\.(js|php|css)$' | xargs grep -l 'TODO\|FIXME\|HACK'; then
    echo "⚠️  Warning: Found TODO/FIXME/HACK comments in staged files"
    echo "Consider addressing them before committing"
fi

# Check commit message format (basic check)
if [ -n "$1" ]; then
    commit_regex='^(feat|fix|docs|style|refactor|test|chore|perf|ci|build)(\(.+\))?: .{1,50}'
    if ! grep -qE "$commit_regex" "$1"; then
        echo "❌ Invalid commit message format!"
        echo "Format: type(scope): description"
        echo "Types: feat, fix, docs, style, refactor, test, chore, perf, ci, build"
        exit 1
    fi
fi

echo "✅ Pre-commit checks passed"
EOF
    chmod +x .git/hooks/pre-commit
    print_success "Created pre-commit hook"
else
    print_status "Pre-commit hook already exists"
fi

# Create pre-push hook
print_status "Setting up pre-push hook..."

if [ ! -f ".git/hooks/pre-push" ]; then
    cat > .git/hooks/pre-push << 'EOF'
#!/bin/sh
# Pre-push hook for CI4 Theme Able Pro Admin

echo "🚀 Running pre-push checks..."

# Check if we're pushing to main or develop
current_branch=$(git branch --show-current)
protected_branches="main develop"

for branch in $protected_branches; do
    if [ "$current_branch" = "$branch" ]; then
        echo "⚠️  Warning: Pushing to protected branch: $branch"
        echo "Make sure you have reviewed all changes and they are ready for production"
        read -p "Continue? (y/n): " -n 1 -r
        echo
        if [[ ! $REPLY =~ ^[Yy]$ ]]; then
            echo "❌ Push aborted"
            exit 1
        fi
    fi
done

# Check for uncommitted changes
if ! git diff-index --quiet HEAD --; then
    echo "❌ You have uncommitted changes. Please commit them before pushing."
    exit 1
fi

echo "✅ Pre-push checks passed"
EOF
    chmod +x .git/hooks/pre-push
    print_success "Created pre-push hook"
else
    print_status "Pre-push hook already exists"
fi

# Create initial commit for workflow setup
print_status "Creating initial commit for workflow setup..."

git add .
git commit -m "chore: setup git workflow and branch structure

- Created develop and staging branches
- Added feature branches for Phase 1
- Set up .gitignore for CI4 project
- Added commit message template
- Created pre-commit and pre-push hooks
- Added comprehensive documentation

Closes #1"

print_success "Created initial workflow setup commit"

# Push all branches
print_status "Pushing all branches to remote..."
git push origin --all

print_success "✅ Git workflow setup completed successfully!"

echo ""
echo "🎉 Setup Summary:"
echo "=================="
echo "✅ Created develop and staging branches"
echo "✅ Created Phase 1 feature branches"
echo "✅ Set up .gitignore"
echo "✅ Added commit message template"
echo "✅ Created pre-commit and pre-push hooks"
echo "✅ Pushed all branches to remote"
echo ""
echo "🚀 Next Steps:"
echo "1. Switch to a feature branch: git checkout feature/analyze-reference-structure"
echo "2. Start development following the workflow in GIT_WORKFLOW.md"
echo "3. Use 'git commit' to use the commit message template"
echo "4. Create pull requests when ready to merge"
echo ""
echo "📚 Documentation:"
echo "- TODO.md - Development roadmap"
echo "- GIT_WORKFLOW.md - Git workflow guide"
echo ""
echo "Happy coding! 🎨"
