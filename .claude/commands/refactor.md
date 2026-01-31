---
description: "Refactor code with Rector and ensure it still works"
---

Run `vendor/bin/rector process` to refactor the codebase. Review the changes Rector makes.

Then run `php artisan test --compact` to ensure all tests still pass after the refactoring.

If tests fail, fix any issues introduced by the refactoring and rerun tests until they pass.

Finally, run `vendor/bin/pint` to ensure code style is consistent.
