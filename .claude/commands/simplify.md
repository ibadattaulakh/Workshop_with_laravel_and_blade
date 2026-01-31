---
description: "Run Laravel Simplifier agent on changed files to clean up code"
---

Use the Laravel Simplifier agent to review all changed files in git and clean things up, confirming the test suite still passes.

Team conventions to follow:
- Prefer extraction into services over inline logic
- Extract common error handling patterns to traits
- Extract repeated logic into helper methods
- Add or refine return types where missing
- Follow existing code patterns and structure
- Maintain all existing functionality
- Keep tests passing

Do not change public APIs, only internal refactors.

After the agent completes, verify:
1. Run `php artisan test --compact` to ensure tests pass
2. Run `composer run format` to ensure code style
3. Review all changes before accepting
