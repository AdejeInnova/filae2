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

    public function apigoogle(){
        $this->viewBuilder()->layout('map');

    }
}
