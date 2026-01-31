---
description: "Run Laravel Simplifier with strict constraints - no API changes, internal refactors only"
---

Use the Laravel Simplifier agent to review all changed files and clean things up with strict constraints.

**Constraints:**
- Do NOT change public APIs
- Only internal refactors allowed
- Prefer extraction into services over inline logic
- Extract common patterns to traits or helpers
- Add return types where missing
- Improve readability with small tweaks
- Follow existing code conventions

**Requirements:**
- Confirm that the test suite still passes
- Maintain all existing functionality
- Keep all public method signatures unchanged
- Only refactor internal implementation

After completion:
1. Run `php artisan test --compact`
2. Run `composer run format`
3. Review all changes carefully
4. Verify no public APIs were changed
