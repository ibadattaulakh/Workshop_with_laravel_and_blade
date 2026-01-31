# Git Worktrees Examples

## Quick Start

### Create Worktree

```bash
bin/worktree bookmarking
```

This creates:
- New branch: `bookmarking`
- New directory: `../laravel-workshop-bookmarking`
- Installs dependencies
- Sets up Laravel
- Builds assets

### Use Worktree

```bash
cd ../laravel-workshop-bookmarking
# Work here, start agent here, etc.
```

### Merge and Clean Up

```bash
# Back in main directory
git checkout main
git merge bookmarking

# Remove worktree
git worktree remove ../laravel-workshop-bookmarking
```

## Common Scenarios

### Scenario 1: Multiple Agents

**Goal**: Run two agents on different features concurrently

**Setup:**
```bash
# Agent 1: Bookmarking
bin/worktree bookmarking

# Agent 2: Highlights
bin/worktree highlights
```

**Usage:**
```bash
# Agent 1 workspace
cd ../laravel-workshop-bookmarking
# Start agent here

# Agent 2 workspace
cd ../laravel-workshop-highlights
# Start agent here

# Your workspace
cd /path/to/laravel-workshop
# Continue your work
```

**Result**: All three can work without collisions.

### Scenario 2: Agent + Human

**Goal**: Let agent work on feature while you continue other work

**Setup:**
```bash
# Create worktree for agent
bin/worktree bookmarking
```

**Agent Work:**
```bash
cd ../laravel-workshop-bookmarking
# Agent works here
# Creates migrations, models, controllers, etc.
```

**Your Work:**
```bash
# Stay in main directory
# Continue working on other features
# No interference
```

**Merge:**
```bash
git checkout main
git merge bookmarking
git worktree remove ../laravel-workshop-bookmarking
```

### Scenario 3: Testing Different Approaches

**Goal**: Try two different implementations

**Setup:**
```bash
# Approach 1: Service-based
bin/worktree bookmarking-service

# Approach 2: Repository-based
bin/worktree bookmarking-repository
```

**Test Both:**
```bash
# Test service approach
cd ../laravel-workshop-bookmarking-service
php artisan test

# Test repository approach
cd ../laravel-workshop-bookmarking-repository
php artisan test
```

**Choose Best:**
```bash
# Merge the better approach
git checkout main
git merge bookmarking-service  # or bookmarking-repository
```

## Manual Commands

### Create Worktree Manually

```bash
# Create branch and worktree
git worktree add -b bookmarking ../laravel-workshop-bookmarking

# Or for existing branch
git worktree add ../laravel-workshop-bookmarking bookmarking
```

### Setup Laravel Manually

```bash
cd ../laravel-workshop-bookmarking

composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --force
npm run build
```

### List Worktrees

```bash
git worktree list
```

### Remove Worktree

```bash
git worktree remove ../laravel-workshop-bookmarking
```

## Integration with Agents

### Claude Agent Workflow

**Step 1: Create Worktree**
```bash
bin/worktree bookmarking
```

**Step 2: Start Agent**
```bash
cd ../laravel-workshop-bookmarking
# Start Claude agent here
# Agent works on bookmarking feature
```

**Step 3: Continue Your Work**
```bash
# In main directory
# Continue working on other features
```

**Step 4: Merge When Done**
```bash
git checkout main
git merge bookmarking
git worktree remove ../laravel-workshop-bookmarking
```

### Multiple Agents Workflow

**Agent 1: Bookmarking**
```bash
bin/worktree bookmarking
cd ../laravel-workshop-bookmarking
# Start agent 1
```

**Agent 2: Highlights**
```bash
bin/worktree highlights
cd ../laravel-workshop-highlights
# Start agent 2
```

**Agent 3: Search**
```bash
bin/worktree search
cd ../laravel-workshop-search
# Start agent 3
```

**All work concurrently without collisions.**

## Tips

### 1. Use Descriptive Names

```bash
# Good
bin/worktree bookmarking
bin/worktree highlights
bin/worktree search-feature

# Bad
bin/worktree test
bin/worktree temp
bin/worktree feature1
```

### 2. Clean Up Regularly

After merging features:
```bash
git worktree remove ../laravel-workshop-bookmarking
```

### 3. Check Before Creating

```bash
# List existing worktrees
git worktree list

# Check if directory exists
ls -la ../laravel-workshop-*
```

### 4. Remember Setup

Each worktree needs:
- Dependencies installed
- Environment configured
- Database migrated
- Assets built

Use the script to automate.

### 5. Branch Strategy

Worktrees work with any branch:
- Feature branches
- Hotfix branches
- Experiment branches

## Troubleshooting

### Script Fails

**Check:**
- Feature name provided?
- Worktree already exists?
- In correct directory?
- Git repository?

**Fix:**
```bash
# Remove existing worktree
git worktree remove ../laravel-workshop-bookmarking

# Try again
bin/worktree bookmarking
```

### Missing Dependencies

```bash
cd ../laravel-workshop-bookmarking
composer install
npm install
```

### Database Issues

```bash
cd ../laravel-workshop-bookmarking
php artisan migrate:fresh --force
```

### Build Errors

```bash
cd ../laravel-workshop-bookmarking
rm -rf node_modules
npm install
npm run build
```

## Summary

**Create:**
```bash
bin/worktree <feature-name>
```

**Use:**
```bash
cd ../laravel-workshop-<feature-name>
```

**Merge:**
```bash
git checkout main
git merge <feature-name>
```

**Remove:**
```bash
git worktree remove ../laravel-workshop-<feature-name>
```

**Benefits:**
- ✅ Multiple isolated workspaces
- ✅ No collisions
- ✅ Concurrent agent work
- ✅ Easy cleanup
