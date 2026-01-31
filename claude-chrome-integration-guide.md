# Claude Chrome Integration Guide

## Overview

Claude agents can physically open a web browser and interact with your application to confirm that the work they did actually works. This is great for sanity-checking UI flows without manually clicking through everything.

## What It Does

The agent can:
- ✅ Open a real browser (Google Chrome)
- ✅ Visit pages
- ✅ Fill forms
- ✅ Click buttons and links
- ✅ Verify behavior
- ✅ Read console logs
- ✅ Debug client-side issues
- ✅ Confirm end-to-end flows work

## Setup

### Prerequisites

1. **Latest Claude/Cloud Code**
   - Update to the latest version
   - Follow official Cloud Code documentation

2. **Chrome Browser**
   - Google Chrome must be installed
   - Agent will use Chrome for interactions

3. **MCP Tools**
   - Ensure browser tools are enabled
   - Enable IDE integration if using PhpStorm

### Configuration Steps

#### 1. Update Tooling

Follow official Cloud Code documentation to update:
```bash
# Example (check official docs for exact commands)
# Update Claude/Cloud Code to latest version
```

#### 2. Enable Chrome Integration

Boot Claude with Chrome enabled:
```bash
# Example (check official docs for exact flags)
claude --enable-chrome
```

#### 3. Check Chrome Connection

Verify the browser bridge is working:
```bash
# Example (check official docs for exact commands)
claude chrome:check
```

#### 4. PhpStorm Integration (if using)

Run IDE helper command:
```bash
# Follow Cloud Code docs for PhpStorm integration
# Ensures agent can communicate with IDE and project
```

#### 5. Enable MCP Tools

Ensure browser and IDE tools are enabled:
- Browser tools for Chrome interaction
- IDE tools for project navigation
- MCP tools for project context

## How It Works

### Basic Flow

1. **Agent receives instruction** (e.g., "test registration flow")
2. **Agent opens Chrome** and navigates to your app
3. **Agent interacts** with the page (clicks, fills forms)
4. **Agent verifies** behavior and reports back
5. **Agent can debug** issues by reading console logs

### Example: Registration Flow

**Request:**
```
Visit the home page, click the registration link, fill out the registration form, and confirm the account is created successfully.
```

**Agent Actions:**
1. Opens Chrome
2. Navigates to home page
3. Finds and clicks registration link
4. Asks about form fields (username, email, password)
5. Fills form with provided values
6. Submits form
7. Verifies success message
8. Reports back: "Welcome aboard. Registration flow completed successfully."

### Interactive Prompts

You'll see back-and-forth prompts as the agent asks:
- "What fields does the registration form have?"
- "What values should I use for testing?"
- "What should I verify after submission?"

Answer these prompts and the agent continues.

## Usage Examples

### Example 1: Test Registration Flow

```
Use Chrome to test the registration flow:
1. Visit the home page
2. Click the "Get Started" / registration link
3. Fill out the registration form as a guest
4. Confirm the account is created and the flow finishes successfully
```

### Example 2: Verify Feature Works

```
Use Chrome to verify the new feature works:
1. Visit the feature page
2. Interact with the new functionality
3. Verify it behaves correctly
4. Check for any console errors
```

### Example 3: Debug White Screen

```
I'm seeing a white screen on the home page. Use Chrome to:
1. Visit the page
2. Read console logs
3. Identify the error
4. Suggest a fix
```

### Example 4: Test Form Submission

```
Use Chrome to test the contact form:
1. Navigate to the contact page
2. Fill out all required fields
3. Submit the form
4. Verify success message appears
5. Check for any validation errors
```

## When to Use

### Good Use Cases

✅ **Ad-hoc verification**
- Quick sanity checks
- Debugging freshly generated features
- Verifying UI flows work

✅ **During development**
- While actively implementing
- Faster than manual testing
- Proves whole stack works (frontend + backend)

✅ **Debugging client issues**
- White screens
- JavaScript errors
- Console errors
- Form validation issues

✅ **End-to-end verification**
- Complete user flows
- Multi-step processes
- Integration verification

### Not a Replacement For

❌ **CI/CD browser tests**
- Still need dedicated browser tests (Dusk, Playwright, Cypress)
- Should run as part of CI
- Long-term reliability

❌ **Comprehensive test coverage**
- Use for ad-hoc checks
- Not for full test suite
- Manual verification still needed

## Best Practices

### 1. Use for Ad-Hoc Verification

- Great for quick checks during development
- Useful when AI says "it works" but you want to see it
- Faster than manual clicking through flows

### 2. Still Write Browser Tests

- Use Chrome integration for development/debugging
- Write dedicated browser tests for CI
- Don't rely solely on Chrome integration

### 3. Enable All Tools

- Enable browser tools
- Enable IDE integration
- Enable MCP tools
- Give agent maximum project awareness

### 4. Start Small

- Try on simple flows first (registration, login)
- See how it fits your workflow
- Expand to more complex flows

### 5. Review Agent Actions

- Watch what the agent does
- Verify it's testing correctly
- Provide feedback if needed

## Integration with Other Tools

### With Browser Tests

**Chrome Integration**: Ad-hoc verification during development
**Browser Tests**: Automated tests in CI/CD

Use both:
- Chrome integration for quick checks
- Browser tests for reliability

### With Claude Commands

After Chrome verification:
```
/test    # Run automated tests
/format  # Format code
```

### With Claude Skills

Use `fix-issue` skill, then Chrome to verify:
1. Fix the issue
2. Use Chrome to verify fix works
3. Run automated tests

## Troubleshooting

### Agent Can't Connect to Chrome

- Verify Chrome is installed
- Check Chrome bridge is running
- Run `claude chrome:check`
- Restart Claude with Chrome flag

### Agent Can't Find Elements

- Ensure page is fully loaded
- Check element selectors
- Verify page structure
- Provide more specific instructions

### White Screen or Errors

- Have agent read console logs
- Check for JavaScript errors
- Verify routes are working
- Check server is running

### Slow Performance

- Normal - real browser is slower than headless
- Be patient during interactions
- Use for verification, not speed

## Example Workflows

### Workflow 1: Feature Verification

1. **AI generates feature code**
2. **Use Chrome to verify:**
   ```
   Use Chrome to test the new feature:
   1. Visit the feature page
   2. Interact with the feature
   3. Verify it works correctly
   ```
3. **Review agent actions**
4. **Fix any issues found**
5. **Run automated tests**

### Workflow 2: Debugging Issue

1. **Report issue**: "White screen on home page"
2. **Use Chrome to debug:**
   ```
   Use Chrome to debug the white screen:
   1. Visit the home page
   2. Read console logs
   3. Identify the error
   4. Suggest a fix
   ```
3. **Agent identifies issue**
4. **Fix the code**
5. **Verify fix with Chrome**

### Workflow 3: Form Testing

1. **Create form**
2. **Use Chrome to test:**
   ```
   Use Chrome to test the form:
   1. Navigate to form page
   2. Fill required fields
   3. Submit form
   4. Verify success/error handling
   ```
3. **Review form behavior**
4. **Fix validation issues**
5. **Write browser tests**

## Tips

### 1. Be Specific

Provide clear instructions:
```
Good: "Visit /register, fill email and password, submit"
Bad: "Test registration"
```

### 2. Answer Prompts

When agent asks about form fields:
- Provide field names
- Provide test values
- Specify what to verify

### 3. Watch the Browser

- Observe agent actions
- Verify it's testing correctly
- Provide feedback if needed

### 4. Use for Verification

- Great when AI says "it works"
- Verify before merging
- Extra guard before deployment

### 5. Combine with Tests

- Chrome integration for quick checks
- Browser tests for CI/CD
- Both have their place

## Quick Reference

**Setup:**
1. Update Cloud Code
2. Enable Chrome: `claude --enable-chrome`
3. Check connection: `claude chrome:check`
4. Enable MCP/IDE tools

**Use:**
```
Use Chrome to [test/debug/verify] [feature/flow]
```

**Verify:**
- Watch agent actions
- Review results
- Run automated tests

## Summary

Chrome integration is:
- ✅ Great for ad-hoc verification
- ✅ Useful during development
- ✅ Excellent for debugging
- ✅ Faster than manual testing
- ⚠️ Not a replacement for browser tests
- ⚠️ Slower than headless tests
- ⚠️ Use for verification, not CI/CD

**Use it to:**
- Verify features work
- Debug client issues
- Test UI flows
- Confirm end-to-end behavior

**Still write:**
- Dedicated browser tests
- CI/CD test suites
- Comprehensive test coverage
