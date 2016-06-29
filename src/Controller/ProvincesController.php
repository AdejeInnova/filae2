<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Provinces Controller
 *
 * @property \App\Model\Table\ProvincesTable $Provinces
 */
class ProvincesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Regions']
        ];
        $provinces = $this->paginate($this->Provinces);

        $this->set(compact('provinces'));
        $this->set('_serialize', ['provinces']);
    }

    /**
     * View method
     *
     * @param string|null $id Province id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $province = $this->Provinces->get($id, [
            'contain' => ['Regions', 'Townships']
        ]);

        $this->set('province', $province);
        $this->set('_serialize', ['province']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $province = $this->Provinces->newEntity();
        if ($this->request->is('post')) {
            $province = $this->Provinces->patchEntity($province, $this->request->data);
            if ($this->Provinces->save($province)) {
                $this->Flash->success(__('The province has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The province could not be saved. Please, try again.'));
            }
        }
        $regions = $this->Provinces->Regions->find('list', ['limit' => 200]);
        $this->set(compact('province', 'regions'));
        $this->set('_serialize', ['province']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Province id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $province = $this->Provinces->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $province = $this->Provinces->patchEntity($province, $this->request->data);
            if ($this->Provinces->save($province)) {
                $this->Flash->success(__('The province has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The province could not be saved. Please, try again.'));
            }
        }
        $regions = $this->Provinces->Regions->find('list', ['limit' => 200]);
        $this->set(compact('province', 'regions'));
        $this->set('_serialize', ['province']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Province id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $province = $this->Provinces->get($id);
        if ($this->Provinces->delete($province)) {
            $this->Flash->success(__('The province has been deleted.'));
        } else {
            $this->Flash->error(__('The province could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
