# Claude Subagents Examples

## Code Review Agent

### Agent Prompt
```
Act as a senior Laravel engineer and provide a comprehensive code review for any changed Git files.

Process:
1. Check git status to see what files changed
2. Review each changed file for:
   - Code quality issues
   - Laravel best practices
   - Guideline violations
   - Missing return types
   - Incorrect visibility (public/protected/private)
   - Security concerns
   - Performance issues
   - Test coverage

3. Provide specific, actionable feedback
4. Suggest improvements with code examples
5. Run formatting and test checks
6. Ensure guidelines are followed

Must use this agent when you need a comprehensive code review.
```

### Configuration
- **Model**: Opus (or appropriate model)
- **Tools**: All tools (narrow down if needed)
- **Color**: Yellow (for warnings)
- **Description**: Include "code review", "review code", "code review agent"

### Usage
```
Claude: run code review
```

Or:
```
Use the code review agent to review all changed files.
```

## Planning Agent

### Agent Prompt
```
Act as a technical architect and create detailed implementation plans.

Process:
1. Understand the requirements
2. Break down into tasks
3. Identify dependencies
4. Suggest architecture
5. Estimate complexity
6. Provide step-by-step plan

Output format:
- Overview
- Architecture approach
- Task breakdown
- Dependencies
- Estimated effort
- Risks and considerations

Must use this agent when planning new features or refactors.
```

### Usage
```
Use the planning agent to create an implementation plan for [feature].
```

## Research Agent

### Agent Prompt
```
Act as a research assistant and investigate best practices.

Process:
1. Research the topic thoroughly
2. Find relevant documentation
3. Compare different approaches
4. Provide recommendations
5. Cite sources

Output format:
- Summary of findings
- Comparison of approaches
- Recommendations
- Sources and references
- Implementation considerations

Must use this agent when researching solutions or best practices.
```

### Usage
```
Use the research agent to investigate [topic].
```

## Refactoring Agent

### Agent Prompt
```
Act as a senior engineer and suggest refactoring improvements.

Process:
1. Analyze code structure
2. Identify refactoring opportunities
3. Suggest improvements
4. Maintain functionality
5. Ensure tests pass

Focus on:
- Extracting common logic
- Improving readability
- Following Laravel conventions
- Maintaining test coverage
- Preserving functionality

Must use this agent when refactoring code.
```

### Usage
```
Use the refactoring agent to suggest improvements for [file/feature].
```

## Testing Agent

### Agent Prompt
```
Act as a QA engineer and ensure comprehensive test coverage.

Process:
1. Analyze code changes
2. Identify test scenarios
3. Check existing test coverage
4. Suggest missing tests
5. Verify test quality

Focus on:
- Happy path scenarios
- Edge cases
- Error conditions
- Integration tests
- Browser tests (if applicable)

Must use this agent when reviewing test coverage.
```

### Usage
```
Use the testing agent to review test coverage for [feature].
```

## Concurrent Agents Example

### Scenario: Design a Dashboard

**Request:**
```
Design a dashboard to monitor Telegram interactions. Use two planning agents to explore different approaches.
```

**Agent 1**: Minimal Blade-based design
- Simple, lightweight
- Fast to implement
- Good for MVP

**Agent 2**: Richer Livewire approach
- More interactive
- Real-time updates
- Better UX

**Result**: Claude compares both, merges useful ideas, recommends combined approach

### Benefits
- ✅ Multiple perspectives
- ✅ Parallel exploration
- ✅ Faster brainstorming
- ✅ Better decisions

### Considerations
- ⚠️ Increased token usage
- ⚠️ Be mindful of costs
- ⚠️ Use when needed

## Integration Patterns

### Pattern 1: Command + Subagent

**Command**: `.claude/commands/code-review.md`
**Subagent**: Defers to command

**Benefits:**
- Can run command directly
- Can trigger as subagent
- Reusable logic

### Pattern 2: Skill + Subagent

**Skill**: `fix-issue` workflow
**Subagent**: Code review during fix

**Benefits:**
- Complete workflow
- Quality checks
- Isolated review

### Pattern 3: Multiple Subagents

**Subagent 1**: Planning
**Subagent 2**: Research
**Subagent 3**: Architecture

**Benefits:**
- Parallel exploration
- Multiple perspectives
- Faster results

## Best Practices

### 1. Clear Descriptions
Include trigger keywords:
- "code review"
- "planning"
- "research"
- "refactoring"

### 2. Integrate Guidelines
- Keep guidelines updated
- Reference in agent prompts
- Ensure compliance

### 3. Use Commands When Possible
- Create reusable commands
- Have subagents defer to commands
- Get both benefits

### 4. Monitor Usage
- Be aware of token costs
- Use when benefits outweigh costs
- Consider limits

### 5. Test and Refine
- Test with various scenarios
- Refine based on results
- Update trigger keywords

## Quick Reference

**Create Agent**: Claude UI → Create Subagent

**Trigger**: "Use [agent name] to [task]"

**Command Integration**: Have agent defer to command

**Concurrent**: Run multiple agents for different perspectives

**Guidelines**: Ensure agents follow project guidelines
