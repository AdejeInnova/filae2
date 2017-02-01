<?php
use Migrations\AbstractMigration;

class ChangeNetworksAndCommunications extends AbstractMigration
{

    public function up()
    {

        $this->table('cnaes')
            ->removeColumn('codigo')
            ->removeColumn('description')
            ->removeColumn('company_id')
            ->update();

        $this->table('companies')
            ->removeColumn('address_id')
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

        $this->table('addresses')
            ->addColumn('companie_id', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('cnaes')
            ->addColumn('cod_cnae', 'string', [
                'default' => null,
                'length' => 10,
                'null' => false,
            ])
            ->addColumn('codintegr', 'string', [
                'comment' => 'CODINTEGR - Según csv cnae2009',
                'default' => null,
                'length' => 10,
                'null' => false,
            ])
            ->addColumn('titulo_cnae', 'string', [
                'comment' => 'título cnae 2009',
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->addColumn('companie_id', 'integer', [
                'comment' => 'id empresa',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('communications')
            ->addColumn('class', 'string', [
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->update();

        $this->table('networks')
            ->addColumn('class', 'string', [
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('addresses')
            ->removeColumn('companie_id')
            ->update();

        $this->table('cnaes')
            ->addColumn('codigo', 'string', [
                'default' => null,
                'length' => 45,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'comment' => 'descripción cae
',
                'default' => null,
                'length' => 4294967295,
                'null' => false,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'id empresa
',
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->removeColumn('cod_cnae')
            ->removeColumn('codintegr')
            ->removeColumn('titulo_cnae')
            ->removeColumn('companie_id')
            ->update();

        $this->table('communications')
            ->removeColumn('class')
            ->update();

        $this->table('companies')
            ->addColumn('address_id', 'integer', [
                'comment' => 'id dirección',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();

        $this->table('networks')
            ->removeColumn('class')
            ->removeColumn('created')
            ->removeColumn('modified')
            ->update();

        $this->dropTable('cake_d_c_users_phinxlog');
    }
}

