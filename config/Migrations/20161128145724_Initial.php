<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('addresses')
            ->addColumn('road_id', 'integer', [
                'comment' => 'tipo de vía (tabla roads)',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('address', 'string', [
                'comment' => 'nombre calle
',
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('number', 'integer', [
                'comment' => 'número dirección
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('block', 'integer', [
                'comment' => 'Bloque del edificio
',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('floor', 'integer', [
                'comment' => 'piso del edificio
',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('door', 'string', [
                'comment' => 'puerta
',
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('default', 'boolean', [
                'comment' => 'Este campo es si la dirección es la dirección de la persona o empresa por defecto.',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('latlon', 'string', [
                'comment' => 'latitud - longitud de ubicación.
',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('town_id', 'integer', [
                'comment' => 'id población (tabla towns)
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('person_id', 'integer', [
                'comment' => 'id persona
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('core', 'string', [
                'comment' => 'núcleo -> texto obtenido de la tabla cores.',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('postcode', 'integer', [
                'comment' => 'código postal
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('cnaes')
            ->addColumn('codigo', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'comment' => 'descripción cae
',
                'default' => null,
                'limit' => 4294967295,
                'null' => false,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'id empresa
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('communications')
            ->addColumn('name', 'string', [
                'comment' => 'email
telefono
fax
',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('communications_companies')
            ->addColumn('value', 'string', [
                'comment' => 'valor ten mail o fax
',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('communication_id', 'integer', [
                'comment' => 'id tipo comunicación
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'id empresa
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();

        $this->table('communications_persons')
            ->addColumn('value', 'string', [
                'comment' => 'el valor del teléfono fax o email
',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('communication_id', 'integer', [
                'comment' => 'id tipo comunicación
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('person_id', 'integer', [
                'comment' => 'id persona
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('companies')
            ->addColumn('tradename', 'string', [
                'comment' => 'nombre comercial',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'comment' => 'razón social',
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('idcard_id', 'integer', [
                'comment' => 'tipo documento',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('identity_card', 'string', [
                'comment' => 'cif/nie/dni',
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('description', 'text', [
                'comment' => 'observaciones
',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'id de empresa padre',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('address_id', 'integer', [
                'comment' => 'id dirección',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('companies_networks')
            ->addColumn('url', 'string', [
                'comment' => 'enlace a la red social
',
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('network_id', 'integer', [
                'comment' => 'id tipo red
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'id empresa
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('contacts')
            ->addColumn('charge', 'string', [
                'comment' => 'cargo contacto
',
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('person_id', 'integer', [
                'comment' => 'id persona
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'id empresa
',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('sede_id', 'integer', [
                'comment' => 'id de sede',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('contacts_communications')
            ->addColumn('value', 'string', [
                'comment' => 'valor (email, teléfono, fax, …)
',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('communication_id', 'integer', [
                'comment' => 'id tipo comunicación
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('contact_id', 'integer', [
                'comment' => 'id contacto
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('cores')
            ->addColumn('name', 'string', [
                'comment' => 'nombre núcleo
',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('town_id', 'integer', [
                'comment' => 'id población -> towns
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('idcards')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('person', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('company', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('images')
            ->addColumn('companie_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('photo', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('photo_dir', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('profile', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'companie_id',
                ]
            )
            ->create();

        $this->table('networks')
            ->addColumn('name', 'string', [
                'comment' => 'twitter, face, insta, trip',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->create();

        $this->table('networks_persons')
            ->addColumn('url', 'string', [
                'comment' => 'campo del enlace de la red
',
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('network_id', 'integer', [
                'comment' => 'id red social
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('person_id', 'integer', [
                'comment' => 'id persona
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('persons')
            ->addColumn('name', 'string', [
                'comment' => 'nombre
',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('first_last_name', 'string', [
                'comment' => 'primer apellido',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('second_last_name', 'string', [
                'comment' => 'segundo apellido',
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('idcard_id', 'integer', [
                'comment' => 'tipo de documento
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('identity_card', 'string', [
                'comment' => 'número del documento
',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('gender', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('birthdate', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('census', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('checkpadron', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('postcodes')
            ->addColumn('postcode', 'integer', [
                'comment' => 'Código postal
',
                'default' => null,
                'limit' => 5,
                'null' => false,
            ])
            ->addColumn('core_id', 'integer', [
                'comment' => 'id tabla cores -> núcleos',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('provinces')
            ->addColumn('name', 'string', [
                'comment' => 'nombre provincia
',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('region_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('regions')
            ->addColumn('name', 'string', [
                'comment' => 'nombre comunidad autónoma
',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('relationships', ['id' => false, 'primary_key' => ['id', 'name']])
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'comment' => 'nombre tipo parentesco.',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('relationships_has_persons', ['id' => false, 'primary_key' => ['relationship_id', 'person_id']])
            ->addColumn('relationship_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('person_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('person_id1', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('roads')
            ->addColumn('name', 'string', [
                'comment' => 'calle, avenida, carretera etc.',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('sedes')
            ->addColumn('name', 'string', [
                'comment' => 'nombre sede
',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'comment' => 'observaciones
',
                'default' => null,
                'limit' => 4294967295,
                'null' => true,
            ])
            ->addColumn('address_id', 'integer', [
                'comment' => 'id dirección',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'id empresa
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('social_accounts', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('user_id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('provider', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('reference', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('avatar', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('link', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('token', 'string', [
                'default' => null,
                'limit' => 500,
                'null' => false,
            ])
            ->addColumn('token_secret', 'string', [
                'default' => null,
                'limit' => 500,
                'null' => true,
            ])
            ->addColumn('token_expires', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('active', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('data', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $this->table('towns')
            ->addColumn('name', 'string', [
                'comment' => 'nombre población',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('township_id', 'integer', [
                'comment' => 'id municipio',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('townships')
            ->addColumn('name', 'string', [
                'comment' => 'nombre municipio
',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('province_id', 'integer', [
                'comment' => 'id tabla provincias -> provinces ',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('users', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('first_name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('token', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('token_expires', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('api_token', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('activation_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('tos_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('active', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('is_superuser', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('role', 'string', [
                'default' => 'Usuario',
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('sites', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->create();

        $this->table('images')
            ->addForeignKey(
                'companie_id',
                'companies',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('social_accounts')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('images')
            ->dropForeignKey(
                'companie_id'
            );

        $this->table('social_accounts')
            ->dropForeignKey(
                'user_id'
            );

        $this->dropTable('addresses');
        $this->dropTable('cnaes');
        $this->dropTable('communications');
        $this->dropTable('communications_companies');
        $this->dropTable('communications_persons');
        $this->dropTable('companies');
        $this->dropTable('companies_networks');
        $this->dropTable('contacts');
        $this->dropTable('contacts_communications');
        $this->dropTable('cores');
        $this->dropTable('idcards');
        $this->dropTable('images');
        $this->dropTable('networks');
        $this->dropTable('networks_persons');
        $this->dropTable('persons');
        $this->dropTable('postcodes');
        $this->dropTable('provinces');
        $this->dropTable('regions');
        $this->dropTable('relationships');
        $this->dropTable('relationships_has_persons');
        $this->dropTable('roads');
        $this->dropTable('sedes');
        $this->dropTable('social_accounts');
        $this->dropTable('towns');
        $this->dropTable('townships');
        $this->dropTable('users');
    }
}
