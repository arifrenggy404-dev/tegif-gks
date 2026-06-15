# Enable Trust Proxy Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Enable the Laravel application to trust all proxies and push changes to GitHub.

**Architecture:** Use Laravel 11/12's middleware configuration in `bootstrap/app.php` to trust all proxies.

**Tech Stack:** Laravel 12.x, PHP, Git.

---

### Task 1: Enable Trust Proxy

**Files:**
- Modify: `bootstrap/app.php`

- [ ] **Step 1: Update bootstrap/app.php to trust all proxies**

```php
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');

        // ... existing config
        $middleware->redirectGuestsTo('/login');
        // ...
    })
```

- [ ] **Step 2: Run verification**

Run: `php artisan about`
Expected: Check for any errors (this command verifies the app boots correctly with the new config).

- [ ] **Step 3: Commit the change**

```bash
git add bootstrap/app.php
git commit -m "feat: enable trust all proxies"
```

### Task 2: Push to GitHub

**Files:**
- None (Git operations)

- [ ] **Step 1: Push changes to remote**

Run: `git push origin main`
Expected: Success message from git.

- [ ] **Step 2: Verify git status**

Run: `git status`
Expected: "Your branch is up to date with 'origin/main'."
