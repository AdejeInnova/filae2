<?php
use Migrations\AbstractMigration;

class ChangeCompaniesTradename extends AbstractMigration
{

    public function up()
    {

        $this->table('companies')
            ->changeColumn('tradename', 'string')
            ->update();

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
    }

    public function down()
    {

        $this->table('companies')
            ->changeColumn('tradename', 'string', [
                'comment' => 'nombre comercial',
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->update();

        $this->dropTable('cake_d_c_users_phinxlog');
    }
}

