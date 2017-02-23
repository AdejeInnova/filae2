<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('addresses')
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
            ->addColumn('principal', 'boolean', [
                'comment' => 'Este campo es si la dirección es la dirección de la persona o empresa por defecto.',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('lat', 'string', [
                'comment' => 'latitud de ubicación.',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('lon', 'string', [
                'comment' => 'logintud de ubicación.',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('person_id', 'integer', [
                'comment' => 'id persona',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('companie_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('CCOM', 'string', [
                'comment' => 'Código Comunidad',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('COM', 'string', [
                'comment' => 'Nombre Comunidad',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('CPRO', 'string', [
                'comment' => 'Código Provincia',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('PRO', 'string', [
                'comment' => 'Nombre Provincia',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('CMUM', 'string', [
                'comment' => 'Código Municipio',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('DMUN50', 'string', [
                'comment' => 'Nombre Municipio',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('NENTSI50', 'string', [
                'comment' => 'Nombre Población',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('CUN', 'string', [
                'comment' => 'Código Núcleo',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('NNUCLE50', 'string', [
                'comment' => 'Nombre Núcleo',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('CPOS', 'string', [
                'comment' => 'Código Postal',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('CVIA', 'string', [
                'comment' => 'Código de La Vía (Nombre de la calle)',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('NVIAC', 'string', [
                'comment' => 'Nombre de la Vía - Calle.',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('TVIA', 'string', [
                'comment' => 'Tipo de Vía (Calle, Plaza, Ctra, ...)',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('ubicacion_id', 'integer', [
                'comment' => 'Id de array constant del bootstrap.php',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('ubicacion_name', 'string', [
                'comment' => 'Nombre de la Ubicación si procede',
                'default' => null,
                'limit' => 100,
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

        $this->table('cnaes')
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
            ->addColumn('cod_cnae', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('codintegr', 'string', [
                'comment' => 'CODINTEGR - Según csv cnae2009',
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('titulo_cnae', 'string', [
                'comment' => 'título cnae 2009',
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('companie_id', 'integer', [
                'comment' => 'id empresa',
                'default' => null,
                'limit' => 11,
                'null' => false,
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
            ->addColumn('class', 'string', [
                'default' => null,
                'limit' => 100,
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

        $this->table('communications_contacts')
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
            ->addColumn('email', 'string', [
                'comment' => 'Email de la empresa',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('description', 'text', [
                'comment' => 'observaciones
',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('superficie_id', 'integer', [
                'comment' => 'Id de array constant del bootstrap.php',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('company_id', 'integer', [
                'comment' => 'id de empresa padre',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('tag_count', 'integer', [
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
            ->addColumn('name', 'string', [
                'comment' => 'Nombre del contacto',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('position', 'string', [
                'comment' => 'cargo contacto',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('companie_id', 'integer', [
                'comment' => 'id empresa',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'comment' => 'Email contacto',
                'default' => null,
                'limit' => 100,
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
            ->addColumn('class', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
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

        $this->table('openinghours')
            ->addColumn('timetable_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('start', 'time', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('end', 'time', [
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

        $this->table('tags_tagged')
            ->addColumn('tag_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('fk_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('fk_table', 'string', [
                'default' => null,
                'limit' => 255,
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
            ->addIndex(
                [
                    'tag_id',
                    'fk_id',
                    'fk_table',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('tags_tags')
            ->addColumn('namespace', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('label', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('counter', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
                'signed' => false,
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
            ->addColumn('tag_key', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addIndex(
                [
                    'tag_key',
                    'label',
                    'namespace',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('timetables')
            ->addColumn('companie_id', 'integer', [
                'comment' => 'Id de la empresa relacionada',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('24hours', 'boolean', [
                'comment' => 'Identifica si la empresa tiene un horario de 24/7',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('days', 'string', [
                'comment' => 'String de días de apertura',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('day1', 'boolean', [
                'comment' => 'Lunes',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('day2', 'boolean', [
                'comment' => 'Martes',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('day3', 'boolean', [
                'comment' => 'Miércoles',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('day4', 'boolean', [
                'comment' => 'Jueves',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('day5', 'boolean', [
                'comment' => 'Viernes',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('day6', 'boolean', [
                'comment' => 'Sábado',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('day7', 'boolean', [
                'comment' => 'Domingo',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'fecha/hora creación',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'fecha/hora modificación',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
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
        $this->dropTable('communications_contacts');
        $this->dropTable('communications_persons');
        $this->dropTable('companies');
        $this->dropTable('companies_networks');
        $this->dropTable('contacts');
        $this->dropTable('cores');
        $this->dropTable('idcards');
        $this->dropTable('images');
        $this->dropTable('networks');
        $this->dropTable('networks_persons');
        $this->dropTable('openinghours');
        $this->dropTable('persons');
        $this->dropTable('postcodes');
        $this->dropTable('provinces');
        $this->dropTable('regions');
        $this->dropTable('relationships');
        $this->dropTable('relationships_has_persons');
        $this->dropTable('roads');
        $this->dropTable('sedes');
        $this->dropTable('social_accounts');
        $this->dropTable('tags_tagged');
        $this->dropTable('tags_tags');
        $this->dropTable('timetables');
        $this->dropTable('towns');
        $this->dropTable('townships');
        $this->dropTable('users');
    }
}
