# 🚀 QUICK START GUIDE - CI4 THEME ABLE PRO ADMIN

## 📋 Setup Git Workflow

### 1. Run Setup Script
```bash
./setup-git-workflow.sh
```

### 2. Manual Setup (Alternative)
```bash
# Create main branches
git checkout -b develop
git push -u origin develop

git checkout -b staging
git push -u origin staging

# Create Phase 1 feature branches
git checkout develop
git checkout -b feature/analyze-reference-structure
git push -u origin feature/analyze-reference-structure

git checkout develop
git checkout -b feature/create-component-library
git push -u origin feature/create-component-library
```

## 🎯 Start Development

### 1. Create a New Feature
```bash
# Create new feature branch with auto-numbering
./scripts/create-feature.sh "responsive-card" "Add responsive card component"

# Or switch to existing feature branch
git checkout 01/feature/analyze-reference-structure

# Pull latest changes
git pull origin develop
```

### 2. Make Changes
```bash
# Make your changes
# ... code ...

# Stage changes
git add .

# Commit with template
git commit
# (This will open the commit message template)
```

### 3. Push Changes
```bash
# Push to remote
git push origin feature/analyze-reference-structure
```

### 4. Create Pull Request (TO DEVELOP ONLY)
```bash
# Create PR using script (auto-detects branch and creates PR to develop)
./scripts/create-pr.sh

# Or create PR manually (TO DEVELOP ONLY)
gh pr create --title "feat(component): Add responsive card" \
  --body "Description of changes..." \
  --base develop \
  --head 01/feature/responsive-card

# ⚠️ NEVER create PR to master - Only admins can merge to production!
```

## 📝 Quick Commands

### Daily Workflow
```bash
# Start of day
git checkout develop
git pull origin develop
git checkout 01/feature/your-feature

# Make changes and commit
git add .
git commit -m "feat(component): add new feature"
git push origin 01/feature/your-feature

# End of day
git push origin 01/feature/your-feature
```

### Pull Request Management
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

# Review PR
gh pr view 123

# Add review comments
gh pr comment 123 --body "Please fix the CSS formatting"

# Approve PR (after review)
./scripts/pr-manager.sh approve 123

# Request changes (if needed)
./scripts/pr-manager.sh request-changes 123 "Please fix the issues mentioned"

# Merge PR (after approval)
./scripts/pr-manager.sh merge 123
./scripts/pr-manager.sh request-changes 123 "Please fix validation"

# Add comment
./scripts/pr-manager.sh comment 123 "Looks good!"

# Merge PR
./scripts/pr-manager.sh merge 123

# Close PR
./scripts/pr-manager.sh close 123
```

### Branch Management
```bash
# List all branches
git branch -a

# Switch branches
git checkout branch-name

# Create new feature branch
git checkout develop
git checkout -b feature/new-feature-name

# Delete local branch
git branch -d feature/old-feature

# Delete remote branch
git push origin --delete feature/old-feature
```

### Commit Message Examples
```bash
# Feature
git commit -m "feat(component): add responsive card component"

# Bug fix
git commit -m "fix(validation): resolve form validation error"

# Documentation
git commit -m "docs(component): update card documentation"

# Refactoring
git commit -m "refactor(theme): optimize CSS structure"
```

## 🎨 Development Phases

### Phase 1: Foundation & Analysis (Current)
- [ ] Analyze reference structure
- [ ] Create component library
- [ ] Implement responsive layout
- [ ] Build navigation components

### Phase 2: Layout & Responsive System
- [ ] Grid system
- [ ] Container system
- [ ] Breakpoint management
- [ ] Responsive utilities

### Phase 3: Dashboard & Data Visualization
- [ ] Dashboard widgets
- [ ] Chart components
- [ ] Advanced data tables
- [ ] Progress widgets

## 🔧 Useful Scripts

### Check Status
```bash
# Check current branch
git branch --show-current

# Check status
git status

# Check remote branches
git branch -r

# Check all branches
git branch -a
```

### Clean Up
```bash
# Clean untracked files
git clean -fd

# Reset to last commit
git reset --hard HEAD

# Reset to remote branch
git reset --hard origin/develop
```

### Merge and Rebase
```bash
# Merge develop into feature
git checkout feature/your-feature
git merge develop

# Rebase feature on develop
git checkout feature/your-feature
git rebase develop

# Squash commits
git rebase -i HEAD~3
```

## 📚 Documentation

- **TODO.md** - Complete development roadmap
- **GIT_WORKFLOW.md** - Detailed Git workflow
- **QUICK_START.md** - This file

## 🆘 Troubleshooting

### Common Issues

#### 1. Merge Conflicts
```bash
# Resolve conflicts in files
# Then:
git add .
git commit -m "fix: resolve merge conflicts"
```

#### 2. Detached HEAD
```bash
# Switch to main branch
git checkout main
# or
git checkout develop
```

#### 3. Wrong Branch
```bash
# Stash changes
git stash

# Switch branches
git checkout correct-branch

# Apply stashed changes
git stash pop
```

#### 4. Undo Last Commit
```bash
# Keep changes
git reset --soft HEAD~1

# Discard changes
git reset --hard HEAD~1
```

## 🎯 Next Steps

1. **Run setup script**: `./setup-git-workflow.sh`
2. **Choose a feature**: Pick from Phase 1 features
3. **Start coding**: Follow the workflow
4. **Create PR**: When feature is complete
5. **Review & merge**: Follow review process

## 📞 Support

- Check **GIT_WORKFLOW.md** for detailed workflow
- Check **TODO.md** for development roadmap
- Create issue for questions or problems

---

**Happy Coding! 🎨✨**
