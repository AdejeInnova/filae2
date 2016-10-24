<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Idcards', 'Addresses']
        ];
        $companies = $this->paginate($this->Companies);

        $this->set(compact('companies'));
        $this->set('_serialize', ['companies']);
    }

    /**
     * View method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => ['Idcards', 'Addresses', 'Communications', 'Networks', 'Companies', 'Cnaes', 'Contacts', 'Sedes']
        ]);

        $this->set('company', $company);
        $this->set('_serialize', ['company']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $company = $this->Companies->newEntity();
        if ($this->request->is('post')) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The {0} has been saved.', 'Company'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Company'));
            }
        }
        $idcards = $this->Companies->Idcards->find('list', ['limit' => 200]);
        $addresses = $this->Companies->Addresses->find('list', ['limit' => 200]);
        $communications = $this->Companies->Communications->find('list', ['limit' => 200]);
        $networks = $this->Companies->Networks->find('list', ['limit' => 200]);
        $this->set(compact('company', 'idcards', 'addresses', 'communications', 'networks'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => ['Communications', 'Networks']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The {0} has been saved.', 'Company'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Company'));
            }
        }
        $idcards = $this->Companies->Idcards->find('list', ['limit' => 200]);
        $addresses = $this->Companies->Addresses->find('list', ['limit' => 200]);
        $communications = $this->Companies->Communications->find('list', ['limit' => 200]);
        $networks = $this->Companies->Networks->find('list', ['limit' => 200]);
        $this->set(compact('company', 'idcards', 'addresses', 'communications', 'networks'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $company = $this->Companies->get($id);
        if ($this->Companies->delete($company)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Company'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Company'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
