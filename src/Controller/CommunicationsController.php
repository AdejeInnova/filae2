<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Communications Controller
 *
 * @property \App\Model\Table\CommunicationsTable $Communications
 */
class CommunicationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $search = '';

        $query = $this->Communications->find('all',[
            //'order' => ['Communications.name' => 'ASC']
        ]);

        if ($this->request->is('POST') && (!empty($this->request->data['search']))){
            $search = $this->request->data['search'];
            $query->where(['Communications.name LIKE' => '%' . $search . '%']);
        }

        $communications = $this->paginate($query);

        $this->set(compact('communications'));
        $this->set('search', $search);
        $this->set('_serialize', ['communications']);
    }



    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $communication = $this->Communications->newEntity();
        if ($this->request->is('post')) {
            $communication = $this->Communications->patchEntity($communication, $this->request->data);
            if ($this->Communications->save($communication)) {
                $this->Flash->success(__('The {0} has been saved.', 'Communication'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Communication'));
            }
        }
        $this->set(compact('communication'));
        $this->set('_serialize', ['communication']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Communication id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $communication = $this->Communications->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $communication = $this->Communications->patchEntity($communication, $this->request->data);
            if ($this->Communications->save($communication)) {
                $this->Flash->success(__('The {0} has been saved.', 'Communication'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Communication'));
            }
        }
        $this->set(compact('communication'));
        $this->set('_serialize', ['communication']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Communication id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $communication = $this->Communications->get($id);
        if ($this->Communications->delete($communication)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Communication'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Communication'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
