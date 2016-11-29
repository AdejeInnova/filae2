<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Http\Client;
use GeoAPI;
use App\Utility\NifCifNie;

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

        $this->set(compact('company', 'idcards', 'addresses', 'companies'));
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
            'contain' => ['Communications', 'Networks', 'Images']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $company = $this->Companies->patchEntity($company, $this->request->data);
            $message = $company->dirty('images')?false:true;

            if ($this->Companies->save($company)) {
                if ($message){
                    $this->Flash->success(__('The {0} has been saved.', 'Company'));
                    return $this->redirect(['action' => 'edit', $id]);
                }
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Company'));
            }
        }

        //Control de la tab:
        if (isset($this->request->query['tab']) && empty($this->request->query['tab'])){
            $tab = $this->request->query['tab'];
        }else{
            $tab = 'settings'; //Primera pesataña de la vista edit.ctp
        }

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

        $idcards = $this->Companies->Idcards->find('list', ['limit' => 200]);
        $companies = $this->Companies->find('list', ['limit' => 200]);

        $this->set('images', $images);
        $this->set('profile_id', $profile);
        $this->set('captions', $captions);
        $this->set(compact('company', 'idcards', 'companies', 'tab'));
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


    public function geophp(){
        $geoapi = new GeoAPI(); //Nueva instancia de la librería

        $geoapi->setConfig("url", "http://apiv1.geoapi.es/");
        $geoapi->setConfig("type", "JSON");
        $geoapi->setConfig("key", "84ebd10c6201ad1935e0ff67794587927a69f0cf613e7675c7856772bdf17f14");
        $geoapi->setConfig("sandbox", 0);

        //Todas las comunidades
        $comunidades = $geoapi->comunidades([]);
        //debug($comunidades);

        $provincias = $geoapi->provincias([
            'CCOM' => '05'
        ]);
        debug($provincias);

        die();
    }

    public function test()
    {
        //require_once(ROOT .DS. "Vendor" . DS  . "MyClass" . DS . "MyClass.php");

        $obj = new NifCifNie;
        //$document = '45704797W'; //NIF
        $document = '54668427A';
        $document = '46299827E';
        //$document = 'A38353801'; //CIF
        //$document = 'Y0189739A'; //NIE

        echo 'isValidIdNumber: </br>';
        debug($obj->isValidIdNumber($document));

        echo 'isValidNIF: </br>';
        debug($obj->isValidNIF($document));

        echo 'isValidNIE: </br>';
        debug($obj->isValidNIE($document));

        echo 'isValidCIF: </br>';
        debug($obj->isValidCIF($document));

        echo 'isValidNIFFormat </br>';
        debug($obj->isValidNIFFormat($document));

        echo 'isValidNIEFormat </br>';
        debug($obj->isValidNIEFormat($document));

        echo 'isValidCIFFormat </br>';
        debug($obj->isValidCIFFormat($document));

        echo 'getNIFCheckDigit </br>';
        debug($obj->getNIFCheckDigit($document));

        echo 'getCIFCheckDigit </br>';
        debug($obj->getCIFCheckDigit($document));

        echo 'getIdType </br>';
        debug($obj->getIdType($document));

        exit;
    }

    public function testCsv(){

        $content = 'data/cnae2009.csv';

        $data = $this->Companies->importCsv($content);

        //$cnaes = $this->paginate($data);

        debug($data);

        exit;
    }

}
