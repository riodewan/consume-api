1. Install CodeIgniter 4
Anda bisa menginstal CodeIgniter 4 secara manual, ataupun melalui Composer seperti yang kami lakukan pada panduan kali ini. 

Caranya, masuklah ke direktori C:/xampp/htdocs dan bukalah terminal CMD pada folder htdocs tersebut. Kemudian, jalankan perintah berikut ini:

composer create-project codeigniter4/appstarter ci4_api
Perintah di atas, akan menginstal CodeIgniter 4 dengan nama project ci4_api. Anda bisa mengubah nama project sesuai keinginan Anda, ya.

Baca Juga: Cara Install Codeigniter di Hosting

2.  Mengaktifkan Mode Development di CodeIgniter 4
Kalau instalasi sudah berhasil, bukalah project CodeIgniter 4 Anda menggunakan Visual Studio Code. Lalu, temukan file env dan ubah nama filenya menjadi .env dengan cara klik kanan pada file, kemudian klik Rename.

Selanjutnya, Anda perlu mengubah baris kode CI_ENVIRONMENT di file .env yang semula bernilai production menjadi development seperti ini:

mengaktifkan mode development di CodeIgniter 4
Hal ini perlu dilakukan pada tahap pengembangan, supaya jika terjadi error, CodeIgniter 4 dapat memberi pesan error secara detail. Dengan begitu, Anda bisa mengetahui letak kesalahan dan segera memperbaikinya.

Kalau sudah, tekan tombol CTRL + S di keyboard untuk menyimpan perubahan file.

3. Membuat Database di phpMyAdmin
Di langkah ini, silakan akses halaman localhost/phpMyAdmin di web browser Anda. Kemudian, buatlah buat database MySQL. Pada tutorial ini, kami membuat database dengan nama ci4_api.

membuat database REST API CodeIgniter di phpMyAdmin
Kalau sudah berhasil dibuat, klik database baru Anda, lalu pilih tab SQL dan salinlah SQL Query di bawah ini pada kolom yang tersedia:

CREATE TABLE produk (
    id int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
    nama_produk varchar(100) NOT NULL COMMENT 'Nama Produk',
    harga varchar(255) NOT NULL COMMENT 'Harga',
    PRIMARY KEY (id)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='datatable produk table' AUTO_INCREMENT=1;
   
INSERT INTO `produk` (`id`, `nama_produk`, `harga`) VALUES
(1, 'Kaos Pria', '50000'),
(2, 'Culotte Highwaist', '78000'),
(3, 'Jaket', '150000'),
(4, 'Hoodie', '100000'),
(5, 'Blouse', '125000'),
(6, 'Kemeja Flanel', '111000'),
(7, 'Skinny Jeans', '90000');
Query di atas akan membuat sebuah tabel baru bernama produk yang terdiri dari tiga atribut, yaitu: id, nama_produk dan harga. Tabel tersebut akan berisi tujuh data produk. Anda juga bisa mengubahnya sesuai keinginan Anda, ya.

Jangan lupa, klik tombol Go untuk menjalankan query.

menambahkan tabel dan data ke database REST API CodeIgniter
Silakan cek kembali database Anda, seharusnya sekarang sudah ada tabel baru beserta data produknya.

4. Melakukan Konfigurasi Database
Database baru yang Anda buat belum terhubung dengan project CodeIgniter 4 Anda. Nah, untuk menghubungkannya, Anda perlu melakukan konfigurasi database.

Caranya, masuklah ke direktori app/Config dan buka file Database.php. Temukanlah baris kode berikut ini:

melakukan konfigurasi database REST API CodeIgniter
Masukkan root sebagai username database. Kemudian, masukkan nama database Anda pada baris kode database. Jangan lupa, simpan perubahan.

Sampai sini, Anda sudah berhasil menghubungkan database dengan project CodeIgniter 4.

Baca Juga: Cara Mengatasi Database A Error Occured CodeIgniter

5. Membuat File Model
Langkah selanjutnya untuk membuat REST API dengan CodeIgniter adalah membuat file model. Masuklah ke direktori app/Models dan buatlah file baru bernama ProductModel.php.

Kemudian, salinlah kode di bawah ini:

<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class ProductModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_produk', 'harga'];
}
File model ini berfungsi untuk mengakses tabel pada database Anda. Ubah nilai dari kode di atas dengan memasukkan nama tabel, primary key serta atribut tabel Anda, ya.

6. Membuat File REST Controller
Pada tahap ini, Anda akan membuat file REST Controller yang berisi fungsi untuk menampilkan, menambah, mengubah dan menghapus data.Masuklah ke direktori app\Controllers dan buatlah file baru bernama Product.php. Kemudian, salin kode di bawah ini ke dalam file tersebut:

<?php
 
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
 
class Product extends ResourceController
{
    use ResponseTrait;
    // all users
    public function index()
    {
        $model = new ProductModel();
        $data['produk'] = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
    // create
    public function create()
    {
        $model = new ProductModel();
        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga'  => $this->request->getVar('harga'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data produk berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
    }
    // single user
    public function show($id = null)
    {
        $model = new ProductModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
    // update
    public function update($id = null)
    {
        $model = new ProductModel();
        $id = $this->request->getVar('id');
        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga'  => $this->request->getVar('harga'),
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data produk berhasil diubah.'
            ]
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($id = null)
    {
        $model = new ProductModel();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data produk berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
}
Kode diatas berisi 5 method, yaitu:

index() – Berfungsi untuk menampilkan seluruh data pada database.
create() – Berfungsi untuk menambahkan data baru ke database.
show() – Berfungsi untuk menampilkan suatu data spesifik dari database.
update() – Berfungsi untuk mengubah suatu data pada database.
delete() – Berfungsi untuk menghapus data dari database.
7. Membuat REST API Route
Untuk mengakses REST API CodeIgniter, Anda perlu mendefinisikan route-nya terlebih dulu. Caranya, masuklah ke direktori app/Config dan bukalah file Routes.php. Temukan kode di bawah ini:

$routes->get('/','Home::index' );
Kemudian, salin kode di bawah ini tepat dibawah baris kode tersebut:

$routes->resource('product');
Dengan route tersebut, nantinya API Anda bisa diakses pada URL http://localhost:8080/product. Untuk mengecek apakah routes sudah berhasil ditambahkan atau belum, Anda bisa menjalankan perintah ini pada terminal di Visual Studio Code:

php spark routes
Kalau Anda sudah melihat tampilan seperti ini, maka Anda sudah berhasil:

mengecek REST API CodeIgniter routes
Seperti yang Anda lihat, satu baris kode routes yang Anda tambahkan akan menghasilkan banyak Endpoint.

Nah sekarang, Anda sudah bisa melakukan uji coba terhadap REST API CodeIgniter.

8. Melakukan Testing REST API CodeIgniter
Untuk melakukan pengujian, jalankan CodeIgniter 4 menggunakan perintah berikut:

php spark serve
Selanjutnya, bukalah aplikasi Postman dan pilih Create New.

halaman awal postman
Lalu, klik HTTP Request.

membuat HTTP request
Nah, di halaman HTTP Request, Anda akan melakukan lima pengujian REST API CodeIgniter, yaitu:

1. Menampilkan Semua Data
Pilih method GET dan masukkan URL berikut:

http://localhost:8080/product
Lalu, klik Send. Kalau hasil test menampilkan semua data produk dari database Anda, maka pengujian berhasil.

test menampilkan semua data 
2. Menampilkan Data Spesifik
Masih menggunakan method GET, Anda hanya perlu menambahkan ID produk di belakang URL seperti ini:

http://localhost:8080/product/2
Selanjutnya, klik Send. Request tersebut akan menampilkan data produk yang memiliki ID nomor 2 di database Anda.

test menampilkan data spesifik
3. Mengubah Data 
Untuk mengubah data, silakan ganti method menjadi PUT. Kemudian, masukkan URL produk yang ingin Anda ubah. Misalnya, Anda ingin mengubah data produk dengan ID nomor 2, maka masukkan URL berikut:

http://localhost:8080/product/2
Selanjutnya, pilih tab Body. Kemudian, pilih x-www-form-uriencoded. Masukkan nama atribut tabel pada kolom KEY dan nilai data yang baru pada kolom VALUE. Kalau sudah, klik Send.

test mengubah data
Hasil pengujian menampilkan pesan bahwa data produk sudah berhasil diubah. Untuk memastikannya, Anda bisa mengeceknya kembali menggunakan method GET seperti yang dilakukan pada pengujian sebelumnya, ya.

4. Menambahkan Data
Anda perlu menggunakan method POST untuk menambahkan data baru ke database Anda. Kemudian, masukkan URL berikut:

http://localhost:8080/product
Pilih tab Body, lalu pilih x-www-form-uriencoded. Masukkan atribut tabel pada kolom KEY dan nilai data baru di kolom VALUE. Jangan lupa, klik Send. 

test menambahkan data
Gunakan method GET untuk memastikan keberhasilan penambahan data, ya.

5. Menghapus Data
Pilih method DELETE untuk menghapus data. Lalu, masukkan URL spesifik data mana yang ingin Anda hapus. Misalnya, kami ingin menghapus data nomor 7, maka URL-nya seperti ini:

http://localhost:8080/product/7
Langsung saja klik Send, maka Anda akan mendapatkan pesan bahwa data telah berhasil dihapus dari database.

test menghapus data
Baca Juga: Cara Mengatasi Unable to Connect to Your Database Server di CodeIgniter

Kesimpulan
Bagaimana, Anda telah berhasil membuat web service dengan CodeIgniter 4, kan? Cukup mudah, ya? 

Sayangnya, web service REST API yang Anda buat masih tersimpan di komputer pribadi. Nah, agar bisa diakses dan digunakan publik, Anda harus membuatnya online dengan cara menguploadnya di hosting.

Layanan Unlimited Hosting Niagahoster bisa menjadi pilihan tepat, lho. Niagahoster menawarkan hosting murah berkualitas dengan fitur yang lengkap.

Mulai dari kecepatan loading yang didukung oleh Litespeed, web server tercepat di dunia, hingga keamanan terjamin dari Imunify360 yang bisa melindungi server dari DDoS dan Malware.

Selain itu, hosting Niagahoster juga memiliki jaminan uptime 99,9% yang membuat web service Anda bisa selalu online 24 jam.

Menariknya, Anda bisa menikmati layanan tersebut hanya dengan harga Rp27rb/bulan. Sangat menarik, kan?
