<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

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
        $search = '';

        $query = $this->Locales->find('all',[
                'contain' => ['Communications'],
                'order' => ['Locales.name' => 'ASC']
            ]
        );

        if ($this->request->is('POST')){
            $search = $this->request->data['search'];

            $query
                ->where(['Locales.name LIKE' => '%' . $search . '%'])
            ;

        }


        $locales = $this->paginate($query);


        $superficies = Configure::read('Superficies');

        $this->set(compact('locales','superficies', 'search'));
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
        $local = $this->Locales->newEntity();
        if ($this->request->is('post')) {
            $locale = $this->Locales->patchEntity($local, $this->request->data);
            if ($this->Locales->save($locale)) {
                $this->Flash->success(__('The {0} has been saved.', 'Locale'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Locale'));
            }
        }
        $communications = $this->Locales->Communications->find('list', ['limit' => 200]);
        $superficies = Configure::read('Superficies');

        $this->loadModel('Tags_tags');
        $ltags = $this->Tags_tags->find('all');
        $ltags
            ->select(['label'])
            ->where(['namespace' => 'locales'])
            ->order(['label'])
        ;

        //Creamos array adaptado para el select2 tags
        $tags =[];
        foreach ($ltags as $ltag){
            $tags[$ltag->label] = $ltag->label;
        }

        $this->set(compact('local', 'communications', 'superficies', 'tags'));
        $this->set('_serialize', ['local']);
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
        $local = $this->Locales->get($id, [
            'contain' => [
                'Images',
                'Communications',
                'Images',
                'Tags',
                'Addresses',
                'Contacts',
                'Contacts.Communications'
            ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $locale = $this->Locales->patchEntity($local, $this->request->data,[
                'associated' => [
                    'Images',
                    'Communications',
                    'Images',
                    'Tags',
                    'Addresses',
                    'Contacts',
                    'Contacts.Communications'
                ]
            ]);
            if ($this->Locales->save($locale)) {
                $this->Flash->success(__('The {0} has been saved.', 'Locale'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Locale'));
            }
        }

        $tab = 'settings';

        $superficies = Configure::read('Superficies');
        $communications = $this->Locales->Communications->find('list', ['limit' => 200]);

        $this->loadModel('Tags_tags');
        $tags = $this->Tags_tags->find('all');
        $tags
            ->select(['label'])
            ->where(['namespace' => 'locales'])
            ->order(['label'])
        ;

        $ubicaciones = Configure::read('Ubicaciones');

        //tab: Media
        $images = [];
        $captions = [];

        $profile = 0;

        foreach ($local->images as $image):
            $file = '/files/images/photo/' . $image->get('photo_dir') . '/' . $image->get('photo');

            array_push($captions, [
                'caption' => $image->get('photo'),
                'size' => filesize(WWW_ROOT . $file),
                'width' => '120px',
                'key' => $image->get('id'),
                'extra' => [
                    'id' => $image->get('id')
                ]
            ]);

            array_push($images, '/filae2' . $file);

            if ($image->profile){
                $profile = $image->id;
            }
        endforeach;


        $this->set('images', $images);
        $this->set('profile_id', $profile);
        $this->set('captions', $captions);

        $this->set(compact(
            'local',
            'superficies',
            'communications',
            'tags',
            'ubicaciones',
            'tab'
        ));
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
