<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Http\Client;
use GeoAPI;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class PruebasController extends AppController
{
    public function geophp(){

        $this->autoRender = false;

        $geoapi = new GeoAPI(); //Nueva instancia de la librería

        $geoapi->setConfig("url", "http://apiv1.geoapi.es/");
        $geoapi->setConfig("type", "JSON");
        $geoapi->setConfig("key", "84ebd10c6201ad1935e0ff67794587927a69f0cf613e7675c7856772bdf17f14");
        $geoapi->setConfig("sandbox", 0);

        //Todas las comunidades
        $comunidades = $geoapi->comunidades([]);

        //Provincias: todos o según código comunidad
        $provincias = $geoapi->provincias([
            'CCOM' => '05' //Canarias
        ]);

        //Municipios:
        $municipios = $geoapi->municipios([
            'CPRO' => '38' //Santa Cruz de Tenerife
        ]);

        $poblaciones = $geoapi->poblaciones([
            'CPRO' => '38', //Santa Cruz de Tenerife
            'CMUM' => '001' //Adeje
        ]);

        $nucleos = $geoapi->nucleos([
            'CPRO' => '38', //Santa Cruz de Tenerife
            'CMUM' => '001', //Adeje
            'NENTSI50' => 'ARMEÑIME' //
        ]);

        $cpos = $geoapi->cps([
            'CPRO' => '38', //Santa Cruz de Tenerife
            'CMUM' => '001', //Adeje
            'CUN' => '0002202' //Armeñime (Nucleo)
        ]);

        $calles = $geoapi->calles([
            'CPRO' => '38', //Santa Cruz de Tenerife
            'CMUM' => '001', //Adeje
            'CUN' => '0002202', //Armeñime (Nucleo)
            'CPOS' => '38678' //Código postal
        ]);

        debug($comunidades);
    }



    public function impyme(){

        $db = ConnectionManager::get("impyme"); // name of your database connection
        $stmt = $db->execute("SELECT * FROM empresas WHERE es_vacio = 0"); //Query
        $values = $stmt->fetchAll('assoc');
        $data = [];

        //Import model Companies
        $this->loadModel('Companies');

        $error = 0;
        $saved = 0;

        foreach ($values as $key => $value) {
            //idcard_id
            switch ($value['tipo_documento']){
                case 'NIF':
                    $idcard = 1;
                    break;
                case 'NIE':
                    $idcard = 2;
                    break;
                case 'CIF':
                    $idcard = 3;
                    break;
                default:
                    $idcard = 6;
                    break;
            }

            //Company
            $aux = [
                'name' => null,
                'tradename' => $value['name'],
                'idcard_id' => $idcard,
                'identity_card' => $value['documento'],
                'email' => trim($value['email']),
                'description' => $value['observaciones'],
                'superficie_id' => $value['superficie_venta'],
                'company_id' => null, //siempre null porque no hay asociación
                'tag_count' => null,
                'created' => $value['creado'],
                'modified' => $value['modificado'],
                'empresa_id' => $value['empresa_id'],
                'actividad' => $value['Actividad']
            ];

            if ($value['IAE_manual']){
                //Concatenamos esta información a description.
                if ($aux['description']){
                    $aux['description'] = $aux['description'] . '<br/> IAE_Manual: ' . $value['IAE_manual'];
                }else{
                    $aux['description'] = 'IAE_Manual: ' .$value['IAE_manual'];
                }
            }

            //Addresses
            $addresses = [];

            $ubicacion_id = null;

            if ($value['tipo_ubicacion']){
                switch ($value['tipo_ubicacion']){
                    case 'AI':
                        $ubicacion_id = 1;
                        break;
                    case 'CC':
                        $ubicacion_id = 2;
                        break;
                    case 'PI':
                        $ubicacion_id = 6;
                        break;
                    default:
                        $ubicacion_id = null;
                }
            }

            $address = [];

            if ($value['direccion_numero']){
                $address['number'] = $value['direccion_numero'];
            }
            if ($value['direccion_bloque']){
                $address['block'] = $value['direccion_bloque'];
            }
            if ($value['direccion_piso']){
                $address['floor'] = $value['direccion_piso'];
            }
            if ($value['direccion_puerta']){
                $address['door'] = $value['direccion_puerta'];
            }
            if ($ubicacion_id){
                $address['ubicacion_id'] = $ubicacion_id;
            }
            if ($value['nombre_ubicacion']){
                if ($value['Direccion_manual']){
                    $address['ubicacion_name'] = $value['nombre_ubicacion'] . ' - ' . $value['Direccion_manual'];
                }else{
                    $address['ubicacion_name'] = $value['nombre_ubicacion'];
                }

            }elseif ($value['Direccion_manual']){
                $address['ubicacion_name'] = $value['Direccion_manual'];
            }

            if ($value['lat']){
                $address['lat'] = $value['lat'];
            }

            if ($value['lon']){
                $address['lon'] = $value['lon'];
            }

            if ($value['direccion_tipo_via']){
                $address['dtipo_via'] = $value['direccion_tipo_via'];
            }

            if ($value['direccion_via']){
                $address['dvia'] = $value['direccion_via'];
            }

            if ($value['direccion_cp']){
                $address['dcp'] = $value['direccion_cp'];
            }

            if ($value['direccion_entidad']){
                $address['dentidad'] = $value['direccion_entidad'];
            }

            if ($value['direccion_nucleo']){
                $address['dnucleo'] = $value['direccion_nucleo'];
            }

            if ($address){
                $address['is_migrated'] = true;

                array_push($addresses,$address);
            }

            if ($addresses) {
                $aux['addresses'] = $addresses;
            }


            //Contacts
            $contacts = [];
            if ($value['name_propietario']){
                array_push($contacts,['name' => $value['name_propietario'], 'position' => 'Propietario']);
            }

            if ($value['name_contacto']){
                array_push($contacts,['name' => $value['name_contacto'], 'position' => 'Contacto']);
            }

            if ($contacts){
                $aux['contacts'] = $contacts;
            }


            //Communications
            $communications = [];

            if ($value['telefono_comercio']){
                array_push($communications,['value' => $value['telefono_comercio'], 'communication_id' => '4']);
            }

            if ($value['telefono_movil']){
                array_push($communications,['value' => $value['telefono_movil'], 'communication_id' => '2']);
            }

            if ($value['telefono_particular']){
                array_push($communications,['value' => $value['telefono_particular'], 'communication_id' => '1']);
            }

            if ($communications){
                $aux['communications_companies'] = $communications;
            }


            //Networks
            $networks = [];

            if ($value['web']){
                array_push($networks,['url' => $value['web'], 'network_id' => '5']);
            }

            if ($value['facebook']){
                array_push($networks,['url' => $value['facebook'], 'network_id' => '1']);
            }

            if ($value['twitter']){
                array_push($networks,['url' => $value['twitter'], 'network_id' => '2']);
            }

            if ($value['instagram']){
                array_push($networks,['url' => $value['instagram'], 'network_id' => '3']);
            }

            if ($networks){
                $aux['companies_networks'] = $networks;
            }

            //Networks
            $horarios = [];

            if ($value['horario_texto']){
                array_push($horarios,['horario_texto' => $value['horario_texto']]);
            }

            if ($networks){
                $aux['timetables'] = $horarios;
            }


            $entity =    $this->Companies->newEntity();
            $entity = $this->Companies->patchEntity($entity,$aux,[
                'associated' => [
                    'Contacts',
                    'CommunicationsCompanies',
                    'CompaniesNetworks',
                    'TimeTables',
                    'Addresses'
                ]
            ]);


            if ($this->Companies->save($entity)) {
                $saved++;
            }else{

                debug($entity->errors());

                $error++;
                debug($entity->errors());
                debug($aux['empresa_id']);
            }
        }

        debug('Errores:' . $error);
        debug('Salvados:' . $saved);
        die();
    }

    //SELECT * FROM empresas WHERE empresa_id in (57,104,144,281,415,490,541,615,616)

    public function locales(){
        $db = ConnectionManager::get("impyme"); // name of your database connection
        $stmt = $db->execute("SELECT * FROM empresas WHERE es_vacio = 1"); //Query
        $values = $stmt->fetchAll('assoc');

        $data = [];

        //Import model Companies

        $this->loadModel('Locales');

        $error = 0;
        $saved = 0;

        foreach ($values as $key => $value) {

            //Company
            if (!$value['name']){
                $value['name'] = 'Local';
            }

            $aux = [
                'name' => $value['name'],
                'idcard_id' => null,
                'identity_card' => null,
                'email' => trim($value['email']),
                'description' => $value['observaciones'],
                'superficie_id' => $value['superficie_venta'],
                'tag_count' => null,
                'created' => $value['creado'],
                'modified' => $value['modificado'],
                'empresa_id' => $value['empresa_id'],
                'actividad' => $value['Actividad']
            ];

            //Addresses
            $addresses = [];

            $ubicacion_id = null;

            if ($value['tipo_ubicacion']){
                switch ($value['tipo_ubicacion']){
                    case 'AI':
                        $ubicacion_id = 1;
                        break;
                    case 'CC':
                        $ubicacion_id = 2;
                        break;
                    case 'PI':
                        $ubicacion_id = 6;
                        break;
                    default:
                        $ubicacion_id = null;
                }
            }

            $address = [];

            if ($value['direccion_numero']){
                $address['number'] = $value['direccion_numero'];
            }
            if ($value['direccion_bloque']){
                $address['block'] = $value['direccion_bloque'];
            }
            if ($value['direccion_piso']){
                $address['floor'] = $value['direccion_piso'];
            }
            if ($value['direccion_puerta']){
                $address['door'] = $value['direccion_puerta'];
            }
            if ($ubicacion_id){
                $address['ubicacion_id'] = $ubicacion_id;
            }
            if ($value['nombre_ubicacion']){
                if ($value['Direccion_manual']){
                    $address['ubicacion_name'] = $value['nombre_ubicacion'] . ' - ' . $value['Direccion_manual'];
                }else{
                    $address['ubicacion_name'] = $value['nombre_ubicacion'];
                }

            }elseif ($value['Direccion_manual']){
                $address['ubicacion_name'] = $value['Direccion_manual'];
            }

            if ($value['lat']){
                $address['lat'] = $value['lat'];
            }

            if ($value['lon']){
                $address['lon'] = $value['lon'];
            }

            if ($value['direccion_tipo_via']){
                $address['dtipo_via'] = $value['direccion_tipo_via'];
            }

            if ($value['direccion_via']){
                $address['dvia'] = $value['direccion_via'];
            }

            if ($value['direccion_cp']){
                $address['dcp'] = $value['direccion_cp'];
            }

            if ($value['direccion_entidad']){
                $address['dentidad'] = $value['direccion_entidad'];
            }

            if ($value['direccion_nucleo']){
                $address['dnucleo'] = $value['direccion_nucleo'];
            }

            if ($address){
                $address['is_migrated'] = true;

                array_push($addresses,$address);
            }

            if ($addresses) {
                $aux['addresses'] = $addresses;
            }


            //Communications
            $communications = [];

            if ($value['telefono_comercio']){
                array_push($communications,['value' => $value['telefono_comercio'], 'communication_id' => '4']);
            }

            if ($value['telefono_movil']){
                array_push($communications,['value' => $value['telefono_movil'], 'communication_id' => '2']);
            }

            if ($value['telefono_particular']){
                array_push($communications,['value' => $value['telefono_particular'], 'communication_id' => '1']);
            }

            if ($communications){
                $aux['communications_locales'] = $communications;
            }

            $entidad =    $this->Locales->newEntity();
            $entity = $this->Locales->patchEntity($entidad,$aux,[
                'associated' => [
                    'CommunicationsLocales',
                    'Addresses'
                ]
            ]);


            if ($this->Locales->save($entidad)) {
                $saved++;
            }else{

                debug($entity->errors());

                $error++;
                debug($entity->errors());
                debug($aux['empresa_id']);
            }
        }

        debug('Errores:' . $error);
        debug('Salvados:' . $saved);
        die();
    }
}



// in ('Adeje Casco', 'La Postura', 'Los Olivos', 'Las Torres', 'Las Nieves', 'El Galeón')
