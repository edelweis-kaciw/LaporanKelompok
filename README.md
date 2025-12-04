# 💻 INSTALLASI WEB SERVER NGINX, PHP 8.4, DAN SSL DI DEBIAN TRIXIE

**Proyek:** Instalasi dan Konfigurasi Nginx + PHP 8.4 + SSL Self-Signed

Proyek ini dibuat untuk memenuhi tugas mata pelajaran **Administrasi Sistem Jaringan (ASJ)**, yang merupakan salah satu elemen Capaian Pembelajaran Konsentrasi Keahlian Teknik Komputer dan Jaringan (**CP KKTKJ**) pada program TJKT. Proyek ini berfokus pada implementasi layanan Web Server, konfigurasi PHP, dan pengamanan koneksi menggunakan SSL/HTTPS.

---

## 1. 👥 Informasi Kelompok dan Spesifikasi Lingkungan Praktik

### 1.1. Informasi Kelompok

| Peran | Nama Lengkap | Kelas |
| :--- | :--- | :--- |
| **Ketua Kelompok** | Marcellino Kresna Pratama | XI TKJ 1 |
| Anggota 1 | Siti Zahrotussita | XI TKJ 1 |
| Anggota 2 | Karina Mega | XI TKJ 1 |
| Anggota 3 | Aldi Mulyana | XI TKJ 1 |
| **Nama Sekolah/Institusi** | SMKN 1 Soreang | |

---

### 1.2. Spesifikasi Alat dan Bahan (Host) 🛠️

| Komponen | Deskripsi / Versi |
| :--- | :--- |
| **Virtualisasi** |  VMware Workstation 17 Pro |
| **Sistem Operasi Host** | Windows 11 |
| **RAM Host (Minimal)** | 8 GB |
| **CPU Host** | Intel(R) Celeron(R) N4020 CPU @ 1.10GHz |

---

### 1.3. Spesifikasi Server Virtual (VM) 🖥️

| Spesifikasi | Detail |
| :--- | :--- |
| **Sistem Operasi Tamu (Guest OS)** | Debian Trixie (12.x) |
| **Alamat IP Server** | `10.190.72.203` |
| **RAM VM** | 2 GB |
| **vCPU** | 2 Core |
| **Web Server yang Dipilih** | **Nginx** |
| **Versi PHP yang Dipakai** | **PHP-FPM 8.4** |

---

# 2. 📝 Dokumentasi Teknis dan Langkah-Langkah Pengerjaan

## 2.1. Persiapan Dasar Debian Trixie

1. Update dan upgrade sistem:
```bash
apt update && apt upgrade -y
```

2. Cek koneksi internet dan IP server:
```bash
ip a
ping google.com
```

---

## 2.2. Instalasi dan Konfigurasi Web Server Nginx 🌐

### 🔧 Instalasi Nginx
```bash
apt install nginx -y
```

### 🔧 Mengecek status Nginx
```bash
systemctl status nginx
```

### 🔧 Mengaktifkan Nginx saat boot
```bash
systemctl enable nginx
```

### 🔧 Menguji Web Server dari browser
Buka:

```
http://[IP Server]
```

Jika halaman default Nginx muncul, berarti server berjalan normal.

---

## 2.3. Instalasi dan Konfigurasi PHP-FPM 8.4 🐘

### 🔧 Instalasi PHP 8.4 + modul
```bash
apt install php8.4 php8.4-fpm php8.4-mysql php8.4-cli -y
```

### 🔧 Mengecek status PHP-FPM
```bash
systemctl status php8.4-fpm
```

---

## 2.4. Menghubungkan Nginx dengan PHP-FPM

Edit konfigurasi server block:
```bash
nano /etc/nginx/sites-available/default
```

Ubah atau sesuaikan bagian berikut menjadi:
```
server {
    listen 80 default_server;          # Dengarkan koneksi HTTP di port 80 (standar web)
    listen [::]:80 default_server;     # Dukungan untuk IPv6

    root /var/www/html;                # Folder utama tempat file website disimpan
    index index.php index.html;        # Urutan file index yang akan dicari pertama kali

    server_name _;                     # "_" artinya menerima semua nama domain/host

    # Bagian utama untuk menangani request ke website
    location / {
        # Coba tampilkan file sesuai permintaan
        # Jika tidak ada, coba foldernya
        # Jika tetap tidak ada, arahkan ke index.php (penting untuk WordPress, Moodle, dll.)
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Bagian untuk menjalankan file PHP
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;             # Include konfigurasi standar PHP-FPM
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;    # Jalur socket PHP-FPM versi 8.4

        # Beritahu PHP file mana yang harus dijalankan
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;                        # Include parameter tambahan untuk PHP
    }

    # Bagian untuk file statis (gambar, CSS, JS, font, dll.)
    # Dikasih aturan cache supaya website lebih cepat dibuka
    location ~* \.(?:ico|css|js|gif|jpe?g|png|woff2?|eot|ttf|svg|mp4)$ {
        expires 6M;             # Browser boleh menyimpan file ini 6 bulan
        access_log off;         # Jangan dicatat di log akses (hemat space/log)
        log_not_found off;      # Jangan catat kalau file statis tidak ditemukan
    }

    # Lindungi file .htaccess atau file tersembunyi (.ht*)
    # Biasanya digunakan Apache, tapi tetap diblokir di Nginx agar aman
    location ~ /\.ht {
        deny all;
    }
}
```

Simpan, lalu restart Nginx:
```bash
systemctl restart nginx
```

### 🔧 Test PHP
Buat file:
```bash
nano /var/www/html/info.php
```

Isi:
```php
<?php phpinfo(); ?>
```

Akses:
```
http://[IP Server]/info.php
```

---

## 2.5. Konfigurasi SSL Self-Signed 🔒

### 🔧 Membuat folder SSL
```bash
mkdir /etc/nginx/ssl
```

### 🔧 Membuat certificate & private key
```bash
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
-keyout /etc/nginx/ssl/server.key \
-out /etc/nginx/ssl/server.crt
```

### 🔧 Edit server block SSL
```bash
nano /etc/nginx/sites-available/default
```

Tambahkan:

```
server {
    listen 80 default_server;          # Dengarkan koneksi HTTP di port 80
    listen [::]:80 default_server;     # Dukungan untuk IPv6

    root /var/www/html;                # Folder utama untuk file website
    index index.php index.html;        # File index yang akan dicari pertama

    server_name _;                     # "_" artinya menerima semua nama domain/host

    # Bagian utama untuk menangani request
    location / {
        # Coba tampilkan file/ folder sesuai permintaan
        # Jika tidak ada, teruskan ke index.php (penting untuk WordPress/Moodle)
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Bagian untuk menjalankan file PHP
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock; # Jalur socket PHP-FPM

        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Lindungi file tersembunyi (.htaccess, .git, .env, dll.)
    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Atur caching untuk file statis (gambar, css, js, font, video)
    location ~* \.(?:ico|css|js|gif|jpe?g|png|woff2?|eot|ttf|svg|mp4)$ {
        expires 6M;             # Simpan cache selama 6 bulan
        access_log off;         # Tidak perlu dicatat di access log
        log_not_found off;      # Jika file tidak ada, jangan penuhkan log
    }
}

# ==========================
# Konfigurasi HTTPS (port 443, SSL/TLS)
# ==========================
server {
    listen 443 ssl default_server;      # Dengarkan koneksi HTTPS di port 443
    listen [::]:443 ssl default_server; # Dukungan untuk IPv6

    root /var/www/html;                 # Sama seperti HTTP
    index index.php index.html;
    server_name _;

    # Lokasi sertifikat SSL self-signed
    ssl_certificate /etc/ssl/nginx/selfsigned.crt;
    ssl_certificate_key /etc/ssl/nginx/selfsigned.key;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;

        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    location ~* \.(?:ico|css|js|gif|jpe?g|png|woff2?|eot|ttf|svg|mp4)$ {
        expires 6M;
        access_log off;
        log_not_found off;
    }
}
```

Restart Nginx:
```bash
systemctl restart nginx
```

Akses:

```
https://[IP Server]
```

---

# 3. 📊 Analisis Web Server

| Aspek | Kelebihan (Nginx) 👍 | Kekurangan (Nginx) 👎 |
| :--- | :--- | :--- |
| **Performa & Kecepatan** | Ringan, cepat, scalable | Sedikit lebih sulit untuk pemula |
| **Kemudahan Konfigurasi** | File konfigurasi rapi & modular | Error sering karena salah indentasi |
| **Fitur & Modularitas** | Mendukung reverse proxy & load balancing | Modul internal lebih sedikit dibanding Apache |

---

# 4. 🧠 Refleksi Proyek

## 4.1. Kesan ✨
[Pusing Rudet tapi menyenangkan, tapi kita bisa tau cara menggunakan nginx, buat website di Linux.

## 4.2. Kendala dan Solusi 💡

| Kendala | Solusi |
| :--- | :--- |
| Nginx tidak terbaca | Restart service dan cek sintaks |
| SSL error | Perbaiki path certificate |
| Gagal install apt] | Cek Konfigurasi pada repository |
| Gagal saat restart network service] | Cek Konfigurasi Network interfaces |
| Gagal menggunakan ssh cmd | Ubah konfigurasi pada sshd di bagian permitrootlogin menjadi yes |

---

# 5. 📂 Dokumentasi Konten Website
Seluruh source code website ada pada folder `/Website Kelompok` repository ini.

---

# 6. 🎬 Dokumentasi Video Pengerjaan
**Link Video YouTube:**  
[![Thumbnail Video Pengerjaan](https://img.youtube.com/vi/1-Hwf75BWtT3jimJV1/0.jpg)](https://www.youtube.com/watch?v=Hwf75BWtT3jimJV1)

