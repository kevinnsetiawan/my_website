# Vercel Deployment Guide - Fixing NOT_FOUND Error

## 🔍 Root Cause Analysis

### Problem 1: Nested Repository Structure
Your GitHub repository has a nested structure: `OneDrive/Desktop/Project Web Portofolio/`
- **What Vercel expects**: Project files at repository root
- **What you have**: Project files in a subdirectory
- **Impact**: Vercel can't find your `vercel.json` and project files, causing NOT_FOUND

### Problem 2: Root Directory Configuration Missing
Vercel needs to know where your project root is located within the repository.

---

## ✅ Solution: Complete Fix

### Step 1: Configure Root Directory in Vercel Dashboard

1. Go to [Vercel Dashboard](https://vercel.com/dashboard)
2. Select your project: `my_website` or `project-web-portofolio`
3. Navigate to **Settings** → **General**
4. Scroll to **Root Directory** section
5. Set Root Directory to: `OneDrive/Desktop/Project Web Portofolio`
6. Click **Save**

**Why this is critical**: Without this, Vercel looks for files at the repository root, but your project is nested. This is the #1 cause of NOT_FOUND errors with nested repos.

### Step 2: Verify vercel.json Configuration

Your `vercel.json` should be at: `OneDrive/Desktop/Project Web Portofolio/vercel.json`

Current configuration is correct:
- ✅ `outputDirectory: "public"` - Laravel's public folder
- ✅ `functions` pointing to `api/index.php` with PHP runtime
- ✅ `routes` for static assets (build, css, js, images)
- ✅ `rewrites` catch-all to `/api/index.php` for Laravel routing

### Step 3: Verify api/index.php

The `api/index.php` file correctly bootstraps Laravel directly:
- ✅ Uses `__DIR__` for relative paths (works in serverless)
- ✅ Loads Composer autoloader
- ✅ Bootstraps Laravel application
- ✅ Handles requests via `handleRequest()`

### Step 4: Set Environment Variables

In Vercel Dashboard → Settings → Environment Variables:

**Critical Variables:**
- `APP_KEY`: Generate with `php artisan key:generate --show` (don't use placeholder!)
- `APP_ENV`: `production`
- `APP_DEBUG`: `false`
- `APP_URL`: Your Vercel URL (e.g., `https://project-web-portofolio.vercel.app`)

**Database (SQLite):**
- `DB_CONNECTION`: `sqlite`
- `DB_DATABASE`: `database/database.sqlite`

**Note**: SQLite files are ephemeral in serverless. Consider using a persistent database for production.

---

## 📚 Understanding the Concepts

### Why NOT_FOUND Error Exists

Vercel's NOT_FOUND error protects you from:
1. **Misconfigured deployments**: Prevents serving broken/incomplete apps
2. **Security**: Doesn't expose internal file structure
3. **Resource efficiency**: Fails fast instead of hanging

### Mental Model: Serverless vs Traditional Hosting

**Traditional Hosting (Apache/Nginx):**
```
Request → Web Server → public/index.php → Laravel → Response
```
- Persistent process
- File system always accessible
- `.htaccess` handles routing

**Vercel Serverless:**
```
Request → Vercel Router → api/index.php (function) → Laravel → Response
```
- Stateless functions (cold starts)
- Isolated execution environment
- `vercel.json` handles routing
- Each request = new function invocation

### How This Fits Into Framework Design

Laravel was designed for traditional hosting but works on serverless with:
- **Entry point adaptation**: `api/index.php` instead of `public/index.php`
- **Path resolution**: Using `__DIR__` instead of `$_SERVER['DOCUMENT_ROOT']`
- **Stateless design**: Laravel's stateless nature fits serverless perfectly
- **Configuration**: Environment variables instead of `.env` files

---

## 🚨 Warning Signs & Prevention

### Red Flags That Cause NOT_FOUND

1. **Missing Root Directory Configuration**
   - ✅ Check: Vercel Dashboard → Settings → Root Directory
   - ❌ Symptom: Build succeeds but all routes return 404

2. **Incorrect Function Path**
   - ✅ Check: `functions` in `vercel.json` matches actual file location
   - ❌ Symptom: Function not found errors in logs

3. **Wrong Output Directory**
   - ✅ Check: `outputDirectory` matches your build output
   - ❌ Symptom: Static assets return 404

4. **Missing Rewrites**
   - ✅ Check: Catch-all rewrite exists: `"source": "/(.*)", "destination": "/api/index.php"`
   - ❌ Symptom: Only `/` works, other routes return 404

5. **Path Resolution Issues**
   - ✅ Check: Using `__DIR__` not `$_SERVER['DOCUMENT_ROOT']`
   - ❌ Symptom: "File not found" errors in function logs

### Code Smells

```php
// ❌ BAD - Assumes traditional hosting
require $_SERVER['DOCUMENT_ROOT'] . '/public/index.php';

// ❌ BAD - Hardcoded paths
require '/var/www/html/vendor/autoload.php';

// ❌ BAD - Relative paths from wrong context
require '../public/index.php'; // From api/ directory

// ✅ GOOD - Serverless-friendly
require __DIR__ . '/../vendor/autoload.php';
```

### Similar Mistakes to Avoid

1. **Assuming file structure matches local**
   - Serverless has different directory structure
   - Always use `__DIR__` for relative paths

2. **Forgetting Root Directory in nested repos**
   - Always set Root Directory in Vercel Dashboard
   - Can't be set in `vercel.json` (must be in Dashboard)

3. **Mixing routes and rewrites incorrectly**
   - Routes: For redirects and static file serving
   - Rewrites: For internal routing (Laravel routes)
   - Order matters: Specific routes before catch-all

4. **Environment variables in vercel.json**
   - Sensitive data should be in Dashboard, not committed
   - `vercel.json` env is for non-sensitive defaults

---

## 🔄 Alternative Approaches & Trade-offs

### Option 1: Current Setup (Recommended)
**Structure**: Nested repo with Root Directory configuration
- ✅ Works with existing repo structure
- ✅ No need to restructure repository
- ⚠️ Requires Dashboard configuration
- ⚠️ Slightly more complex setup

### Option 2: Flatten Repository Structure
**Move project files to repo root**
- ✅ Simpler Vercel configuration
- ✅ No Root Directory needed
- ❌ Requires restructuring repository
- ❌ Loses folder organization

### Option 3: Monorepo with Multiple Projects
**Use Vercel's monorepo support**
- ✅ Multiple projects in one repo
- ✅ Better for large organizations
- ❌ More complex setup
- ❌ Overkill for single project

### Option 4: Use Laravel Vercel Package
**Package**: `laravel/vercel` or similar
- ✅ Handles configuration automatically
- ✅ Community-maintained
- ❌ Additional dependency
- ❌ Less control over configuration

**Recommendation**: Stick with Option 1 (current setup) - it's the most flexible and doesn't require restructuring.

---

## ✅ Verification Checklist

After configuration, verify:

- [ ] Root Directory set in Vercel Dashboard
- [ ] `vercel.json` exists at project root (relative to Root Directory)
- [ ] `api/index.php` bootstraps Laravel correctly
- [ ] Environment variables set in Dashboard (especially `APP_KEY`)
- [ ] Build command runs successfully
- [ ] Static assets load (CSS, JS, images)
- [ ] Laravel routes work (`/`, `/projects`)
- [ ] No 404 errors in browser console
- [ ] Function logs show no errors

---

## 🚀 Auto-Deployment Setup

Once Root Directory is configured:

1. **GitHub Integration**: Already connected ✅
2. **Auto-Deploy**: Enabled by default ✅
3. **Production Branch**: Set to `main` ✅

**Workflow:**
```
Local Changes → git commit → git push → GitHub → Vercel Auto-Deploy → Live Site
```

**Deployment Time**: Usually 1-3 minutes after push

---

## 📞 Troubleshooting

### Still Getting NOT_FOUND?

1. **Check Root Directory**: Must match exact folder path
2. **Check Build Logs**: Vercel Dashboard → Deployments → View Logs
3. **Check Function Logs**: Vercel Dashboard → Functions → View Logs
4. **Verify File Paths**: Ensure `api/index.php` exists relative to Root Directory
5. **Test Locally**: Run `vercel dev` to test configuration

### Common Error Messages

- **"Function not found"**: Check `functions` path in `vercel.json`
- **"File not found"**: Check Root Directory and file paths
- **"Route not found"**: Check `rewrites` configuration
- **"Build failed"**: Check `buildCommand` and dependencies

---

## 📝 Summary

The NOT_FOUND error was caused by:
1. **Missing Root Directory configuration** in Vercel Dashboard (primary cause)
2. Nested repository structure requiring explicit path configuration
3. Vercel looking for files at repo root instead of project subdirectory

**Fix**: Set Root Directory to `OneDrive/Desktop/Project Web Portofolio` in Vercel Dashboard.

Your `vercel.json` and `api/index.php` are already correctly configured! 🎉
