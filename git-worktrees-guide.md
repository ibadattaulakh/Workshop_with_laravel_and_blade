# Git Worktrees Guide

## Overview

Git worktrees allow you to have multiple working directories for the same repository, each pointing to different branches. This is incredibly useful when running multiple AI agents concurrently on the same repository.

## Why Worktrees Matter

### The Problem

When running multiple agents:
- ❌ One agent edits a file, another deletes it
- ❌ Conflicts and collisions
- ❌ Messy state
- ❌ Can't work concurrently safely

### The Solution

Worktrees provide:
- ✅ Separate working directories
- ✅ Shared Git history
- ✅ No collisions
- ✅ Concurrent agent work
- ✅ Isolated environments

## What is a Worktree?

**A worktree is nothing more than a separate directory that points to the same Git history.**

That's it. Separate directory, same history. You can have as many worktrees as you like.

## Basic Usage

### Create Worktree with New Branch

```bash
# Create new worktree and branch at the same time
git worktree add -b bookmarking ../laravel-workshop-bookmarking
```

### Create Worktree for Existing Branch

```bash
# If branch already exists
git worktree add ../laravel-workshop-bookmarking bookmarking
```

### Create Branch Separately

```bash
# Create branch first
git checkout -b bookmarking

# Then add worktree
git worktree add ../laravel-workshop-bookmarking bookmarking
```

### Remove Worktree

```bash
git worktree remove ../laravel-workshop-bookmarking
```

**Note**: Removing the worktree does NOT delete the branch. Branches are independent of worktree folders.

## Laravel Setup Requirements

When creating a new worktree, you must run Laravel setup steps because the new directory starts without installed dependencies or environment config.

### Required Steps

1. **Install PHP dependencies**
   ```bash
   composer install
   ```

2. **Install frontend packages**
   ```bash
   npm install
   ```

3. **Run post-create scripts**
   ```bash
   composer run post-create-project-cmd
   ```

4. **Generate app key**
   ```bash
   php artisan key:generate
   ```

5. **Run migrations**
   ```bash
   php artisan migrate --force
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

### Common Errors

If you see errors like:
- `missing vendor/autoload.php` → Run `composer install`
- `No application key specified` → Run `php artisan key:generate`
- Database errors → Run `php artisan migrate`

## Automated Setup Script

Use the provided script to automate worktree creation and setup:

```bash
bin/worktree highlights
```

This will:
1. Create worktree with new branch
2. Install dependencies
3. Run setup scripts
4. Generate key
5. Run migrations
6. Build assets

## Workflow Examples

### Example 1: Multiple Agents

**Scenario**: Two agents working on different features

**Setup:**
```bash
# Agent 1: Bookmarking feature
bin/worktree bookmarking

# Agent 2: Highlights feature
bin/worktree highlights
```

**Result:**
- `../laravel-workshop-bookmarking` - Agent 1 workspace
- `../laravel-workshop-highlights` - Agent 2 workspace
- `./` - Your main workspace

All can work concurrently without collisions.

### Example 2: Agent + Human

**Scenario**: Agent working on feature while you continue other work

**Setup:**
```bash
# Create worktree for agent
bin/worktree bookmarking

# Agent works in: ../laravel-workshop-bookmarking
# You work in: ./
```

**Later:**
```bash
# Merge feature branch
git checkout main
git merge bookmarking

# Remove worktree
git worktree remove ../laravel-workshop-bookmarking
```

## Best Practices

### 1. Always Create Branch

Always create a branch when adding a worktree:
```bash
git worktree add -b feature-name ../worktree-name
```

This makes merging and traceability simple.

### 2. Remember Setup Steps

Don't forget Laravel setup:
- `composer install`
- `npm install`
- `php artisan key:generate`
- `php artisan migrate`
- `npm run build`

Use the script to automate.

### 3. Use Descriptive Names

Name worktrees clearly:
```bash
# Good
../laravel-workshop-bookmarking
../laravel-workshop-highlights

# Bad
../worktree1
../worktree2
```

### 4. Clean Up When Done

After merging:
```bash
git worktree remove ../laravel-workshop-bookmarking
```

### 5. List Worktrees

See all worktrees:
```bash
git worktree list
```

## Integration with Agents

### Agent 1: Feature A

```bash
bin/worktree feature-a
cd ../laravel-workshop-feature-a
# Start agent here
```

### Agent 2: Feature B

```bash
bin/worktree feature-b
cd ../laravel-workshop-feature-b
# Start agent here
```

### Main Directory: Your Work

```bash
# Continue working in main directory
# No collisions with agents
```

## Troubleshooting

### Worktree Already Exists

```bash
# Remove existing worktree first
git worktree remove ../laravel-workshop-bookmarking

# Then create new one
bin/worktree bookmarking
```

### Branch Already Exists

```bash
# Use existing branch
git worktree add ../laravel-workshop-bookmarking bookmarking
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
php artisan migrate --force
```

### Build Errors

```bash
cd ../laravel-workshop-bookmarking
npm run build
```

## Summary

Worktrees are:
- ✅ Separate directories
- ✅ Shared Git history
- ✅ No collisions
- ✅ Perfect for multiple agents
- ✅ Isolated environments

**Use when:**
- Running multiple agents
- Want isolated workspaces
- Need concurrent development
- Avoiding collisions

**Remember:**
- Always create branch
- Run Laravel setup
- Use automation script
- Clean up when done
