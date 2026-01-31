---
description: "Create a new Pest test for a feature or class"
---

Create a new Pest test file for `$1`. 

Use `php artisan make:test --pest $1` to create the test file.

Then write comprehensive tests that:
- Test the happy path
- Test edge cases
- Test error conditions
- Follow existing test patterns in the codebase

Run the test with `php artisan test --compact --filter=$1` to ensure it passes.
