---
description: "Generate a PR comment to ask Claude to make improvements"
---

Generate a GitHub PR comment that mentions Claude to make code improvements.

Based on the PR changes, suggest a comment that:
- Mentions @Claude
- Provides clear, specific instructions
- Focuses on small, deterministic changes
- Includes scope of changes needed

Common improvements to suggest:
- Rename classes/methods for consistency
- Extract common logic into traits/helpers
- Add missing return types
- Use Form Requests instead of inline validation
- Replace helpers with facades (per guidelines)
- Fix code style issues
- Update related files

Format the comment as ready to paste into GitHub PR.

Example format:
```
@Claude [specific instruction] and update related files as needed.
```

Provide multiple comment options if there are several improvements possible.
