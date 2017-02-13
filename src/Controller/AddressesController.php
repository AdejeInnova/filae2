<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Addresses Controller
 *
 * @property \App\Model\Table\AddressesTable $Addresses
 */
class AddressesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roads', 'Towns', 'Persons']
        ];
        $addresses = $this->paginate($this->Addresses);

        $this->set(compact('addresses'));
        $this->set('_serialize', ['addresses']);
    }

    /**
     * View method
     *
     * @param string|null $id Address id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $address = $this->Addresses->get($id, [
            'contain' => ['Persons', 'Companies', 'Sedes']
        ]);

        $this->set('address', $address);
        $this->set('_serialize', ['address']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $address = $this->Addresses->newEntity();
        if ($this->request->is('post')) {
            $address = $this->Addresses->patchEntity($address, $this->request->data);
            if ($this->Addresses->save($address)) {
                $this->Flash->success(__('The {0} has been saved.', 'Address'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Address'));
            }
        }
        $roads = $this->Addresses->Roads->find('list', ['limit' => 200]);
        $towns = $this->Addresses->Towns->find('list', ['limit' => 200]);
        $persons = $this->Addresses->Persons->find('list', ['limit' => 200]);
        $this->set(compact('address', 'roads', 'towns', 'persons'));
        $this->set('_serialize', ['address']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Address id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $address = $this->Addresses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            debug($this->request->data);
            die();

            $address = $this->Addresses->patchEntity($address, $this->request->data);
            if ($this->Addresses->save($address)) {
                $this->Flash->success(__('The {0} has been saved.', 'Address'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Address'));
            }
        }
        $persons = $this->Addresses->Persons->find('list', ['limit' => 200]);
        $this->set(compact('address', 'persons'));
        $this->set('_serialize', ['address']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Address id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $companie_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $address = $this->Addresses->get($id);
        if ($this->Addresses->delete($address)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Address'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Address'));
        }

        if ($companie_id){
            return $this->redirect(['controller' => 'companies','action' => 'edit',$companie_id, 'tab' => 'addresses']);
        }

    }

    public function setdefault($id = null){
        $address = $this->Addresses->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['principal'] = true;

            $address = $this->Addresses->patchEntity($address, $this->request->data);

            if ($this->Addresses->save($address)) {
                $this->Flash->success(__('The {0} has been saved.', 'Address'));
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Address'));
            }

            return $this->redirect(['controller' => 'companies', 'action' => 'edit', $address->companie_id, 'tab' => 'addresses']);

        }
    }

}
