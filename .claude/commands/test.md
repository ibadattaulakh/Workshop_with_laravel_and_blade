---
description: "Run tests and fix any failures"
---

Run `php artisan test --compact`. If any tests fail, analyze the failures, fix the issues, and rerun the tests. Continue until all tests pass.

**CRITICAL**: Testing is non-negotiable when AI generates code. If code was generated without tests, use `/add-tests` to add them first.

If you need to run a specific test file, use: `php artisan test --compact tests/Feature/TestName.php` or filter with `--filter=testName`.

**Remember**: Work is not complete until tests are written AND tests pass.
