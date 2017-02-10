<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;

/**
 * Maps Controller
 *
 */
class MapsController extends AppController
{

    public function vermapa($id = null, $address_id = null){
        $this->viewBuilder()->layout('map');

        //Cargamos el Modelo de Direcciones
        $this->loadModel('Companies');

        //Obtenemos los datos de Companies según su id

        $company = $this->Companies->get($id,[
            'contain' => ['Addresses']
        ]);

        if ($address_id){
            foreach ($company->addresses as $addr){
                if ($addr->id == $address_id){
                    $address = $addr;
                }
            }
        }

        $this->set(compact('company', 'address'));
    }

    public function geolocalizar($id = null, $address_id = null){
        $this->viewBuilder()->layout('map');

        //Cargamos el Modelo de Direcciones
        $this->loadModel('Companies');

        //Obtenemos los datos de Companies según su id

        $company = $this->Companies->get($id,[
            'contain' => ['Addresses']
        ]);

        if ($this->request->is('post')) {

            $this->loadModel('Addresses');
            $a = $this->Addresses->get($address_id);

            $a = $this->Addresses->patchEntity($a, $this->request->data);

            if ($this->Addresses->save($a)) {
                return $this->redirect(['controller' => 'maps', 'action' => 'vermapa', $id, $address_id]);
            } else {
                $this->Flash->error(__('Error al guardar'));
            }
        }

        if ($address_id){
            foreach ($company->addresses as $addr){
                if ($addr->id == $address_id){
                    $address = $addr;
                }
            }
        }

        $this->set(compact('company', 'address'));
    }
}