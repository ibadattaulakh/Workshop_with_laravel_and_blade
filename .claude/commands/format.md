---
description: "Run format routine, fix issues, and ensure tests are green"
---

Run `composer run format`. If Rector or Pint report any issues, fix them and rerun until the format script passes completely.

Then run `php artisan test --compact`. If tests fail, fix them and rerun tests until all tests pass.

After tests are green, rerun `composer run format` one final time to ensure code style consistency.
