<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Locales Controller
 *
 * @property \App\Model\Table\LocalesTable $Locales
 */
class LocalesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate;
        $locales = $this->paginate($this->Locales);

        $this->set(compact('locales'));
        $this->set('_serialize', ['locales']);
    }

    /**
     * View method
     *
     * @param string|null $id Locale id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $locale = $this->Locales->get($id);

        $this->set('locale', $locale);
        $this->set('_serialize', ['locale']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $locale = $this->Locales->newEntity();
        if ($this->request->is('post')) {
            $locale = $this->Locales->patchEntity($locale, $this->request->data);
            if ($this->Locales->save($locale)) {
                $this->Flash->success(__('The {0} has been saved.', 'Locale'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Locale'));
            }
        }
        $communications = $this->Locales->Communications->find('list', ['limit' => 200]);
        $this->set(compact('locale', 'communications'));
        $this->set('_serialize', ['locale']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Locale id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $locale = $this->Locales->get($id, [
            'contain' => ['Communications']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $locale = $this->Locales->patchEntity($locale, $this->request->data);
            if ($this->Locales->save($locale)) {
                $this->Flash->success(__('The {0} has been saved.', 'Locale'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Locale'));
            }
        }
        $superficies = $this->Locales->Superficies->find('list', ['limit' => 200]);
        $communications = $this->Locales->Communications->find('list', ['limit' => 200]);
        $this->set(compact('locale', 'superficies', 'communications'));
        $this->set('_serialize', ['locale']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Locale id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $locale = $this->Locales->get($id);
        if ($this->Locales->delete($locale)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Locale'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Locale'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
