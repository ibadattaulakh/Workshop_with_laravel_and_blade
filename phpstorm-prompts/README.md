# PhpStorm Prompt Library - Reusable Prompts

This directory contains reusable prompts for PhpStorm's Prompt Library feature.

## How to Use

1. Copy the prompt text from any `.md` file below
2. In PhpStorm: **Refactor** → **Add Your Prompts**
3. Click "Add Prompt"
4. Paste the prompt text
5. Set the name and scope
6. Save

## Available Prompts

### `vue2-to-vue3.md`
Converts Vue 2 Options API components to Vue 3 Composition API with TypeScript.

### `generate-pest-test.md`
Generates comprehensive Pest tests for selected code.

### `extract-form-request.md`
Extracts validation logic from controllers into Form Request classes.

### `add-type-hints.md`
Adds explicit type declarations to PHP code.

## Adding New Prompts

1. Create a new `.md` file in this directory
2. Include:
   - Prompt Name
   - Prompt Text
   - Scope
   - Example Before/After (if applicable)
   - Usage instructions
3. Update this README

## Sharing with Team

Team members can:
1. Read the prompt files
2. Recreate prompts in their PhpStorm
3. Or export/import PhpStorm settings

## Integration

These prompts complement:
- **Claude Commands** (`.claude/commands/`) - Multi-file workflows
- **Prompt Library** - Single-file transformations

Use the right tool for the job!
