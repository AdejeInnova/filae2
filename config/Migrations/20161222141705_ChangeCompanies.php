<?php
use Migrations\AbstractMigration;

class ChangeCompanies extends AbstractMigration
{

    public function up()
    {

        $this->table('cake_d_c_users_phinxlog', ['id' => false, 'primary_key' => ['version']])
            ->addColumn('version', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('migration_name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('start_time', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('end_time', 'timestamp', [
                'default' => '0000-00-00 00:00:00',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('muffin_tags_phinxlog', ['id' => false, 'primary_key' => ['version']])
            ->addColumn('version', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('migration_name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('start_time', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('end_time', 'timestamp', [
                'default' => '0000-00-00 00:00:00',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('tags_phinxlog', ['id' => false, 'primary_key' => ['version']])
            ->addColumn('version', 'biginteger', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('migration_name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('start_time', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('end_time', 'timestamp', [
                'default' => '0000-00-00 00:00:00',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('companies')
            ->addColumn('superficie_id', 'integer', [
                'comment' => 'Id de array constant del bootstrap.php',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('companies')
            ->removeColumn('superficie_id')
            ->update();

        $this->dropTable('cake_d_c_users_phinxlog');

        $this->dropTable('muffin_tags_phinxlog');

        $this->dropTable('tags_phinxlog');
    }
}

