# 🔄 GIT WORKFLOW - CI4 THEME ABLE PRO ADMIN

## 🌳 Branch Strategy

### Main Branches
- **`master`** - Production-ready code (PROTECTED - No direct merges)
- **`develop`** - Integration branch for features (MAIN WORKING BRANCH)
- **`staging`** - Pre-production testing

### Feature Branches
- **`feature/component-name`** - New components
- **`feature/phase-name`** - Phase-based development
- **`feature/ux-ui-enhancement`** - UI/UX improvements

### Support Branches
- **`hotfix/critical-issue`** - Critical production fixes
- **`bugfix/issue-description`** - Bug fixes
- **`refactor/component-name`** - Code refactoring

## 📋 Branch Naming Convention

### Feature Branches (with 2-digit numbering and hierarchy)
```
01/feature/analyze-reference-structure
02/feature/create-component-library
03/feature/responsive-layout-system
04/feature/dashboard-widgets
05/feature/advanced-data-tables
06/feature/modal-systems
07/feature/advanced-forms
08/feature/navigation-components
09/feature/theme-customization
10/feature/dark-light-toggle
```

### Bug Fix Branches (with 2-digit numbering and hierarchy)
```
01/bugfix/toast-positioning-issue
02/bugfix/modal-backdrop-problem
03/bugfix/table-sorting-bug
04/bugfix/form-validation-error
```

### Hotfix Branches (with 2-digit numbering and hierarchy)
```
01/hotfix/critical-security-patch
02/hotfix/production-crash-fix
03/hotfix/api-endpoint-error
```

## 🚀 Development Workflow

### 1. Starting a New Feature
```bash
# Switch to develop branch
git checkout develop
git pull origin develop

# Create feature branch with 2-digit number and hierarchy
git checkout -b 01/feature/component-name

# Push to remote
git push -u origin 01/feature/component-name
```

### 2. Daily Development
```bash
# Start of day
git checkout 01/feature/component-name
git pull origin develop

# Make changes and commit
git add .
git commit -m "feat: add responsive card component

- Created basic card component
- Added responsive breakpoints
- Implemented hover effects
- Added documentation

Closes #01"

# Push changes
git push origin 01/feature/component-name
```

### 3. Completing a Feature
```bash
# Final commit
git add .
git commit -m "feat: complete responsive card component

- All features implemented
- Tests passing
- Documentation updated
- Ready for review

Closes #123"

# Push final changes
git push origin 01/feature/component-name

# Create Pull Request to DEVELOP (NOT master)
gh pr create --title "feat(component): Add responsive card component" \
  --body "## Description
Added responsive card component with all required features.

## Changes
- Created basic card component
- Added responsive breakpoints
- Implemented hover effects
- Added documentation

## Testing
- [x] Unit tests added
- [x] Manual testing completed
- [x] Responsive testing done

## Screenshots
[Add screenshots if applicable]

Closes #01" \
  --base develop \
  --head 01/feature/component-name \
  --assignee @me \
  --reviewer @reviewer1,@reviewer2 \
  --label "enhancement,component,phase-1"
```

## 📝 Commit Message Convention

### Format
```
<type>(<scope>): <description>

<body>

<footer>
```

### Types
- **feat**: New feature
- **fix**: Bug fix
- **docs**: Documentation changes
- **style**: Code style changes (formatting, etc.)
- **refactor**: Code refactoring
- **test**: Adding or updating tests
- **chore**: Maintenance tasks
- **perf**: Performance improvements
- **ci**: CI/CD changes
- **build**: Build system changes

### Scopes
- **component**: UI components
- **layout**: Layout system
- **theme**: Theme system
- **api**: API related
- **validation**: Form validation
- **responsive**: Responsive design
- **accessibility**: A11y features
- **performance**: Performance optimization

### Examples
```bash
# Feature
git commit -m "feat(component): add advanced data table

- Implemented sorting functionality
- Added filtering capabilities
- Created pagination component
- Added export functionality

Closes #45"

# Bug fix
git commit -m "fix(validation): resolve form validation error

- Fixed email validation regex
- Updated error messages
- Added proper error handling

Fixes #67"

# Documentation
git commit -m "docs(component): update card component documentation

- Added usage examples
- Updated API reference
- Added best practices section"

# Refactoring
git commit -m "refactor(theme): optimize CSS structure

- Reorganized CSS files
- Improved naming conventions
- Reduced code duplication
- Enhanced maintainability"
```

## 🔄 Pull Request Workflow

### 1. Creating a Pull Request with Git CLI
```bash
# Push feature branch
git push origin feature/001-component-name

# Create PR using GitHub CLI
gh pr create --title "feat(component): Add Advanced Data Table" \
  --body "## Description
  Implemented advanced data table with sorting, filtering, and pagination.

  ## Changes
  - Added sorting functionality
  - Implemented filtering capabilities
  - Created pagination component
  - Added export functionality

  ## Testing
  - [x] Unit tests added
  - [x] Integration tests pass
  - [x] Manual testing completed
  - [x] Cross-browser testing done

  ## Screenshots
  [Add screenshots if applicable]

  Closes #45" \
  --base develop \
  --head feature/001-component-name \
  --assignee @me \
  --reviewer @reviewer1,@reviewer2 \
  --label "enhancement,component,phase-1,data-table"

# Alternative: Create PR with template
gh pr create --template .github/pull_request_template.md \
  --title "feat(component): Add Advanced Data Table" \
  --base develop \
  --head feature/001-component-name
```

### 2. PR Template
```markdown
## 📋 Description
Brief description of changes

## 🎯 Type of Change
- [ ] New feature
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
Before/after screenshots if applicable

## 🔗 Related Issues
Closes #123
Fixes #456
```

### 3. Pull Request Management
```bash
# List all PRs
gh pr list

# List PRs by status
gh pr list --state open
gh pr list --state closed
gh pr list --state merged

# View specific PR
gh pr view 123

# View PR in browser
gh pr view 123 --web

# Check PR status
gh pr status

# List PRs assigned to you
gh pr list --assignee @me

# List PRs you're reviewing
gh pr list --review-requested @me
```

### 4. Review Process
```bash
# Start review
gh pr review 123

# Approve PR
gh pr review 123 --approve

# Request changes
gh pr review 123 --request-changes --body "Please fix the following issues..."

# Comment on PR
gh pr review 123 --comment --body "Looks good, just a small suggestion..."

# Address review comments
git add .
git commit -m "fix: address review comments

- Updated component props
- Improved error handling
- Added missing tests

Addresses review feedback"

git push origin feature/001-component-name
```

### 5. Merge and Close
```bash
# Merge PR
gh pr merge 123 --merge

# Merge with squash
gh pr merge 123 --squash

# Merge with rebase
gh pr merge 123 --rebase

# Close PR without merging
gh pr close 123

# Delete branch after merge
gh pr merge 123 --delete-branch
```

## 🏷️ Tagging Strategy

### Version Tags
```bash
# Major version (breaking changes)
git tag -a v2.0.0 -m "Release v2.0.0: Major UI overhaul"

# Minor version (new features)
git tag -a v1.5.0 -m "Release v1.5.0: Advanced components"

# Patch version (bug fixes)
git tag -a v1.4.1 -m "Release v1.4.1: Critical bug fixes"
```

### Phase Tags
```bash
# Phase completion tags
git tag -a phase-1-foundation -m "Phase 1: Foundation & Analysis Complete"
git tag -a phase-2-layout -m "Phase 2: Layout & Responsive Complete"
git tag -a phase-3-dashboard -m "Phase 3: Dashboard & Data Visualization Complete"
```

## 🔧 Git Hooks

### Pre-commit Hook
```bash
#!/bin/sh
# .git/hooks/pre-commit

# Run linting
npm run lint

# Run tests
npm run test

# Check commit message format
commit_regex='^(feat|fix|docs|style|refactor|test|chore|perf|ci|build)(\(.+\))?: .{1,50}'

if ! grep -qE "$commit_regex" "$1"; then
    echo "Invalid commit message format!"
    echo "Format: type(scope): description"
    exit 1
fi
```

### Pre-push Hook
```bash
#!/bin/sh
# .git/hooks/pre-push

# Run full test suite
npm run test:full

# Build project
npm run build

# Check for console errors
npm run check:console
```

## 📊 Branch Protection Rules

### Master Branch (PRODUCTION - FULLY PROTECTED)
- **NO DIRECT MERGES ALLOWED**
- **NO DIRECT PUSHES ALLOWED**
- Only automated releases can update master
- Requires admin approval for any changes

### Develop Branch (MAIN WORKING BRANCH)
- Require pull request reviews (1 reviewer)
- Require status checks to pass
- Allow force pushes (for hotfixes)
- **This is where all development happens**

## 🚀 Release Workflow (ADMIN ONLY)

### ⚠️ IMPORTANT: Only admins can release to production

### 1. Prepare Release (Admin Only)
```bash
# Switch to develop
git checkout develop
git pull origin develop

# Create release branch
git checkout -b release/v1.5.0

# Update version numbers
# Update CHANGELOG.md
# Update documentation

git add .
git commit -m "chore: prepare release v1.5.0"
git push origin release/v1.5.0
```

### 2. Release Process (Admin Only)
```bash
# Create PR: release/v1.5.0 -> master (ADMIN ONLY)
# After admin approval and merge:

# Tag release
git tag -a v1.5.0 -m "Release v1.5.0"
git push origin v1.5.0

# Merge back to develop
git checkout develop
git merge master
git push origin develop
```

## 🔍 Code Review Process

### 📋 Review Workflow

#### **1. PR Creation & Assignment**
```bash
# Create PR (auto-assigns to creator)
./scripts/create-pr.sh

# Manually assign reviewers
gh pr edit 123 --add-reviewer @reviewer1,@reviewer2

# Add labels
gh pr edit 123 --add-label "enhancement,component"
```

#### **2. Review Process**
```bash
# List all PRs
./scripts/pr-manager.sh list

# View specific PR
./scripts/pr-manager.sh view 123

# Review PR details
gh pr view 123

# Add review comments
gh pr comment 123 --body "Please fix the CSS formatting in line 45"

# Add inline comments
gh pr comment 123 --body "This function needs better error handling" --file src/app/Views/elements/card.php --line 25
```

#### **3. Review Actions**
```bash
# Approve PR (after review)
./scripts/pr-manager.sh approve 123

# Request changes (if needed)
./scripts/pr-manager.sh request-changes 123 "Please fix the issues mentioned in the review"

# Add general comments
./scripts/pr-manager.sh comment 123 "Great work! Just a few minor suggestions."
```

#### **4. Merge After Approval**
```bash
# Merge after approval
./scripts/pr-manager.sh merge 123

# Or merge manually
gh pr merge 123 --squash
```

### 📝 Review Guidelines

#### **For Reviewers:**
- **Code Quality**: Check formatting, naming conventions, structure
- **Functionality**: Verify features work as expected
- **Testing**: Ensure tests are included and passing
- **Security**: Check for potential security issues
- **Documentation**: Verify documentation is updated
- **Performance**: Check for performance implications
- **Accessibility**: Ensure accessibility standards are met

#### **For Authors:**
- **Clear Commits**: Write descriptive commit messages
- **Include Tests**: Add tests for new features
- **Update Docs**: Update relevant documentation
- **Respond to Feedback**: Address review comments promptly
- **Keep PRs Focused**: One feature per PR
- **Self-Review**: Review your own code before submitting

### 🔍 Review Checklist

#### **Code Quality:**
- [ ] Code follows project conventions
- [ ] No console.log statements left
- [ ] No TODO comments left
- [ ] Proper error handling
- [ ] Clean and readable code

#### **Functionality:**
- [ ] Feature works as described
- [ ] No breaking changes
- [ ] Edge cases handled
- [ ] User experience is smooth
- [ ] No performance issues

#### **Testing:**
- [ ] Unit tests added
- [ ] Integration tests added
- [ ] Manual testing completed
- [ ] All tests passing
- [ ] No test failures

#### **Documentation:**
- [ ] Code is well-commented
- [ ] README updated if needed
- [ ] API documentation updated
- [ ] Usage examples provided
- [ ] Changelog updated

### 🚨 Common Review Issues

#### **Code Issues:**
- Missing error handling
- Inconsistent naming
- Code duplication
- Performance problems
- Security vulnerabilities

#### **Documentation Issues:**
- Missing comments
- Outdated documentation
- Unclear variable names
- Missing usage examples
- Incomplete README

#### **Testing Issues:**
- Missing test cases
- Failing tests
- Incomplete coverage
- No edge case testing
- Manual testing not done

### 📊 Review Statistics

#### **Track Review Metrics:**
```bash
# View PR statistics
gh pr list --state all --json number,title,author,createdAt,closedAt

# View review activity
gh api repos/:owner/:repo/pulls/123/reviews

# Check review status
gh pr status
```

### 🎯 Review Best Practices

#### **Effective Reviews:**
- Be constructive and helpful
- Focus on the code, not the person
- Explain the "why" behind suggestions
- Acknowledge good work
- Be specific about issues
- Suggest improvements, don't just criticize

#### **Response to Reviews:**
- Thank reviewers for their time
- Ask questions if unclear
- Explain your reasoning
- Make requested changes
- Update PR description if needed
- Re-request review when ready

---

**🔍 Remember: Code review is a collaborative process to improve code quality!**

## 📈 Progress Tracking

### Daily Standup
- What did you work on yesterday?
- What are you working on today?
- Any blockers or issues?

### Weekly Review
- Review completed features
- Plan next week's priorities
- Address any technical debt
- Update project timeline

### Phase Completion
- All features implemented
- All tests passing
- Documentation updated
- Performance benchmarks met
- Accessibility requirements met

---

**Last Updated**: $(date)
**Workflow Version**: 1.0
**Next Review**: Weekly
