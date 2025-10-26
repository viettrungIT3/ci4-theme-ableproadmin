# 🚀 Scripts Directory - CI4 Theme Able Pro Admin

This directory contains automation scripts for the Git workflow and development process.

## 📁 Scripts Overview

### 🔧 Core Scripts

#### `workflow.sh` - Complete Workflow Manager
Main script for managing the entire development workflow.

```bash
# Setup Git workflow
./scripts/workflow.sh setup

# Create new feature
./scripts/workflow.sh new-feature "responsive-card" "Add responsive card component"

# Start development day
./scripts/workflow.sh start-day

# Commit changes
./scripts/workflow.sh commit "feat: add responsive card"

# Push changes
./scripts/workflow.sh push

# Create Pull Request
./scripts/workflow.sh create-pr

# Show status
./scripts/workflow.sh status

# Sync with develop
./scripts/workflow.sh sync
```

#### `create-feature.sh` - Feature Branch Creator
Creates new feature branches with automatic numbering.

```bash
# Create feature with auto-numbering
./scripts/create-feature.sh "responsive-card" "Add responsive card component"

# This creates: feature/001-responsive-card
```

#### `create-pr.sh` - Pull Request Creator
Creates Pull Requests with proper templates and formatting.

```bash
# Create PR (auto-detects current branch)
./scripts/create-pr.sh

# Create PR with custom title and description
./scripts/create-pr.sh "custom-title" "custom description"
```

#### `pr-manager.sh` - Pull Request Manager
Manages Pull Requests using GitHub CLI.

```bash
# List all PRs
./scripts/pr-manager.sh list

# List your PRs
./scripts/pr-manager.sh list-mine

# List PRs to review
./scripts/pr-manager.sh list-review

# View specific PR
./scripts/pr-manager.sh view 123

# Open PR in browser
./scripts/pr-manager.sh open 123

# Approve PR
./scripts/pr-manager.sh approve 123

# Request changes
./scripts/pr-manager.sh request-changes 123 "Please fix validation"

# Add comment
./scripts/pr-manager.sh comment 123 "Looks good!"

# Merge PR
./scripts/pr-manager.sh merge 123

# Close PR
./scripts/pr-manager.sh close 123
```

## 🎯 Quick Start

### 1. Setup Workflow
```bash
# Run the main setup script
./setup-git-workflow.sh

# Or use the workflow manager
./scripts/workflow.sh setup
```

### 2. Start Development
```bash
# Create new feature
./scripts/workflow.sh new-feature "my-feature" "Description of my feature"

# Start development day
./scripts/workflow.sh start-day

# Make changes, then commit
./scripts/workflow.sh commit "feat: implement my feature"

# Push changes
./scripts/workflow.sh push

# Create Pull Request
./scripts/workflow.sh create-pr
```

### 3. Review and Merge
```bash
# List PRs to review
./scripts/workflow.sh pr list-review

# Review specific PR
./scripts/workflow.sh pr view 123

# Approve PR
./scripts/workflow.sh pr approve 123

# Merge PR
./scripts/workflow.sh pr merge 123
```

## 📋 Branch Naming Convention

### Feature Branches
- Format: `01/feature/feature-name`
- Number: auto-incrementing
- Name: kebab-case description

### Bug Fix Branches
- Format: `01/bugfix/issue-description`
- Number: auto-incrementing
- Name: kebab-case description

### Hotfix Branches
- Format: `01/hotfix/critical-issue`
- Number: auto-incrementing
- Name: kebab-case description

## 🔄 Workflow Examples

### Daily Development
```bash
# Morning
./scripts/workflow.sh start-day
git checkout 01/feature/my-feature

# Development
# ... make changes ...

# Commit
./scripts/workflow.sh commit "feat: add new functionality"

# Push
./scripts/workflow.sh push

# Evening
./scripts/workflow.sh status
```

### Feature Completion
```bash
# Final commit
./scripts/workflow.sh commit "feat: complete responsive card component"

# Create PR
./scripts/workflow.sh create-pr

# Review process
./scripts/workflow.sh pr list-mine
./scripts/workflow.sh pr view 123

# After approval, merge
./scripts/workflow.sh pr merge 123
```

### Review Process
```bash
# List PRs to review
./scripts/workflow.sh pr list-review

# Review PR
./scripts/workflow.sh pr view 123

# Approve or request changes
./scripts/workflow.sh pr approve 123
# or
./scripts/workflow.sh pr request-changes 123 "Please fix validation"
```

## 🛠️ Prerequisites

### Required Tools
- **Git** - Version control
- **GitHub CLI** - For PR management
- **Bash** - For running scripts

### Installation
```bash
# macOS
brew install git gh

# Ubuntu
sudo apt install git gh

# Windows
choco install git gh
```

### GitHub CLI Authentication
```bash
# Authenticate with GitHub
gh auth login

# Follow the prompts to authenticate
```

## 📚 Documentation

- **TODO.md** - Development roadmap
- **GIT_WORKFLOW.md** - Detailed Git workflow
- **QUICK_START.md** - Quick reference guide
- **scripts/README.md** - This file

## 🆘 Troubleshooting

### Common Issues

#### 1. GitHub CLI not authenticated
```bash
gh auth login
```

#### 2. Not in a Git repository
```bash
git init
# or
cd /path/to/project
```

#### 3. Branch not pushed to remote
```bash
git push -u origin branch-name
```

#### 4. Merge conflicts
```bash
# Resolve conflicts in files
git add .
git commit -m "fix: resolve merge conflicts"
```

#### 5. Script permissions
```bash
chmod +x scripts/*.sh
```

## 🎯 Best Practices

### 1. Always use scripts
- Use `./scripts/workflow.sh` for common tasks
- Use `./scripts/create-feature.sh` for new features
- Use `./scripts/pr-manager.sh` for PR management

### 2. Follow naming conventions
- Use kebab-case for feature names
- Use descriptive commit messages
- Use proper PR titles and descriptions

### 3. Keep branches clean
- Sync with develop regularly
- Rebase before creating PR
- Delete merged branches

### 4. Review process
- Always review PRs before merging
- Use meaningful comments
- Test changes locally

---

**Happy Coding! 🎨✨**
