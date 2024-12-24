# UAS Pemrograman Website
> Hillmy Dyan Nugraha Huda 
> 121140083
> Link Website: (https://nhjaya.online/)

## Bagian 1: Client-Side Programming
**1.1 Manipulasi DOM dengan JavaScript**
> Pada halaman ini user diminta untuk mengisi formulir pendaftaran .
> user akan di arahkan untuk mengisi informasi yang dibutuhkan seperti `username`, `password`, `role admin atau user`dan `nomor` untuk memastikan keamanan akun.
![image](https://github.com/user-attachments/assets/d19357ee-4aa8-4a71-9bd3-8cfe6eb72f09)



## Bagian 2: Server-Side Programming
**2.1 Pengelolaan Data dengan PHP**
> pada halaman ini terdapat tombol "Add item", user dapat menambahkan barang baru ke dalam sistem. Formulir yang sederhana seperti `nama barang`dan `kode barang`
>  Setelah mengisi form, pengguna hanya perlu mengklik tombol "simpan" untuk menyimpan produk baru.
> Di bawah formulir, terdapat daftar produk yang sudah ada, lengkap dengan opsi untuk mengedit atau menghapus setiap item.

![image](https://github.com/user-attachments/assets/59b8a280-27ff-4f15-9386-c24e98807ad6)


## Bagian 3: Database Management
**3.1 Pembuatan Tabel Database**

![image](https://github.com/user-attachments/assets/ee6b07ca-fa20-4ed9-8ca9-74651096cd32)


**3.2 Konfigurasi Koneksi Database**

![image](https://github.com/user-attachments/assets/5b1f1847-8ad5-42c4-b33e-5caea18b426e)


**3.3 Manipulasi Data pada Database**

![image](https://github.com/user-attachments/assets/366ada6e-a064-4ef5-89f0-4043b3253ced)


## Bagian 4: State Management
**4.1 State Management dengan Session**
> saya menggunakan session pada halaman `index.php` untuk mengecek atau menyimpan sesi login yang dimana jika belum melakukan login atau sesi sebelumnya maka akan diarahkan kemabali pada halaman `login.php`

![image](https://github.com/user-attachments/assets/6f5ea462-0c70-43f0-963e-64d1437632f0)


## Bagian 5: Hosting Aplikasi Web
**+ Langkah untuk meng-hosting aplikasi web.**

   - disini saya menggunakan jasa hosting domaniesia dan saya sudah memiliki domain yang aktif
   - langkah pertama yaitu satukan semua file menjadi bentuk file `.zip`
   - lalu masuk ke akun domainesia dan masuk ke control panel
   - 
![image](https://github.com/user-attachments/assets/4b9c8962-ab7b-4d77-bc8f-777c118801df)

   - masuk ke file manager lalu masuk ke folder `public_html`
   - Upload file aplikasi web kita. jangan lupa ekstrak file tersebut didalam folder `public_html`

![image](https://github.com/user-attachments/assets/89715c78-405a-44a8-98fa-d0a1dab7c628)
![image](https://github.com/user-attachments/assets/f7593089-ea25-4767-8337-c29192190155)

   - Setelah mengupload file selanjutnya masuk ke menu database dan buat data base baru
     
![image](https://github.com/user-attachments/assets/6441c0a8-ac70-4141-93c1-ac6c264996ee)

   - lalu masuk ke bagian phpmyAdmin hostingan lalu upload file database yang sudah di buat 

   - lalu sesuaikan kembali konfigurasi koneksi untuk menghubungkan ke database yang baru menggunakan detail yang sesuai (host, username, password, dan nama database).
   - Akses aplikasi web melalui browser untuk memastikan berjalan dengan baik.
     
**+ Penyedia web yang cocok.**
   
   disini saya menggunakan Domanesia karna memang sudah beberapa kali menggunakan jasa hosing disni dan menurut saya disini paling mudah digunakan
   dan menunya enak dilihat
   dan disini menurut saya memiliki harga yg paling murah di antara penyedia layanan hosting lainnya

**+ Memastikan keamanan aplikasi web.**
   - SSL Certificate: Pastikan menggunakan HTTPS dengan menginstal SSL untuk mengenkripsi data yang dikirim antara server dan klien.
   - menggunakan prepare statement untuk mencegah serangan seperti SQL Injection.
     
     ![image](https://github.com/user-attachments/assets/2d0524da-d31f-4023-9164-92f40fd8d326)

   - Atur izin file dan folder dengan benar agar tidak memberikan akses ke folder yg bersifat privat.
     

**+ Konfigurasi server untuk mendukung aplikasi web.**
   - Pastikan server menggunakan versi stabil PHP terbaru (misalnya, 8.x) untuk mendapatkan peningkatan kinerja, fitur terkini, dan perlindungan terhadap celah keamanan.
   - Pastikan database MySQL diatur dengan parameter yang tepat untuk meningkatkan efisiensi, seperti pengoptimalan koneksi dan pengelolaan query.
   - aktifkan fitur caching untuk mempercepat pemuatan halaman dan mengurangi beban server.
   - Error Handling: Atur mekanisme penanganan error agar menampilkan pesan yang user-friendly dan tidak membocorkan informasi sensitif kepada pengguna.
   - Monitoring: Gunakan alat pemantauan untuk memeriksa performa dan kondisi server secara berkala, meskipun fitur pada layanan gratis mungkin memiliki batasan.
