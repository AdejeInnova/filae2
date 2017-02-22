<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController
{


    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => ['Companies', 'Communications']
        ]);

        $this->set('contact', $contact);
        $this->set('_serialize', ['contact']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($company_id = null)
    {
        $contact = $this->Contacts->newEntity();

        if ($this->request->is('post')) {


            $contact = $this->Contacts->patchEntity($contact, $this->request->data,[
                'associated' => [
                    'Communications'
                ]
            ]);

            /*debug($this->request->data);
            debug($contact);
            die();*/

            $contact = $this->Contacts->patchEntity($contact, $this->request->data);

            if ($this->Contacts->save($contact)) {
                return $this->redirect(['controller' => 'companies','action' => 'edit', $company_id, 'tab' => 'contacts']);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
                return $this->redirect(['controller' => 'companies','action' => 'edit', $company_id, 'tab' => 'contacts']);
            }
        }

        $communications = $this->Contacts->Communications->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'company_id', 'communications'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => ['Communications']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->data,
                [
                    'associated' => [
                        'Communications',
                        'CommunicationsContacts',
                    ]
                ]);
            /*debug($this->request->data);
            debug($contact);
            die();*/

            if ($this->Contacts->save($contact)) {
                return $this->redirect(['controller' => 'companies','action' => 'edit', $contact->companie_id, 'tab' => 'contacts']);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
                return $this->redirect(['controller' => 'companies','action' => 'edit', $contact->companie_id, 'tab' => 'contacts']);
            }
        }

        $communications = $this->Contacts->Communications->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'communications'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $company_id = nul)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            //$this->Flash->success(__('The contact has been deleted.'));

        } else {
            //$this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'companies', 'action' => 'edit', $company_id, 'tab' => 'contacts']);
    }
}
