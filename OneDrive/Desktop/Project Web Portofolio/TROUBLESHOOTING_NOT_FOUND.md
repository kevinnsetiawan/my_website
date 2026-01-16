# Comprehensive NOT_FOUND Error Troubleshooting Guide

Based on Vercel's official troubleshooting steps and codebase analysis.

---

## 🔍 1. Check the Deployment URL

### What to Verify:
- **Correct URL format**: `https://project-web-portofolio.vercel.app` or your custom domain
- **No typos**: Check for spelling errors in the URL
- **Correct path**: Ensure you're accessing the root `/` not a non-existent path

### Common Mistakes:
```bash
# ❌ BAD - Typo in URL
https://project-web-portofolio.vercel.app/projecs  # Missing 't'

# ❌ BAD - Wrong domain
https://project-web-portfolio.vercel.app  # Different spelling

# ✅ GOOD - Correct URL
https://project-web-portofolio.vercel.app
https://project-web-portofolio.vercel.app/
https://project-web-portofolio.vercel.app/projects
```

### How to Fix:
1. Go to Vercel Dashboard → Your Project → Settings → Domains
2. Verify the production domain
3. Test with the exact URL shown in dashboard
4. Check if custom domain is properly configured (if using one)

---

## 🔍 2. Check Deployment Existence

### What to Verify:
- **Deployment exists**: Check Vercel Dashboard → Deployments tab
- **Not deleted**: Ensure deployment wasn't accidentally deleted
- **Status**: Deployment should be "Ready" (green), not "Error" or "Building"

### How to Check:
1. **Vercel Dashboard**:
   - Go to: https://vercel.com/dashboard
   - Select your project
   - Click "Deployments" tab
   - Verify latest deployment exists and is "Ready"

2. **Deployment Status Indicators**:
   - ✅ **Ready** (green) - Deployment successful, should be accessible
   - ⏳ **Building** (yellow) - Still in progress, wait for completion
   - ❌ **Error** (red) - Build failed, check logs
   - ⚠️ **Cancelled** - Deployment was cancelled

3. **Check Deployment History**:
   - Look for recent deployments
   - Check if any were deleted
   - Verify the deployment you're accessing is the latest

### Common Issues:
- **Deployment deleted**: Someone deleted it, redeploy needed
- **Old deployment**: Accessing URL from deleted/old deployment
- **Build failed**: Deployment exists but failed to build

### How to Fix:
```bash
# If deployment was deleted or doesn't exist:
# Option 1: Trigger new deployment via GitHub push
git commit --allow-empty -m "Trigger redeploy"
git push origin main

# Option 2: Redeploy from Vercel Dashboard
# Dashboard → Deployments → Click "Redeploy" on latest deployment
```

---

## 🔍 3. Review Deployment Logs

### Critical: This is where you'll find the real issue!

### How to Access Logs:
1. **Vercel Dashboard** → Your Project → **Deployments**
2. Click on the deployment (latest or problematic one)
3. Click **"View Build Logs"** or **"View Function Logs"**

### What to Look For:

#### A. Build Logs (During Deployment)
```bash
# ✅ GOOD - Successful build
✓ Build completed
✓ Installing dependencies...
✓ Running build command...
✓ Build output generated

# ❌ BAD - Build failures
✗ Error: Command failed
✗ Module not found
✗ Build command failed
```

**Common Build Errors:**
- **Missing dependencies**: `composer install` or `npm install` failed
- **Build command error**: `npm run build` failed
- **Path issues**: Files not found during build
- **Memory/timeout**: Build exceeded limits

#### B. Function Logs (Runtime Errors)
```bash
# ✅ GOOD - Function executing
Function invoked
Laravel bootstrapped successfully

# ❌ BAD - Runtime errors
Fatal error: Uncaught Error
File not found: vendor/autoload.php
Class not found
```

**Common Runtime Errors:**
- **Missing files**: `vendor/autoload.php` not found
- **Path resolution**: `__DIR__` paths incorrect
- **Environment variables**: Missing `APP_KEY` or other vars
- **Database errors**: SQLite file not accessible

### How to Interpret Logs:

1. **Build Phase Errors**:
   ```
   Error: ENOENT: no such file or directory
   → Check: Root Directory configuration
   → Check: File paths in vercel.json
   ```

2. **Function Invocation Errors**:
   ```
   Function not found: api/index.php
   → Check: Root Directory matches function path
   → Check: api/index.php exists in correct location
   ```

3. **Laravel Bootstrap Errors**:
   ```
   Fatal error: require(): Failed opening required 'vendor/autoload.php'
   → Check: Composer dependencies installed
   → Check: Path resolution in api/index.php
   ```

### Debugging Steps:
1. **Check Build Logs First**: Most issues appear here
2. **Check Function Logs**: Runtime errors appear here
3. **Look for specific error messages**: They point to exact issues
4. **Check timestamps**: When did error occur?

---

## 🔍 4. Verify Permissions

### What to Verify:
- **Project access**: You have permission to view/deploy the project
- **GitHub integration**: Repository is connected and accessible
- **Team permissions**: If team project, you have correct role

### How to Check:
1. **Vercel Dashboard**:
   - Can you see the project?
   - Can you access Settings?
   - Can you view Deployments?

2. **GitHub Integration**:
   - Settings → Git → Verify repository connection
   - Check if you have push access to the repo
   - Verify branch permissions

3. **Team Settings** (if applicable):
   - Check your role: Owner, Admin, Developer, Viewer
   - Verify deployment permissions

### Common Permission Issues:
- **Viewer role**: Can't trigger deployments
- **Repository access**: Lost GitHub access
- **Team changes**: Removed from team

### How to Fix:
- **Request access**: Contact project owner/admin
- **Check GitHub**: Verify repository permissions
- **Reconnect**: Settings → Git → Disconnect and reconnect

---

## 🔍 5. Contact Support (Last Resort)

### When to Contact Support:
- ✅ Checked all above steps
- ✅ Logs show unclear errors
- ✅ Configuration seems correct but still failing
- ✅ Suspected Vercel platform issue

### What to Provide Support:
1. **Project URL**: Your Vercel project URL
2. **Deployment URL**: The specific deployment failing
3. **Error messages**: Copy from logs
4. **Configuration**: Share relevant parts of `vercel.json`
5. **Steps to reproduce**: What you did that caused error

---

## 🎯 Root Cause Analysis: Your Specific Case

Based on your codebase, here are the **most likely causes**:

### Priority 1: Root Directory Not Set ⚠️ CRITICAL
**Symptom**: Build succeeds, but all routes return NOT_FOUND

**Why**: Your repo structure is nested (`OneDrive/Desktop/Project Web Portofolio/`), but Vercel looks at repo root by default.

**Fix**: 
1. Vercel Dashboard → Settings → General
2. Set **Root Directory**: `OneDrive/Desktop/Project Web Portofolio`
3. Save and redeploy

**How to Verify**:
- Check deployment logs for "vercel.json not found" or "api/index.php not found"
- If you see these, Root Directory is definitely the issue

---

### Priority 2: Missing Rewrites Section ✅ FIXED
**Status**: Already fixed in your `vercel.json`

**What was wrong**: Without `rewrites`, Vercel couldn't route requests to Laravel function.

**Current status**: Your `vercel.json` now has:
```json
"rewrites": [
    {
        "source": "/(.*)",
        "destination": "/api/index.php"
    }
]
```

---

### Priority 3: Environment Variables ⚠️ NEEDS ATTENTION
**Issue**: `APP_KEY` is still placeholder: `base64:YOUR_APP_KEY_HERE`

**Impact**: Won't cause NOT_FOUND, but will cause other errors (500, encryption errors)

**Fix**:
1. Generate real key: `php artisan key:generate --show`
2. Vercel Dashboard → Settings → Environment Variables
3. Add `APP_KEY` with generated value
4. Redeploy

---

### Priority 4: Function Path Resolution ✅ CORRECT
**Status**: Your `api/index.php` correctly uses `__DIR__` for paths

**Why this matters**: Serverless functions need relative paths, not absolute.

**Your code** (correct):
```php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
```

---

## 📋 Complete Diagnostic Checklist

Run through this checklist systematically:

### Configuration Checks:
- [ ] `vercel.json` exists at project root (relative to Root Directory)
- [ ] `api/index.php` exists and bootstraps Laravel correctly
- [ ] `rewrites` section exists in `vercel.json`
- [ ] `functions` section points to correct path
- [ ] `outputDirectory` matches your build output (`public`)

### Vercel Dashboard Checks:
- [ ] Root Directory is set correctly
- [ ] Environment Variables are set (especially `APP_KEY`)
- [ ] GitHub integration is connected
- [ ] Auto-deploy is enabled
- [ ] Production branch is `main`

### Deployment Checks:
- [ ] Latest deployment exists and is "Ready"
- [ ] Build logs show no errors
- [ ] Function logs show no runtime errors
- [ ] Deployment URL is correct
- [ ] You have proper permissions

### Code Checks:
- [ ] `api/index.php` uses `__DIR__` not absolute paths
- [ ] Laravel routes are defined in `routes/web.php`
- [ ] Static assets are in `public/` directory
- [ ] Build command produces output in `public/build/`

---

## 🚀 Quick Fix Workflow

If you're still getting NOT_FOUND, follow this exact sequence:

### Step 1: Verify Root Directory (Most Common Fix)
```
1. Open Vercel Dashboard
2. Select your project
3. Settings → General
4. Find "Root Directory"
5. Set to: OneDrive/Desktop/Project Web Portofolio
6. Save
7. Wait for auto-redeploy (or trigger manually)
```

### Step 2: Check Deployment Logs
```
1. Dashboard → Deployments
2. Click latest deployment
3. Click "View Build Logs"
4. Look for errors about missing files
5. If errors found, they'll tell you what's wrong
```

### Step 3: Test Function Directly
```
1. Dashboard → Functions
2. Find api/index.php
3. Check "Invocations" and "Errors"
4. If errors, click to see details
```

### Step 4: Verify URL Access
```
1. Try root URL: https://project-web-portofolio.vercel.app/
2. Try route: https://project-web-portofolio.vercel.app/projects
3. Check browser console for 404 errors
4. Check Network tab for failed requests
```

---

## 💡 Understanding NOT_FOUND vs Other Errors

### NOT_FOUND (404):
- **Meaning**: Vercel can't find a handler for the request
- **Causes**: Missing rewrites, wrong Root Directory, deleted deployment
- **Fix**: Routing configuration

### Function Error (500):
- **Meaning**: Function exists but fails to execute
- **Causes**: PHP errors, missing dependencies, Laravel bootstrap issues
- **Fix**: Check function logs, fix code

### Build Error:
- **Meaning**: Deployment failed during build
- **Causes**: Build command fails, dependencies missing
- **Fix**: Check build logs, fix build command

---

## 🎓 Key Learnings

1. **Root Directory is Critical**: For nested repos, this MUST be set in Dashboard
2. **Rewrites are Required**: Without them, dynamic routes won't work
3. **Logs Tell the Truth**: Always check logs first, they show exact issues
4. **Order Matters**: Routes before rewrites, specific before catch-all
5. **Paths Must be Relative**: Use `__DIR__` in serverless, not absolute paths

---

## 📞 Next Steps

If you've checked everything above and still have issues:

1. **Share Build Logs**: Copy error messages from build logs
2. **Share Function Logs**: Copy error messages from function logs  
3. **Verify Root Directory**: Confirm it's set correctly
4. **Test Locally**: Run `vercel dev` to test configuration locally
5. **Contact Support**: If all else fails, contact Vercel with logs

---

## ✅ Success Indicators

You'll know it's working when:
- ✅ Homepage loads: `https://your-url.vercel.app/`
- ✅ Routes work: `https://your-url.vercel.app/projects`
- ✅ Static assets load: CSS, JS files load correctly
- ✅ No 404 errors in browser console
- ✅ Build logs show "Build completed"
- ✅ Function logs show successful invocations
