# Claude GitHub PR Integration Examples

## Setup Commands

### Install GitHub App

```bash
# Use Cloud Code helper to install Claude GitHub app
# Follow prompts to authorize repository
```

**Settings:**
- Repository-only access (not org-wide)
- Mention-only mode (explicit control)
- Only trusted repositories

## Example PR Comments

### Rename Class

**Scenario**: PR has `PostBookmark` class, should be `Bookmark`

**Comment:**
```
@Claude change PostBookmark to Bookmark and update related files as needed.
```

**What Claude Does:**
- Renames class file
- Updates migrations
- Updates factories
- Updates controllers
- Updates tests
- Posts summary

### Extract Trait

**Scenario**: Multiple classes have duplicate error handling

**Comment:**
```
@Claude extract the common error handling logic into a HandlesErrors trait and update all job classes in this PR to use it.
```

**What Claude Does:**
- Creates `HandlesErrors` trait
- Moves common logic to trait
- Updates job classes
- Removes duplicate code
- Posts summary

### Add Return Types

**Scenario**: Controller methods missing return types

**Comment:**
```
@Claude add explicit return types to all controller methods in PostController.
```

**What Claude Does:**
- Adds return types to methods
- Uses appropriate types
- Follows Laravel conventions
- Posts summary

### Use Form Requests

**Scenario**: Controller has inline validation

**Comment:**
```
@Claude extract validation logic from PostController::store into a StorePostRequest class and update the controller to use it.
```

**What Claude Does:**
- Creates `StorePostRequest` class
- Moves validation rules
- Updates controller
- Adds custom messages if needed
- Posts summary

### Consistency Fix

**Scenario**: Mix of helpers and facades

**Comment:**
```
@Claude update all instances of auth() helper to use Auth:: facade throughout the changed files in this PR.
```

**What Claude Does:**
- Finds all `auth()` calls
- Replaces with `Auth::` facade
- Updates imports
- Posts summary

### Fix Visibility

**Scenario**: Method should be public but is protected

**Comment:**
```
@Claude change the visibility of PostController::index from protected to public.
```

**What Claude Does:**
- Changes method visibility
- Verifies routing works
- Posts summary

### Extract Service

**Scenario**: Controller has business logic

**Comment:**
```
@Claude extract the business logic from PostController::store into a PostService class and update the controller to use it.
```

**What Claude Does:**
- Creates `PostService` class
- Moves business logic
- Updates controller
- Posts summary

## Complete Workflow Examples

### Example 1: Rename and Refactor

**Initial PR:**
- Feature branch: `feature/bookmarking`
- Has `PostBookmark` model
- Inline validation in controller

**PR Comments:**

1. **Rename:**
   ```
   @Claude change PostBookmark to Bookmark and update all references.
   ```

2. **Extract Validation:**
   ```
   @Claude extract validation from BookmarkController::store into a StoreBookmarkRequest class.
   ```

**Result:**
- Class renamed
- Form Request created
- Controller updated
- All references updated

### Example 2: Consistency Improvements

**Initial PR:**
- Mix of helpers and facades
- Missing return types
- Inconsistent naming

**PR Comments:**

1. **Facades:**
   ```
   @Claude replace all helper functions (auth(), config(), etc.) with their facade equivalents in the changed files.
   ```

2. **Return Types:**
   ```
   @Claude add explicit return types to all methods in the changed controllers.
   ```

**Result:**
- Consistent facade usage
- All methods have return types
- Code follows guidelines

### Example 3: Extract Common Logic

**Initial PR:**
- Multiple classes with duplicate code
- Repeated error handling
- Similar patterns

**PR Comments:**

1. **Error Handling:**
   ```
   @Claude extract the error handling pattern into a HandlesApiErrors trait and use it in all API controllers.
   ```

2. **Common Logic:**
   ```
   @Claude extract the common query logic into a scope method on the Post model.
   ```

**Result:**
- Trait created
- Scope method added
- Code deduplicated
- Consistency improved

## Best Practices for Comments

### Be Specific

**Good:**
```
@Claude rename PostBookmark to Bookmark and update migrations, factories, controllers, and tests.
```

**Bad:**
```
@Claude fix the naming.
```

### One Change Per Comment

**Good:**
```
@Claude rename PostBookmark to Bookmark.
```

Then separately:
```
@Claude extract validation into Form Request.
```

**Bad:**
```
@Claude rename PostBookmark, extract validation, add return types, and fix all the things.
```

### Include Scope

**Good:**
```
@Claude update all changed files in this PR to use Auth:: facade instead of auth() helper.
```

**Bad:**
```
@Claude use facades.
```

### Reference Files When Needed

**Good:**
```
@Claude extract validation from PostController::store into StorePostRequest.
```

**Bad:**
```
@Claude extract validation.
```

## Monitoring

### Actions Tab

Watch the GitHub Action:
- Job starts when Claude is mentioned
- Progress updates in real-time
- Completion status shown
- Errors displayed if any

### PR Comments

Claude posts:
- Summary of changes made
- List of files modified
- Links to updated files
- Any issues encountered

### Review Process

1. **Check Actions Tab**
   - See job status
   - Monitor progress
   - Check for errors

2. **Review Summary**
   - Read Claude's comment
   - Check files modified
   - Review links

3. **Review Diff**
   - Check actual changes
   - Verify correctness
   - Test functionality

4. **Merge or Request Changes**
   - Merge if good
   - Request more changes if needed
   - Test locally first

## Troubleshooting

### Claude Not Responding

**Check:**
- GitHub app installed?
- Mention format correct? (`@Claude`)
- Actions tab shows job?
- Workflow enabled?

**Fix:**
- Reinstall app if needed
- Check mention format
- Verify repository access
- Check Actions for errors

### Changes Not Applied

**Check:**
- Error messages in Actions
- Permissions correct?
- Repository access?
- Instructions clear?

**Fix:**
- Review error messages
- Check permissions
- Verify access
- Provide clearer instructions

### Unexpected Changes

**Check:**
- Review diff carefully
- Verify scope
- Check related files

**Fix:**
- Revert if needed
- Provide more specific instructions
- Use smaller requests
- Review before merging

## Security Considerations

### Repository Access

- ✅ Install on specific repos only
- ✅ Use repository-only access
- ✅ Avoid org-wide access
- ✅ Only trusted repositories

### Mention-Only Mode

- ✅ Enable mention-only
- ✅ Explicit control
- ✅ Safer default
- ✅ No auto-reviews

### Review Process

- ✅ Always review changes
- ✅ Test before merging
- ✅ Verify functionality
- ✅ Don't auto-merge

## Integration Tips

### With Code Review

1. Review PR normally
2. Identify improvements
3. Mention Claude for fixes
4. Review changes
5. Merge if good

### With Local Testing

1. Claude makes changes
2. Pull changes locally
3. Run tests: `php artisan test`
4. Verify functionality
5. Merge if passing

### With Other Tools

- Use `/test` command after changes
- Use `/format` to verify style
- Use `/code-review` for additional review
- Use Chrome integration to verify UI

## Summary

**Use for:**
- Small, deterministic changes
- Renames and refactors
- Consistency fixes
- Addressing review comments

**Always:**
- Review changes carefully
- Test after changes
- Be specific in requests
- Use for trusted repos only

**Avoid:**
- Complex changes
- Design decisions
- Unclear requests
- Auto-merging without review
