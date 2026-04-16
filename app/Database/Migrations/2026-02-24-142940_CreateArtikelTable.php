<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArtikelTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_artikel' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul_artikel' => [
                'type' => 'TEXT',
            ],
            'status_artikel' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'gambar_artikel' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi_artikel' => [
                'type' => 'TEXT',
            ],
            'tanggal_artikel' => [
                'type' => 'DATE',
            ],
        ]);

        $this->forge->addKey('id_artikel', true);
        $this->forge->createTable('artikel', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('artikel');
    }
}