# lsp-widyatama-todollist-app

##Deskripsi
Aplikasi Sederhana berbasis PHP menggunakan Laravel untuk mencatat tugas Harian.

##Fitur
-Tambah Tugas.
-Tandai tugas selesai.
-Hapus Tugas

##Struktur Folder
-Controllers/'TaskController.php'
-Models/'Task.php'
#Base Layout
-views/layouts/'app.blade.php'

#Main Page
views/'index.blade.php'
#Partials Page
views/partials/'form.blade.php'
views/partials/'list.blade.php'
views/partials/'task_item.blade.php'

##Cara Menjalankan
-Clone git ke 'htdocs/'
-Import Databases 'task.sql' / atau:
-Jalankan php artisan migrate
-Buatkan schema:  Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->boolean('completed')->default(false);
        $table->timestamps();
    });
-Jalankan kembali migrate: php artisan migrate
-Jalankan XAMPP dan buka di 'http://127.0.0.1:8000/tasks'

##Kontributor
- [Demas Farand](https://github.com/demas-farand)
