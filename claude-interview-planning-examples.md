# Claude Interview Planning Examples

## Example Prompts

### Dashboard Planning

**Prompt:**
```
Explore the app/Http/Controllers directory, understand the existing admin structure, then interview me (using the Ask User Question tool) to create a plan for an admin dashboard.
```

**Expected Questions:**
- What metrics/data should be displayed?
- Overview or detailed views?
- Auto-refresh or manual?
- What actions available?
- Where should it live?

**Example Answers:**
- "Show user stats, post counts, and recent activity"
- "Overview with drill-down to details"
- "Manual refresh with 30-second auto-update option"
- "View details, export data"
- "/admin/dashboard"

### Feature Planning

**Prompt:**
```
Review the Post model and related controllers, understand the current implementation, then interview me (using the Ask User Question tool) to plan a bookmarking feature.
```

**Expected Questions:**
- Where should bookmarks be stored?
- What UI elements needed?
- What actions available?
- Where should it appear?
- Public or private bookmarks?

**Example Answers:**
- "New bookmarks table with user_id and post_id"
- "Bookmark button on posts, bookmarks page"
- "Add/remove bookmark, view bookmarks"
- "Button on post, /bookmarks page"
- "Private to each user"

### API Endpoint Planning

**Prompt:**
```
Review the existing API routes and controllers, understand the patterns, then interview me (using the Ask User Question tool) to plan a new API endpoint for user preferences.
```

**Expected Questions:**
- What data to return?
- Authentication needed?
- Rate limiting?
- Versioning?
- What operations (GET, POST, PUT, DELETE)?

**Example Answers:**
- "User preferences object with settings"
- "Yes, require authentication"
- "Standard rate limiting"
- "v1 API version"
- "GET and PUT for preferences"

### Refactoring Planning

**Prompt:**
```
Examine the Telegram bot implementation in app/Services/Telegram, understand how it works, then interview me (using the Ask User Question tool) to plan improvements.
```

**Expected Questions:**
- What improvements are priorities?
- Maintain backward compatibility?
- Performance or code quality focus?
- What patterns to follow?
- Breaking changes acceptable?

**Example Answers:**
- "Extract common logic, improve error handling"
- "Yes, maintain compatibility"
- "Both - improve quality without sacrificing performance"
- "Follow existing service patterns"
- "No breaking changes"

## Complete Interview Examples

### Example 1: Analytics Dashboard

**Request:**
```
Explore the app directory, understand the data models and relationships, then interview me to plan an analytics dashboard.
```

**Interview:**

**Q: What metrics should the dashboard display?**
A: User growth, post engagement, popular content, activity trends.

**Q: Should it be real-time or historical data?**
A: Historical with ability to select date ranges. Real-time would be nice but not required initially.

**Q: What level of detail - overview only or drill-down capabilities?**
A: Overview with ability to drill down into specific metrics.

**Q: Where should this dashboard live?**
A: `/admin/analytics`

**Q: Should users be able to export data?**
A: Yes, CSV export for all metrics.

**Q: What permissions are needed?**
A: Admin only.

**Result:** Detailed plan with overview dashboard, drill-down views, date range selector, export functionality, admin-only access.

### Example 2: Notification System

**Request:**
```
Review the User model and existing notification patterns, then interview me to plan a notification system.
```

**Interview:**

**Q: What types of notifications?**
A: Likes, follows, replies, mentions.

**Q: Real-time or batched?**
A: Real-time for important ones (mentions), batched for others (likes).

**Q: Where should notifications appear?**
A: Bell icon in navigation, dropdown menu, and dedicated page.

**Q: Should users be able to mark as read?**
A: Yes, mark individual or all as read.

**Q: Database storage or in-memory?**
A: Database for persistence.

**Result:** Plan with notification types, real-time/batched logic, UI components, read/unread tracking, database schema.

### Example 3: Search Feature

**Request:**
```
Explore the Post and Profile models, understand the current structure, then interview me to plan a search feature.
```

**Interview:**

**Q: What should be searchable?**
A: Posts (content), profiles (name, handle), both.

**Q: Full-text search or simple matching?**
A: Full-text search with relevance ranking.

**Q: Should results be paginated?**
A: Yes, 20 results per page.

**Q: Where should search appear?**
A: Header search bar, accessible from anywhere.

**Q: Should it search across all content or filter by type?**
A: Show all results but allow filtering by type (posts, profiles).

**Result:** Plan with search implementation, indexing strategy, UI components, pagination, filtering options.

## Answering Strategies

### Be Specific

**Good:**
```
Q: Where should the feature live?
A: /admin/pipeline
```

**Bad:**
```
Q: Where should the feature live?
A: Somewhere in admin
```

### Provide Context

**Good:**
```
Q: Auto-refresh or manual?
A: Hybrid - show cached data immediately, manual refresh button, auto-refresh every 30 seconds when page is active.
```

**Bad:**
```
Q: Auto-refresh or manual?
A: Yes
```

### Flag Undecided

**Good:**
```
Q: What color scheme?
A: I don't have a preference yet - use existing admin theme and flag this as undecided in the plan.
```

**Bad:**
```
Q: What color scheme?
A: (no answer, agent guesses)
```

### Think About Tradeoffs

**Good:**
```
Q: Real-time or batched?
A: Real-time for critical notifications (mentions, replies), batched daily digest for less critical ones (likes).
```

**Bad:**
```
Q: Real-time or batched?
A: Real-time (without considering implications)
```

## Plan Review Checklist

After the interview, review the plan:

- ✅ Matches your answers
- ✅ Includes all requirements
- ✅ Addresses tradeoffs mentioned
- ✅ Flags undecided areas
- ✅ Follows existing patterns
- ✅ Includes implementation details
- ✅ Considers edge cases
- ✅ Suggests testing approach

## Common Question Categories

### Scope & Structure
- What level of detail?
- Overview vs detail views?
- What sections/components?
- Single page or multiple?

### Behavior
- Auto-update vs manual?
- Real-time vs on-demand?
- Caching strategy?
- Performance requirements?

### Location & Routing
- Where should it live?
- What routes needed?
- Admin or public?
- Nested routes?

### UX & Interaction
- What to display?
- How users interact?
- What feedback needed?
- Mobile considerations?

### Actions & Functionality
- What actions available?
- Permissions needed?
- Confirmation dialogs?
- Bulk operations?

### Technical
- Data sources?
- Database changes?
- API endpoints?
- Performance considerations?

## Tips for Better Interviews

### 1. Give Context First

```
Explore [specific area], understand [how it works], then interview me...
```

### 2. Enable Plan Mode

Press **Shift+Tab** before or during interview to enable plan mode.

### 3. Answer Thoughtfully

- Consider tradeoffs
- Think about users
- Consider technical implications
- Be realistic

### 4. Don't Overthink

- Short answers are fine
- Be conversational
- Add detail when helpful
- It's okay to say "I don't know yet"

### 5. Review and Refine

- Check plan matches answers
- Request clarifications
- Iterate if needed
- Refine before implementing

## Integration Examples

### With Skills

1. Interview to create plan
2. Use `fix-issue` skill to implement
3. Follow detailed plan

### With Commands

After plan:
- Use `/format` for style
- Use `/test` to verify
- Use `/code-review` for review

### With Subagents

1. Interview to create plan
2. Use planning subagent to refine
3. Implement following plan

## Summary

Interview planning produces:
- ✅ More accurate plans
- ✅ Better understanding
- ✅ Fewer assumptions
- ✅ Less rework
- ✅ Thoughtful decisions

**Key:** Let Claude ask questions before planning, not after implementing.
