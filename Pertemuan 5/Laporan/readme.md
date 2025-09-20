## Analisis Laporan

## Percobaan2a.html
Kode HTML pada percobaan ini merupakan contoh implementasi JavaScript yang diletakkan pada dua lokasi berbeda dalam struktur dokumen. Dokumen ini memiliki judul "contoh JavaScript" yang ditentukan dalam tag <TITLE>. Pada bagian <HEAD>, terdapat script JavaScript pertama yang menggunakan metode document.write() untuk menampilkan teks "Program JavaSript Aku di kepala". Penempatan script di head menyebabkan kode ini dieksekusi selama proses loading halaman, sebelum konten body dirender, sehingga teks akan muncul di bagian paling atas halaman.

Selanjutnya, dalam tag <BODY>, terdapat script JavaScript kedua yang juga menggunakan document.write() untuk menampilkan teks "Program JavaSript Aku di body". Script yang diletakkan di body ini akan dieksekusi ketika browser melakukan parsing dan mencapai titik tersebut dalam dokumen, sehingga teks akan ditampilkan di dalam body halaman. Output akhir dari kode ini akan menampilkan dua baris teks berurutan: pertama teks dari head diikuti teks dari body.
Output: 
<img src="images/Percobaan2a.png" width="300" alt="Output percobaan2a.html">