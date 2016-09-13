<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Towns Controller
 *
 * @property \App\Model\Table\TownsTable $Towns
 */
class TownsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Townships']
        ];
        $towns = $this->paginate($this->Towns);

        $this->set(compact('towns'));
        $this->set('_serialize', ['towns']);
    }

    /**
     * View method
     *
     * @param string|null $id Town id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $town = $this->Towns->get($id, [
            'contain' => ['Townships', 'Addresses', 'Cores']
        ]);

        $this->set('town', $town);
        $this->set('_serialize', ['town']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $town = $this->Towns->newEntity();
        if ($this->request->is('post')) {
            $town = $this->Towns->patchEntity($town, $this->request->data);
            if ($this->Towns->save($town)) {
                $this->Flash->success(__('The {0} has been saved.', 'Town'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Town'));
            }
        }
        $townships = $this->Towns->Townships->find('list', ['limit' => 200]);
        $this->set(compact('town', 'townships'));
        $this->set('_serialize', ['town']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Town id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $town = $this->Towns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $town = $this->Towns->patchEntity($town, $this->request->data);
            if ($this->Towns->save($town)) {
                $this->Flash->success(__('The {0} has been saved.', 'Town'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Town'));
            }
        }
        $townships = $this->Towns->Townships->find('list', ['limit' => 200]);
        $this->set(compact('town', 'townships'));
        $this->set('_serialize', ['town']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Town id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $town = $this->Towns->get($id);
        if ($this->Towns->delete($town)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Town'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Town'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
