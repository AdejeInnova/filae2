<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Idcards Controller
 *
 * @property \App\Model\Table\IdcardsTable $Idcards
 */
class IdcardsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $idcards = $this->paginate($this->Idcards);

        $this->set(compact('idcards'));
        $this->set('_serialize', ['idcards']);
    }

    /**
     * View method
     *
     * @param string|null $id Idcard id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $idcard = $this->Idcards->get($id, [
            'contain' => ['Companies', 'Persons']
        ]);

        $this->set('idcard', $idcard);
        $this->set('_serialize', ['idcard']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $idcard = $this->Idcards->newEntity();
        if ($this->request->is('post')) {
            $idcard = $this->Idcards->patchEntity($idcard, $this->request->data);
            if ($this->Idcards->save($idcard)) {
                $this->Flash->success(__('The {0} has been saved.', 'Idcard'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Idcard'));
            }
        }
        $this->set(compact('idcard'));
        $this->set('_serialize', ['idcard']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Idcard id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $idcard = $this->Idcards->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $idcard = $this->Idcards->patchEntity($idcard, $this->request->data);
            if ($this->Idcards->save($idcard)) {
                $this->Flash->success(__('The {0} has been saved.', 'Idcard'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Idcard'));
            }
        }
        $this->set(compact('idcard'));
        $this->set('_serialize', ['idcard']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Idcard id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $idcard = $this->Idcards->get($id);
        if ($this->Idcards->delete($idcard)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Idcard'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Idcard'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
