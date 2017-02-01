<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Networks Controller
 *
 * @property \App\Model\Table\NetworksTable $Networks
 */
class NetworksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $networks = $this->paginate($this->Networks);

        $this->set(compact('networks'));
        $this->set('_serialize', ['networks']);
    }

    /**
     * View method
     *
     * @param string|null $id Network id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $network = $this->Networks->get($id, [
            'contain' => ['Companies', 'Persons']
        ]);

        $this->set('network', $network);
        $this->set('_serialize', ['network']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $network = $this->Networks->newEntity();
        if ($this->request->is('post')) {
            $network = $this->Networks->patchEntity($network, $this->request->data);
            if ($this->Networks->save($network)) {
                $this->Flash->success(__('The {0} has been saved.', 'Network'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Network'));
            }
        }
        $this->set(compact('network'));
        $this->set('_serialize', ['network']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Network id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $network = $this->Networks->get($id, [
            'contain' => ['Companies', 'Persons']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $network = $this->Networks->patchEntity($network, $this->request->data);
            if ($this->Networks->save($network)) {
                $this->Flash->success(__('The {0} has been saved.', 'Network'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Network'));
            }
        }
        $this->set(compact('network', 'companies'));
        $this->set('_serialize', ['network']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Network id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $network = $this->Networks->get($id);
        if ($this->Networks->delete($network)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Network'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Network'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
