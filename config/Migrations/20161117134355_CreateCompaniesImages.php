<?php
use Migrations\AbstractMigration;

class CreateCompaniesImages extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('images');

        $table->addColumn('companie_id', 'integer', [
            'signed' => 'disable'
        ]);

        $table->addColumn('photo', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('photo_dir', 'text', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('profile', 'boolean');

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->addForeignKey('companie_id', 'companies', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION']);

        $table->create();
    }
}
