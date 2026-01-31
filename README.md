## Laravel Workshop - Pixl

This is the source code for the demo project, Pixl, from Laracasts. 

[The Laravel Workshop](https://laracasts.com/series/the-laravel-workshop)

At the conclusion of Section 3, we pass it over to YOU.

## Context Seven Integration

This project uses Context Seven for up-to-date package documentation. See [CONTEXT_SEVEN.md](./CONTEXT_SEVEN.md) for setup instructions.

**Quick review prompt for Telegram/Nutgram code:**
```
I'd like you to review my Telegram bot code that leverages the Nutgram library.
Use Context Seven to confirm that I'm following best practices and look at the app/Services/Telegram folder.
```

## Claude Commands

This project includes reusable Claude commands for common workflows. See [.claude/commands/README.md](.claude/commands/README.md) for available commands.

**Quick examples:**
- `/learn app/Models/User.php` - Explain a file
- `/format` - Run format routine and fix issues
- `/test` - Run tests and fix failures
- `/review-telegram` - Review Telegram bot with Context Seven

## PhpStorm Prompt Library

This project includes reusable prompts for PhpStorm's Prompt Library. See [phpstorm-prompt-library.md](./phpstorm-prompt-library.md) for setup and [phpstorm-prompts/](./phpstorm-prompts/) for available prompts.

**Available prompts:**
- Vue 2 → Vue 3 conversion
- Generate Pest tests
- Extract Form Requests
- Add type hints
- And more...

**Usage:** Select code → Refactor → Add Your Prompts → Choose prompt → Review diff → Accept

## Claude Skills

This project includes Claude Skills - field guides for multi-step workflows. See [claude-skills-guide.md](./claude-skills-guide.md) for details.

**Available skills:**
- `fix-issue` - Complete workflow for fixing GitHub issues (fetch → fix → test → PR)
- `pest-testing` - Pest 4 testing framework
- `inertia-vue-development` - Inertia.js v2 Vue development
- `tailwindcss-development` - Tailwind CSS v4 styling

**Usage:** Ask Claude to "fix issue #3" or "resolve GitHub issue 5" and it will automatically use the `fix-issue` skill.

## Laravel Simplifier Agent

This project includes documentation and commands for Laravel Simplifier - a Claude plugin for Laravel-specific code cleanup. See [laravel-simplifier-guide.md](./laravel-simplifier-guide.md) for setup and usage.

**Installation:** Plugins / Marketplace → Laravel Simplifier

**Usage:**
- `/simplify` - Run Laravel Simplifier on changed files
- `/simplify-strict` - Run with strict constraints (no API changes)

**Best practices:**
- Always verify tests locally after cleanup
- Review diffs before accepting changes
- Use as starting point, not final solution

## Claude Subagents

This project includes documentation and examples for Claude Subagents - isolated tasks that run in the background. See [claude-subagents-guide.md](./claude-subagents-guide.md) for details.

**Key concepts:**
- **Commands**: Triggers (like Artisan commands) - use most often
- **Skills**: Guidebooks for workflows - use for complex processes
- **Subagents**: Isolated tasks - use for background work

**Available examples:**
- Code review agent
- Planning agent
- Research agent
- Refactoring agent

**Usage:** Create agents in Claude UI, then trigger with "use [agent] to [task]"

## Claude Chrome Integration

This project includes documentation and commands for Claude's Chrome integration - allowing agents to open a real browser and interact with your app. See [claude-chrome-integration-guide.md](./claude-chrome-integration-guide.md) for setup and usage.

**Setup:**
1. Update Cloud Code to latest version
2. Enable Chrome: `claude --enable-chrome`
3. Check connection: `claude chrome:check`
4. Enable MCP/IDE tools

**Available commands:**
- `/test-with-chrome` - Test a feature or flow in real browser
- `/debug-with-chrome` - Debug client-side issues (white screens, JS errors)
- `/verify-feature` - Verify feature works end-to-end

**Use cases:**
- Ad-hoc verification during development
- Debugging client-side issues
- Testing UI flows
- Verifying features work before merging

**Note:** Not a replacement for browser tests (Dusk, Playwright) - use for development verification, write tests for CI/CD.

## Claude GitHub PR Integration

This project includes documentation for Claude's GitHub PR integration - allowing you to mention Claude in PR comments to make code changes. See [claude-github-pr-integration-guide.md](./claude-github-pr-integration-guide.md) for setup and usage.

**Setup:**
1. Install Claude GitHub app for repository
2. Configure mention-only mode (recommended)
3. Use repository-only access (safer)

**Usage:**
Mention Claude in PR comments:
```
@Claude change PostBookmark to Bookmark and update related files as needed.
```

**Available commands:**
- `/pr-improve` - Generate PR comment for Claude improvements

**Use cases:**
- Small renames and refactors
- Consistency fixes
- Addressing review comments
- Quick improvements during review

**Best practices:**
- Be specific in requests
- Review all changes carefully
- Test after changes
- Use for small, deterministic changes only

## Claude Interview Planning

This project includes documentation for using Claude's interview technique to create better plans. See [claude-interview-planning-guide.md](./claude-interview-planning-guide.md) for details.

**Key concept:** Have Claude interview you before planning instead of guessing what you want.

**Usage:**
```
Explore [directory], understand how it works, then interview me (using the Ask User Question tool) to flesh out a plan for [feature].
```

**Enable plan mode:** Press Shift+Tab before or during interview

**Available commands:**
- `/plan-with-interview` - Create plan by interviewing first

**Benefits:**
- More accurate plans
- Surfaces important tradeoffs
- Reduces assumptions
- Less rework needed

**Use when:**
- Feature isn't fully thought out
- Multiple approaches possible
- Important decisions needed
- Want to explore tradeoffs

## Testing Requirements

**CRITICAL**: Testing is non-negotiable when AI generates code. See [testing-requirements-guide.md](./testing-requirements-guide.md) for details.

**Mandatory Rules:**
- When creating a new endpoint, you MUST create tests
- When implementing a new feature, you MUST write tests
- Before refactoring AI-generated code, add tests first
- Work is not complete until tests are written AND tests pass

**Why Tests Matter:**
- Only reliable feedback loop for AI-generated code
- Enables safe refactoring
- Guards against regressions
- Defines behavior contract

**Available commands:**
- `/add-tests` - Add tests for code without tests
- `/test` - Run tests

**Workflow:**
1. AI generates code
2. Add tests (if missing) - `/add-tests`
3. Ensure tests pass - `/test`
4. Refactor safely
5. Verify tests still pass

**If AI omits tests:**
1. Stop and add tests immediately
2. Update `.ai/guidelines/laravel.md`
3. Regenerate: `php artisan boost:install`
4. Ensure AI knows tests are required

## Git Worktrees

This project includes a helper script for creating Git worktrees - separate working directories for concurrent agent work. See [git-worktrees-guide.md](./git-worktrees-guide.md) for details.

**Why use worktrees:**
- Run multiple AI agents concurrently
- Avoid collisions between agents
- Isolated workspaces per feature
- Shared Git history

**Quick start:**
```bash
# Create worktree for feature
bin/worktree bookmarking

# Use worktree
cd ../laravel-workshop-bookmarking

# Merge when done
git checkout main
git merge bookmarking
git worktree remove ../laravel-workshop-bookmarking
```

**The script automates:**
- Creating worktree and branch
- Installing dependencies (composer, npm)
- Setting up Laravel (.env, key, migrations)
- Building assets

**Use cases:**
- Multiple agents on different features
- Agent working while you code
- Testing different approaches
- Isolated feature development

## Ralph Wiggum Technique

This project includes an automated agent workflow script. See [ralph-wiggum-technique-guide.md](./ralph-wiggum-technique-guide.md) for details.

**What it does:**
- Reads `tasks.md` file
- Agent picks one incomplete task
- Implements the change
- Runs tests and formatters
- Commits changes
- Updates tasks.md with progress
- Repeats until done

**Usage:**
```bash
# Populate tasks.md with incomplete tasks
# Then run:
bin/ralph [max_iterations]

# Example:
bin/ralph 10
```

**Safety features:**
- Max iterations limit (prevents infinite loops)
- Completion flag (`ralph_complete` when done)
- Pre-approve agent permissions

**Configuration:**
Edit `bin/ralph` to replace agent CLI placeholder with your actual agent command.

**Best practices:**
- Start with simple tasks
- Set max iterations
- Review changes carefully
- Pre-approve trusted commands only
- Use worktrees for isolation 

## Section 4

At this point, we have a working SPA that can be pushed to production. But, of course, there's so much more to do. Here are some ideas, if you'd like to continue your learning:

1. Implement the Bookmarking feature. When the user clicks the bookmark icon, the `user_id` and `post_id` fields should be inserted into a new `bookmarks` table that you create.
2. Implement the UI and forms for registration, login, and profile editing. Then update the dev-specific endpoints within your `routes/web.php` file accordingly.
3. Use [Laravel Socialite](https://laravel.com/docs/12.x/socialite) to add "Sign In With Google" and "Sign In With GitHub" functionality.
4. Both `PostController` and `ProfileController` include non-resourceful actions. While this is okay, consider extracting new controllers. Perhaps the `like` and `unlike` within `PostController` could be extracted to a `LikePostController` controller. This would allow you to return to `store` and `destroy` action/method names.
5. Add a "Highlights" feature. Any user may mark their own post as "highlighted." This will make the post show up within the "Highlights" tab on their profile page.
6. Add support for attaching an image to a post. Research Laravel's `Storage` component [to learn more](https://laravel.com/docs/12.x/filesystem#specifying-a-disk).
