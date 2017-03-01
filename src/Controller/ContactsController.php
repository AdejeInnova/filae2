<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Hash;

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
    public function add($id = null, $table = null)
    {
        $contact = $this->Contacts->newEntity();

        if ($this->request->is('post')) {

            $contact = $this->Contacts->patchEntity($contact, $this->request->data,[
                'associated' => [
                    'Communications'
                ]
            ]);


            if ($this->Contacts->save($contact)) {
                return $this->redirect(['controller' => $table ,'action' => 'edit', $id, 'tab' => 'contacts']);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
                return $this->redirect(['controller' => $table,'action' => 'edit', $id, 'tab' => 'contacts']);
            }
        }

        $communications = $this->Contacts->Communications->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'id', 'communications', 'table'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    public function savejoin(){

        $data = [
            'name' => 'Rubén García',
            'position' => 'Programador',
            'email' => 'srubengt@gmail.com',
            'communications' => [
                [
                    'id' => '1',
                    '_joinData' => [
                        'id' => '8',
                        'value' => '987987685',
                        'delete' => '0'
                    ]
                ],
                [
                    'id' => '2',
                    '_joinData' =>
                    [
                        'id' => '9',
                        'value' => '654634532',
                        'delete' => '0'
                    ]
                ],
                [
                    'id' => '2',
                    '_joinData' =>
                        [
                            'value' => '620967270'
                        ]
                ]
            ]
        ];


        $id = 4;
        $contact = $this->Contacts->get($id, ['contain' => ['Communications']]);

        $contact = $this->Contacts->patchEntity($contact, $data, ['associated' => ['Communications']]);

        debug($data);
        debug($contact);
        die();
    }


    public function edit($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => ['Communications']
        ]);

        $table = $contact->companie_id?'companies':'locales';
        $table_id =  $contact->companie_id?$contact->companie_id:$contact->local_id;

        if ($this->request->is(['patch', 'post', 'put'])) {

            //Recorro las comunicaciones recibidas
            foreach ($this->request->data['communications'] as $key => $communication){
                //Compruebo que existe el campo delete
                if (Hash::check($communication['_joinData'],'delete')){
                    //Valido que sea igual a 1 (Eliminar)
                    if ($communication['_joinData']['delete'] === '1'){
                        $this->loadModel('CommunicationsContacts');
                        $entity = $this->CommunicationsContacts->get($communication['_joinData']['id']);
                        if($this->CommunicationsContacts->delete($entity)) {
                            //Eliminamos el item del reques->data
                            unset($this->request->data['communications'][$key]);
                        }
                    }

                }
            }


            $contact = $this->Contacts->patchEntity($contact, $this->request->data,
                [
                    'associated' => [
                        'Communications'
                    ]
                ]);


            /*debug($this->request->data);
            debug($contact);
            die();*/

            if ($this->Contacts->save($contact)) {
                return $this->redirect(['controller' => $table,'action' => 'edit', $table_id, 'tab' => 'contacts']);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
                return $this->redirect(['controller' => $table,'action' => 'edit', $table_id, 'tab' => 'contacts']);
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);

        $table = $contact->companie_id?'companies':'locales';
        $table_id =  $contact->companie_id?$contact->companie_id:$contact->local_id;

        if ($this->Contacts->delete($contact)) {
            //$this->Flash->success(__('The contact has been deleted.'));

        } else {
            //$this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => $table, 'action' => 'edit', $table_id, 'tab' => 'contacts']);
    }
}
