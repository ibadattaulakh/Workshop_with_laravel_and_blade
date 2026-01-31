# Bin Scripts

Helper scripts for common development tasks.

## worktree

Creates a new Git worktree with Laravel setup.

### Usage

```bash
bin/worktree <feature-name>
```

### Example

```bash
bin/worktree bookmarking
```

### What It Does

1. Creates worktree with new branch
2. Installs composer dependencies
3. Installs npm packages
4. Copies .env if needed
5. Generates app key
6. Sets up database
7. Runs migrations
8. Builds assets

### Output

Creates directory: `../laravel-workshop-<feature-name>`

### Clean Up

```bash
git worktree remove ../laravel-workshop-<feature-name>
```

See [git-worktrees-guide.md](../git-worktrees-guide.md) for complete documentation.

## ralph

Automated agent workflow (Ralph Wiggum Technique) that reads tasks.md, picks one task, implements it, tests, formats, commits, and updates tasks.md.

### Usage

```bash
bin/ralph [max_iterations]
```

### Example

```bash
bin/ralph 10
```

### What It Does

1. Reads tasks.md
2. Agent picks one incomplete task
3. Agent implements the change
4. Runs tests (must pass)
5. Runs formatters
6. Commits changes
7. Updates tasks.md with progress
8. Repeats until done or max iterations

### Configuration

Edit `bin/ralph` to replace agent CLI placeholder with your actual agent command.

### Safety

- Max iterations limit (default: 10)
- Completion flag (`ralph_complete`)
- Pre-approve agent permissions

See [ralph-wiggum-technique-guide.md](../ralph-wiggum-technique-guide.md) for complete documentation.
