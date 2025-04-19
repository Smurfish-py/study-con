# StudyCon : Study and Connect

Study and Connect / StudyCon adalah website pembelajaran berbasis Native PHP dan MySQL (MariaDB) yang bertujuan sebagai sarana alternatif untuk berkolaborasi untuk meningkatkan efektivitas pembelajaran antara pengajar dan peserta didik.

Ini merupakan web pembelajaran berbasis Native `PHP`, `MySQL (MariaDB)` yang dikerjakan guna memenuhi tugas project untuk mata pelajaran PKK. Project ini terinspirasi oleh salah satu layanan Google yang bernama `Google Classroom`. Dengan dibuatnya website ini, diharapkan semua pengguna dapat memanfaatkan semua fitur yang ada dan ikut serta dalam pengembangan project ini dengan cara memberikan masukan dan saran.

## Keterangan Project
- **Project name :** StudyCon | Study and Connect
- **Pengembang :** Muhamad Rifqi Kurniawan
- **Bahasa Pengembangan :** Native `PHP`, `HTML` + `CSS`, `Javascript`
- **Platform :** Desktop (Under development), Mobile (Planned)
- **Database :** `MySQL (MariaDB)`
- **Hosted on :** [Infinityfree.com](infinityfree.com)
- **Website link (Preview, Desktop only) :** [sija.free.nf](sija.free.nf)
- **Versi :** Beta V3

## Struktur Folder
- `root` merupakan folder dimana semua file project disimpan.
- [`assets`](./assets) merupakan folder dimana semua aset untuk keperluan pengembangan website disimpan. Dalam folder ini terdapat 5 sub-folder :
   - [`css`](./assets/css) Folder ini digunakan untuk menyimpan file css yang digunakan untuk keperluan pengembangan website.
   - [`development`](./assets/development) Folder ini digunakan untuk menyimpan file-file dokumentasi pengembangan website. Dalam folder ini terdapat 2 sub-folder :
        1. [`images`](./assets/development/images) Folder ini digunakan untuk menyimpan dokumentasi berupa foto.
        2. [`database`](./assets/) Folder ini digunakan untuk menyimpan dokumentasi struktur database berupa file `.sql`.
   - [`images`](./assets/images) Folder ini digunakan untuk menyimpan data foto untuk kebutuhan website.
   - [`javascript`](./assets/javascript) Folder ini digunakan untuk menyimpan file javascript untuk keperluan pengembangan website.
   - [`template`](./assets/template) Folder ini digunakan untuk memudahkan mengcopy elemen yang sama seperti header, tanpa harus mengcopy dari file-file project yang lain.
- [`logika`](./assets/logika) Folder ini digunakan untuk menyimpan file-file logika seperti `login_logic.php`, `register_logic.php` dan lain lain.
- [`user`](./assets/user) Folder ini digunakan sebagai tempat menyimpan halaman dashboard user. Terdapat 3 sub-folder dalam folder ini :
   - [`default`](./assets/default) Folder ini merupakan tempat untuk menyimpan halaman dashboard pengguna dengan status akun `default` atau akun murid.
   - [`teacher`](./assets/teacher) Sama seperti folder `default`, folder teacher juga digunakan untuk menyimpan halaman dashboard akun `teacher` atau guru.
   - [`master`](./assets/master) Sama seperti folder-folder `user` sebelumnnya, folder ini juga digunakan untuk menyimpan halaman dashboard akun `master` atau admin.

## Status dan Hak Akses Pengguna
Dalam website ini, status akun dibagi menjadi 3 berdasarkan privilege nya :
1. `default` akun biasa yang bisa memanfaatkan fitur dasar di website.
2. `teacher` akun guru dengan privilege yang lebih tinggi dengan fitur buat dan kelola kelas.
3. `master` akun dengan privilege tertinggi dengan akses penuh kedalam database dan pengembangan website

Berikut adalah tabel perbandingan privilege untuk setiap status akun :

|**List Privilege**|**Default**|**Teacher**|**Master**|
|------------------|-----------|-----------|----------|
|**Dapat melihat log website**|tidak|tidak|`ya (melalui database)`|
|**Dapat melihat pengumuman**|`ya`|`ya`|`ya (melalui database)`|
|**Join ke dalam kelas**|`ya`|tidak|`ya (melalui database)`|
|**Membuat kelas**|tidak|`ya`|`ya (melalui database)`|
|**Menghapus kelas**|tidak|`ya`|`ya`|
|**Mengedit kelas**|tidak|`ya`|`ya (melalui database)`|
|**Mengeluarkan murid dari kelas**|tidak|`ya`|`ya (melalui database)`|
|**Melakukan ban pengguna**|tidak|tidak|`ya`|
|**Membuat pengumuman**|tidak|tidak|`ya`|
|**Dapat melihat list pengguna website**|tidak|tidak|`ya`|
|**Peningkatan status akun**|`ya`|`ya`|`sudah berada di privilege tertinggi`|
|**Kustomisasi akun**|`ya`|`ya`|`ya`|
|**Buat materi/tugas**|tidak|`ya`|tidak|
|**Hapus materi/tugas**|tidak|`ya`|`ya`|

## Catatan :
Beberapa fitur akan ditambahkan di masa mendatang. Semua fitur yang sudah ada merupakan fitur sementara dan mungkin akan diubah atau direvisi kedepannya.
