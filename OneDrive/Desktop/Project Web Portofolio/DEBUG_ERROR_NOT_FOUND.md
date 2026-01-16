# 🔍 Debug Error NOT_FOUND - Langkah Demi Langkah

Panduan sistematis untuk menemukan dan memperbaiki error NOT_FOUND yang masih terjadi.

---

## ✅ Checklist: Apa yang Sudah Dilakukan?

Cek apakah semua ini sudah dilakukan:

- [ ] Root Directory sudah di-set di Dashboard: `OneDrive/Desktop/Project Web Portofolio`
- [ ] Root Directory sudah di-Save (tombol Save sudah diklik)
- [ ] Deployment baru sudah trigger setelah set Root Directory
- [ ] Build Logs sudah dicek untuk error
- [ ] Function Logs sudah dicek untuk error
- [ ] Environment Variables sudah di-set (APP_KEY, dll)

---

## 🎯 Step 1: Verifikasi Root Directory

### Cara Cek Apakah Root Directory Sudah Benar:

1. **Buka Vercel Dashboard** → Project → Settings → General
2. **Lihat field "Root Directory"**
3. **Pastikan isinya**: `OneDrive/Desktop/Project Web Portofolio`
   - ❌ **SALAH**: `Project Web Portofolio` (kurang lengkap)
   - ✅ **BENAR**: `OneDrive/Desktop/Project Web Portofolio` (lengkap)

### Jika Masih Salah:

1. Klik field Root Directory
2. Hapus text yang ada
3. Masukkan: `OneDrive/Desktop/Project Web Portofolio`
4. **Klik Save** (penting!)
5. Tunggu deployment baru

---

## 🎯 Step 2: Cek Build Logs

### Cara Mengakses Build Logs:

1. Vercel Dashboard → Project → **Deployments**
2. Klik pada **deployment terbaru** (yang paling atas)
3. Klik **"View Build Logs"** atau **"Build Logs"**

### Yang Harus Dicari di Build Logs:

#### ✅ GOOD - Tidak Ada Error:
```
✓ Installing dependencies...
✓ Running build command...
✓ Build completed
✓ Found vercel.json
```

#### ❌ BAD - Ada Error:
```
✗ Error: vercel.json not found
✗ Error: api/index.php not found
✗ Error: Command failed
✗ Error: ENOENT: no such file or directory
```

### Jika Ada Error "vercel.json not found":

**Penyebab**: Root Directory masih salah atau belum di-save

**Solusi**:
1. Kembali ke Settings → General → Root Directory
2. Pastikan path lengkap: `OneDrive/Desktop/Project Web Portofolio`
3. Klik Save lagi
4. Tunggu deployment baru

### Jika Ada Error "Command failed":

**Penyebab**: Build command error (composer/npm install gagal)

**Solusi**:
1. Copy error message dari logs
2. Cek apakah dependencies ada di repo
3. Pastikan `composer.json` dan `package.json` ada
4. Cek apakah ada file yang di-ignore oleh `.gitignore`

---

## 🎯 Step 3: Cek Function Logs

### Cara Mengakses Function Logs:

1. Vercel Dashboard → Project → **Deployments**
2. Klik pada deployment terbaru
3. Klik **"View Function Logs"** atau **"Function Logs"**
4. Atau: Dashboard → **Functions** → `api/index.php` → **Logs**

### Yang Harus Dicari di Function Logs:

#### ✅ GOOD - Function Berjalan:
```
Function invoked
Laravel bootstrapped successfully
Request handled
```

#### ❌ BAD - Function Error:
```
Fatal error: require(): Failed opening required 'vendor/autoload.php'
Fatal error: Class not found
Error: File not found
```

### Jika Ada Error "vendor/autoload.php not found":

**Penyebab**: Dependencies tidak terinstall atau path salah

**Solusi**:
1. Cek apakah `composer install` berhasil di Build Logs
2. Cek apakah `vendor/` folder ada di repo (tidak di-ignore)
3. Pastikan `api/index.php` menggunakan path yang benar:
   ```php
   require __DIR__ . '/../vendor/autoload.php';
   ```

### Jika Ada Error "Class not found":

**Penyebab**: Laravel bootstrap error atau APP_KEY tidak di-set

**Solusi**:
1. Set Environment Variables di Dashboard:
   - `APP_KEY`: Generate dengan `php artisan key:generate --show`
   - `APP_ENV`: `production`
   - `APP_DEBUG`: `false`
2. Redeploy setelah set env vars

---

## 🎯 Step 4: Test Website Langsung

### Cara Test:

1. Buka URL deployment: `https://project-web-portofolio.vercel.app`
2. Atau URL yang ditampilkan di Dashboard → Deployments

### Test Cases:

#### Test 1: Homepage
- URL: `https://project-web-portofolio.vercel.app/`
- Expected: Homepage Laravel muncul
- Jika NOT_FOUND: Root Directory atau rewrites salah

#### Test 2: Route Projects
- URL: `https://project-web-portofolio.vercel.app/projects`
- Expected: Halaman projects muncul
- Jika NOT_FOUND: Rewrites tidak bekerja atau Laravel route tidak ditemukan

#### Test 3: Static Files
- URL: `https://project-web-portofolio.vercel.app/build/assets/app-xxx.css`
- Expected: File CSS ter-load
- Jika NOT_FOUND: Routes untuk static files salah

### Browser Console:

1. Buka browser Developer Tools (F12)
2. Tab **Console**
3. Tab **Network**
4. Cek apakah ada request yang return 404

---

## 🎯 Step 5: Verifikasi File di GitHub

### Pastikan File Ada di Lokasi yang Benar:

1. Buka: https://github.com/kevinnsetiawan/my_website
2. Navigate ke: `OneDrive/Desktop/Project Web Portofolio/`
3. Pastikan file berikut ada:
   - ✅ `vercel.json`
   - ✅ `api/index.php`
   - ✅ `composer.json`
   - ✅ `package.json`
   - ✅ `routes/web.php`

### Jika File Tidak Ada:

1. Commit dan push file yang hilang
2. Tunggu Vercel auto-deploy
3. Cek lagi

---

## 🎯 Step 6: Verifikasi Konfigurasi vercel.json

### Pastikan vercel.json Benar:

File `vercel.json` harus memiliki:

```json
{
  "version": 2,
  "framework": null,
  "buildCommand": "composer install --no-dev --optimize-autoloader && npm install && npm run build",
  "outputDirectory": "public",
  "functions": {
    "api/index.php": {
      "runtime": "vercel-php@0.6.0"
    }
  },
  "routes": [
    {
      "src": "/build/(.*)",
      "dest": "/build/$1"
    },
    {
      "src": "/(favicon\\.ico|robots\\.txt)",
      "dest": "/$1"
    },
    {
      "src": "/(css|js|images)/(.*)",
      "dest": "/$1/$2"
    }
  ],
  "rewrites": [
    {
      "source": "/(.*)",
      "destination": "/api/index.php"
    }
  ]
}
```

**PENTING**: Pastikan ada bagian `rewrites`!

---

## 🎯 Step 7: Verifikasi api/index.php

### Pastikan api/index.php Benar:

File harus bootstrap Laravel langsung:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$maintenancePath = __DIR__ . '/../storage/framework/maintenance.php';
if (file_exists($maintenancePath)) {
    require $maintenancePath;
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Request::capture());
```

**PENTING**: Menggunakan `__DIR__` bukan absolute path!

---

## 🔧 Solusi Berdasarkan Error Spesifik

### Error: "vercel.json not found"

**Penyebab**: Root Directory salah atau belum di-save

**Solusi**:
1. Settings → General → Root Directory
2. Set: `OneDrive/Desktop/Project Web Portofolio`
3. **Klik Save**
4. Tunggu deployment baru

---

### Error: "api/index.php not found"

**Penyebab**: Root Directory salah atau file tidak ada

**Solusi**:
1. Cek apakah `api/index.php` ada di GitHub
2. Jika tidak ada, commit dan push
3. Pastikan Root Directory benar
4. Redeploy

---

### Error: "Function not found"

**Penyebab**: Path function di vercel.json salah

**Solusi**:
1. Pastikan `vercel.json` memiliki:
   ```json
   "functions": {
     "api/index.php": {
       "runtime": "vercel-php@0.6.0"
     }
   }
   ```
2. Path harus relatif dari Root Directory
3. Jika Root Directory = `OneDrive/Desktop/Project Web Portofolio`
4. Maka function path = `api/index.php` (benar)

---

### Error: "Route not found" atau semua route 404

**Penyebab**: Rewrites tidak ada atau salah

**Solusi**:
1. Pastikan `vercel.json` memiliki bagian `rewrites`:
   ```json
   "rewrites": [
     {
       "source": "/(.*)",
       "destination": "/api/index.php"
     }
   ]
   ```
2. Commit dan push jika belum ada
3. Redeploy

---

### Error: "vendor/autoload.php not found"

**Penyebab**: Dependencies tidak terinstall

**Solusi**:
1. Cek Build Logs - apakah `composer install` berhasil?
2. Pastikan `composer.json` ada di repo
3. Pastikan `vendor/` tidak di-ignore (atau install di build time)
4. Cek apakah build command benar:
   ```json
   "buildCommand": "composer install --no-dev --optimize-autoloader && npm install && npm run build"
   ```

---

### Error: Laravel bootstrap error

**Penyebab**: APP_KEY tidak di-set atau env vars salah

**Solusi**:
1. Generate APP_KEY:
   ```bash
   php artisan key:generate --show
   ```
2. Dashboard → Settings → Environment Variables
3. Tambahkan:
   - `APP_KEY`: (hasil dari command di atas)
   - `APP_ENV`: `production`
   - `APP_DEBUG`: `false`
   - `APP_URL`: `https://project-web-portofolio.vercel.app`
4. Redeploy

---

## 📋 Checklist Final

Setelah semua langkah di atas:

- [ ] Root Directory: `OneDrive/Desktop/Project Web Portofolio` ✅
- [ ] Root Directory sudah di-Save ✅
- [ ] Build Logs tidak ada error ✅
- [ ] Function Logs tidak ada error ✅
- [ ] `vercel.json` ada dan benar ✅
- [ ] `api/index.php` ada dan benar ✅
- [ ] `rewrites` section ada di vercel.json ✅
- [ ] Environment Variables sudah di-set ✅
- [ ] File ada di GitHub ✅
- [ ] Website bisa diakses ✅

---

## 🚨 Jika Masih Error Setelah Semua Langkah

### Langkah Terakhir:

1. **Copy error message** dari Build Logs atau Function Logs
2. **Screenshot** halaman error di browser
3. **Cek** apakah semua file sudah di-commit dan push ke GitHub
4. **Coba** trigger deployment manual:
   - Dashboard → Deployments → "Redeploy"
5. **Tunggu** deployment selesai
6. **Test** lagi

### Jika Masih Tidak Bekerja:

Kemungkinan masalah:
- Vercel cache (coba clear cache)
- GitHub sync issue (coba disconnect dan reconnect)
- Platform issue (contact Vercel support)

---

## 💡 Tips

1. **Selalu cek logs dulu** sebelum mengubah konfigurasi
2. **Satu perubahan per deployment** untuk mudah debug
3. **Test setelah setiap perubahan**
4. **Simpan error messages** untuk referensi
5. **Screenshot** konfigurasi yang sudah di-set

---

**Ingat**: 90% masalah NOT_FOUND disebabkan oleh Root Directory yang salah atau belum di-save. Pastikan itu dulu! 🎯
