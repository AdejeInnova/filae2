<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Openinghours Controller
 *
 * @property \App\Model\Table\OpeninghoursTable $Openinghours
 */
class OpeninghoursController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Timetables']
        ];
        $openinghours = $this->paginate($this->Openinghours);

        $this->set(compact('openinghours'));
        $this->set('_serialize', ['openinghours']);
    }

    /**
     * View method
     *
     * @param string|null $id Openinghour id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $openinghour = $this->Openinghours->get($id, [
            'contain' => ['Timetables']
        ]);

        $this->set('openinghour', $openinghour);
        $this->set('_serialize', ['openinghour']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($timetables_id = null, $company_id = null)
    {
        $openinghour = $this->Openinghours->newEntity();
        if ($this->request->is('post')) {
            $data = [
                'timetable_id' => $timetables_id,
                'start' => '12:00:00',
                'end' => '12:00:00'
            ];

            $openinghour = $this->Openinghours->patchEntity($openinghour, $data);
            if ($this->Openinghours->save($openinghour)) {
                //$this->Flash->success(__('The openinghour has been saved.'));

                return $this->redirect(['controller' => 'companies','action' => 'edit', $company_id, 'tab' => 'timetables']);
            } else {
                $this->Flash->error(__('The openinghour could not be saved. Please, try again.'));
            }
        }else{
            $this->Flash->error(__('The openinghour could not be saved. Please, try again.'));
            return $this->redirect(['controller' => 'company','action' => 'edit', $company_id, 'tab' => 'timetables']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Openinghour id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $openinghour = $this->Openinghours->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $openinghour = $this->Openinghours->patchEntity($openinghour, $this->request->data);
            if ($this->Openinghours->save($openinghour)) {
                $this->Flash->success(__('The openinghour has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The openinghour could not be saved. Please, try again.'));
            }
        }
        $timetables = $this->Openinghours->Timetables->find('list', ['limit' => 200]);
        $this->set(compact('openinghour', 'timetables'));
        $this->set('_serialize', ['openinghour']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Openinghour id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $company_id = null)
    {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $openinghour = $this->Openinghours->get($id);
        if ($this->Openinghours->delete($openinghour)) {
            //$this->Flash->success(__('The openinghour has been deleted.'));
        } else {
            $this->Flash->error(__('The openinghour could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'companies','action' => 'edit', $company_id, 'tab' => 'timetables']);
    }
}