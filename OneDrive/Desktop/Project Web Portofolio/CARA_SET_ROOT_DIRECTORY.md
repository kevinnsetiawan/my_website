# Cara Set Root Directory di Vercel Dashboard

Panduan langkah demi langkah untuk mengatur Root Directory agar website bisa berjalan.

---

## 🎯 Langkah-Langkah Set Root Directory

### Step 1: Buka Vercel Dashboard

1. Buka browser dan kunjungi: **https://vercel.com/dashboard**
2. Login dengan akun GitHub Anda (jika belum login)
3. Pastikan Anda sudah masuk ke dashboard Vercel

---

### Step 2: Pilih Project Anda

1. Di dashboard, cari project Anda:
   - Nama project: `my_website` atau `project-web-portofolio`
   - Atau project yang terhubung dengan repo `kevinnsetiawan/my_website`
2. **Klik** pada project tersebut untuk membuka detail project

---

### Step 3: Buka Settings

1. Di halaman project, lihat menu di bagian atas
2. Klik tab **"Settings"** (ikon gear ⚙️ atau teks "Settings")
3. Pastikan Anda berada di halaman Settings

---

### Step 4: Buka General Settings

1. Di sidebar kiri Settings, cari bagian **"General"**
2. **Klik** pada **"General"**
3. Scroll ke bawah untuk menemukan bagian **"Root Directory"**

---

### Step 5: Set Root Directory

1. Cari field **"Root Directory"** di halaman General
2. Klik pada field tersebut (atau tombol "Edit" jika ada)
3. Masukkan path berikut:
   ```
   OneDrive/Desktop/Project Web Portofolio
   ```
   **PENTING**: 
   - Gunakan **spasi** di antara kata-kata (bukan underscore)
   - Huruf besar/kecil harus sesuai: `Project Web Portofolio` (bukan `project web portofolio`)
   - Tidak perlu slash di awal atau akhir

4. Setelah memasukkan path, klik **"Save"** atau **"Update"**

---

### Step 6: Tunggu Redeploy Otomatis

1. Setelah menyimpan, Vercel akan **otomatis trigger deployment baru**
2. Anda akan melihat notifikasi atau redirect ke halaman Deployments
3. Tunggu deployment selesai (biasanya 1-3 menit)
4. Status akan berubah dari "Building" → "Ready" (hijau)

---

### Step 7: Verifikasi

1. Setelah deployment selesai, klik tab **"Deployments"**
2. Klik pada deployment terbaru
3. Klik **"View Build Logs"**
4. Cek apakah ada error tentang "file not found"
   - ✅ **Jika tidak ada error**: Root Directory sudah benar!
   - ❌ **Jika masih ada error**: Periksa path yang dimasukkan

5. Test website:
   - Buka URL deployment: `https://project-web-portofolio.vercel.app`
   - Atau URL yang ditampilkan di dashboard
   - Coba akses homepage (`/`) dan route `/projects`
   - Jika berhasil → **Website sudah berjalan!** ✅

---

## 📸 Visual Guide (Teks)

```
Vercel Dashboard
│
├── [Pilih Project: my_website]
│   │
│   ├── Tab: Overview
│   ├── Tab: Deployments  
│   ├── Tab: Settings ⬅️ KLIK DI SINI
│   │   │
│   │   ├── General ⬅️ KLIK DI SINI
│   │   │   │
│   │   │   ├── Project Name
│   │   │   ├── Framework Preset
│   │   │   ├── Build Command
│   │   │   ├── Output Directory
│   │   │   └── Root Directory ⬅️ SET DI SINI
│   │   │       └── [Input Field]
│   │   │           └── Masukkan: OneDrive/Desktop/Project Web Portofolio
│   │   │
│   │   ├── Environment Variables
│   │   ├── Git
│   │   └── ...
│   │
│   └── ...
```

---

## ⚠️ Troubleshooting

### Problem 1: Tidak Ada Field "Root Directory"

**Kemungkinan Penyebab**:
- Project menggunakan Framework Preset yang auto-detect
- Atau project belum pernah di-deploy

**Solusi**:
1. Set **Framework Preset** ke **"Other"** atau **"None"**
2. Atau hapus Framework Preset
3. Setelah itu, field Root Directory akan muncul

---

### Problem 2: Path Tidak Ditemukan Setelah Set

**Kemungkinan Penyebab**:
- Typo dalam path
- Huruf besar/kecil tidak sesuai
- Ada spasi ekstra

**Solusi**:
1. Cek path di GitHub: `https://github.com/kevinnsetiawan/my_website`
2. Lihat struktur folder yang sebenarnya
3. Copy path yang tepat (dari repo root ke project folder)
4. Paste ke Root Directory field

**Cara Cek Path di GitHub**:
```
1. Buka: https://github.com/kevinnsetiawan/my_website
2. Lihat struktur folder
3. Path adalah: OneDrive/Desktop/Project Web Portofolio
   (dari root repo sampai folder yang berisi vercel.json)
```

---

### Problem 3: Setelah Set Root Directory, Build Masih Error

**Kemungkinan Penyebab**:
- Path salah
- File `vercel.json` tidak ada di lokasi tersebut
- File `api/index.php` tidak ada

**Solusi**:
1. Cek Build Logs untuk error spesifik
2. Verifikasi file ada di GitHub:
   - `OneDrive/Desktop/Project Web Portofolio/vercel.json` ✅
   - `OneDrive/Desktop/Project Web Portofolio/api/index.php` ✅
3. Jika file tidak ada, commit dan push file tersebut

---

### Problem 4: Field Root Directory Tidak Bisa Di-Edit

**Kemungkinan Penyebab**:
- Tidak punya permission (Viewer role)
- Project sedang di-deploy

**Solusi**:
1. Minta Owner/Admin untuk set Root Directory
2. Atau tunggu deployment selesai dulu
3. Pastikan role Anda adalah Developer atau lebih tinggi

---

## ✅ Checklist Setelah Set Root Directory

Setelah mengatur Root Directory, pastikan:

- [ ] Root Directory sudah di-set: `OneDrive/Desktop/Project Web Portofolio`
- [ ] Sudah klik "Save"
- [ ] Deployment baru sudah trigger (lihat di tab Deployments)
- [ ] Build Logs tidak menunjukkan error "file not found"
- [ ] Deployment status menjadi "Ready" (hijau)
- [ ] Website bisa diakses: `https://project-web-portofolio.vercel.app`
- [ ] Homepage (`/`) bisa dibuka
- [ ] Route `/projects` bisa dibuka
- [ ] Tidak ada error NOT_FOUND di browser console

---

## 🎯 Quick Reference

**Path yang Harus Di-Set**:
```
OneDrive/Desktop/Project Web Portofolio
```

**Lokasi di Dashboard**:
```
Dashboard → [Project] → Settings → General → Root Directory
```

**Cara Cek Apakah Sudah Benar**:
1. Build Logs tidak ada error "vercel.json not found"
2. Function Logs tidak ada error "api/index.php not found"
3. Website bisa diakses tanpa error NOT_FOUND

---

## 📝 Catatan Penting

1. **Root Directory hanya bisa di-set di Dashboard**, tidak bisa di `vercel.json`
2. **Setelah set Root Directory**, Vercel akan otomatis redeploy
3. **Path harus tepat** - typo akan menyebabkan error
4. **Setelah set**, tunggu deployment selesai sebelum test
5. **Jika masih error**, cek Build Logs untuk detail error

---

## 🚀 Setelah Root Directory Di-Set

Setelah Root Directory di-set dengan benar:

1. ✅ Vercel akan menemukan `vercel.json`
2. ✅ Vercel akan menemukan `api/index.php`
3. ✅ Build akan berhasil
4. ✅ Routes akan bekerja
5. ✅ Website akan bisa diakses!

**Selamat! Website Anda sudah siap!** 🎉

---

## 💡 Tips Tambahan

### Set Environment Variables Juga

Setelah set Root Directory, jangan lupa set Environment Variables:

1. Masih di Settings → **Environment Variables**
2. Tambahkan:
   - `APP_KEY`: Generate dengan `php artisan key:generate --show`
   - `APP_ENV`: `production`
   - `APP_DEBUG`: `false`
   - `APP_URL`: `https://project-web-portofolio.vercel.app`

### Monitor Deployment

Setelah set Root Directory:
- Pantau deployment di tab "Deployments"
- Cek Build Logs untuk memastikan tidak ada error
- Test website setelah deployment selesai

---

**Jika masih ada masalah setelah set Root Directory, cek Build Logs dan Function Logs untuk error spesifik!**
