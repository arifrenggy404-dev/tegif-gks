# Design Spec: Enable Trust Proxy and Sync to GitHub

**Date:** 2026-06-15
**Status:** Approved

## Goal
Enable the Laravel application to trust all proxies (trust all) to correctly handle client IPs and HTTPS when behind reverse proxies or load balancers. After the change, sync the updates to the remote GitHub repository.

## Current State
- Laravel version: 12.61.0
- Environment: Branch `main` is clean.
- `bootstrap/app.php` has middleware configuration but `trustProxies` is not yet called.

## Proposed Changes
Modify `bootstrap/app.php` to include `$middleware->trustProxies(at: '*');` in the middleware configuration closure.

### Code Change: `bootstrap/app.php`
```php
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*'); // Added
        // ... existing config
    })
```

## Git Workflow
1. Stage the changes: `git add bootstrap/app.php`
2. Commit with message: `feat: enable trust all proxies`
3. Push to remote: `git push origin main`

## Verification
- Run `php artisan about` to check if proxies are trusted (though Laravel might not show it explicitly there in all versions, the presence of the code is the primary verification).
- Check `git status` to ensure clean state after push.
