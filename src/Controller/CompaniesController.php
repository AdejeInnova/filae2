<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Http\Client;

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
                return $this->redirect(['action' => 'edit', $company->id]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Company'));
            }
        }

        $idcards = $this->Companies->Idcards->find('list', ['limit' => 200]);
        $companies = $this->Companies->find('list', ['limit' => 200]);
        $superficies = Configure::read('Superficies');

        $this->set(compact('company', 'idcards', 'addresses', 'companies', 'superficies'));
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
            'contain' => [
                'Communications',
                'Networks',
                'Images',
                'Cnaes',
                'Tags',
                'Addresses',
                'Timetables',
                'Timetables.Openinghours',
                'Contacts'
            ]
        ]);

        //Control de la tab:
        if (isset($this->request->query['tab']) && !empty($this->request->query['tab'])){
            $tab = $this->request->query['tab'];
        }else{
            $tab = 'settings'; //Primera pesataña de la vista edit.ctp
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $company = $this->Companies->patchEntity($company, $this->request->data, [
                'associated' => [
                    'Images',
                    'CompaniesNetworks',
                    'CommunicationsCompanies',
                    'Tags',
                    'Addresses',
                    'Timetables',
                    'Timetables.Openinghours',
                    'Contacts'
                ]
            ]);

            /*debug($this->request->data);
            debug($company);
            die();*/

            $message = $company->dirty('images')?false:true;
            if ($this->Companies->save($company)) {
                if ($message){
                    $this->Flash->success(__('The {0} has been saved.', 'Company'));
                }
                return $this->redirect(['action' => 'edit', $id, 'tab' => $tab]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Company'));
            }
        }

        // tab:Datos
        $idcards = $this->Companies->Idcards->find('list', ['limit' => 200]);
        $companies = $this->Companies->find('list', ['limit' => 200]);
        $superficies = Configure::read('Superficies');


        $db = ConnectionManager::get("default"); // name of your database connection
        $stmt = $db->execute("SELECT * FROM tags_tags");
        $values = $stmt->fetchAll('assoc');
        $tags = [];
        foreach ($values as $tag){
            $tags[$tag['label']] = $tag['label'];
        }

        //tab: Media
        $images = [];
        $captions = [];

        $profile = 0;

        foreach ($company->images as $data):
            $file = '/files/images/photo/' . $data->get('photo_dir') . '/' . $data->get('photo');

            array_push($captions, [
                'caption' => $data->get('photo'),
                'size' => filesize(WWW_ROOT . $file),
                'width' => '120px',
                'key' => $data->get('id'),
                'extra' => [
                    'id' => $data->get('id')
                ]
            ]);

            array_push($images, '/filae2' . $file);

            if ($data->profile){
                $profile = $data->id;
            }
        endforeach;

        // tab:Communication
        //Networks
        $networks = $this->Companies->Networks->find('list');

        $communications = $this->Companies->Communications->find('list',['order' => ['Communications.name' => 'ASC']]);

        // tab:cnae
        $cnaes = $this->Companies->Cnaes->find('all');
        $cnaes->where(['companie_id' => $id]);
        $cnaes = $this->paginate($cnaes);

        //tab:addresses
        $ubicaciones = Configure::read('Ubicaciones');

        $this->set('images', $images);
        $this->set('profile_id', $profile);
        $this->set('captions', $captions);
        $this->set(
            compact(
                'company',
                'idcards',
                'companies',
                'tab',
                'cnaes',
                'networks',
                'communications',
                'superficies',
                'tags',
                'comunidades',
                'ubicaciones'
            )
        );
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


    public function deleteimage(){
        $this->request->allowMethod(['post', 'delete']);

        $this->loadModel('Images');

        //Key
        $key = $this->request->data['key'];

        //Image
        $image = $this->Images->get($key);

        //company_id
        $company_id = $image->companie_id;

        //Delete image reg
        if (!$this->Images->delete($image)) {
            $this->Flash->error(__('Could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'edit', $company_id]);

    }
}
