<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBeritaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_berita' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul_berita' => [
                'type' => 'TEXT',
            ],
            'status_berita' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'gambar_berita' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi_berita' => [
                'type' => 'TEXT',
            ],
            'tanggal_berita' => [
                'type' => 'DATE',
            ],
        ]);

        $this->forge->addKey('id_berita', true);
        $this->forge->createTable('berita', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('berita');
    }
}