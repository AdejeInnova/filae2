<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;

/**
 * Cnaes Controller
 *
 * @property \App\Model\Table\CnaesTable $Cnaes
 */
class CnaesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id)
    {

        //Obtengo los datos
        $content = 'data/cnae2009.csv';
        $data = $this->Cnaes->importCsv($content);
        $collection = new Collection($data);

        $cnaes = $collection->map(function ($cnae, $key) {
            if (strlen($cnae['cod_cnae2009']) == 1){
                $cnae['parent'] = null;
            }

            if (strlen($cnae['cod_cnae2009']) == 2){
                $cnae['parent'] = substr($cnae['codintegr'],0,-2);
            }

            if (strlen($cnae['cod_cnae2009']) == 3){
                $cnae['parent'] = substr($cnae['cod_cnae2009'],0,-1);
            }

            if (strlen($cnae['cod_cnae2009']) == 4){
                $cnae['parent'] = substr($cnae['cod_cnae2009'],0,-1);
            }
            return $cnae;
        });

        $breadcrumb = [];
        if (($this->request->is('POST')) && (!empty($this->request->data('search')))){
            $search = $this->request->data('search');
            //Filtro de los datos
            $filter = $cnaes->filter(function($registo, $key) use ($search){
                $pos = stripos(strtoupper($this->quitar_tildes($registo['titulo_cnae2009'])), strtoupper($this->quitar_tildes($search)));
                return ($pos === false)?false:true;
            });
        }else{
            $search = '';
            if (isset($this->request->query['cod_cnae'])){
                //Filtro de los datos
                $filter = $cnaes->filter(function($cnae, $key){
                    return $cnae['parent'] === $this->request->query['cod_cnae'];
                });

                //Construcción de las migas
                $cnae = $cnaes->filter(function($value, $key){
                    return $value['cod_cnae2009'] === $this->request->query['cod_cnae'];
                });

                switch (strlen($this->request->query['cod_cnae'])){
                    case 1:
                        array_push($breadcrumb,$cnae->toList());
                        break;
                    case 2:

                        $parent = $cnae->toList()[0]['parent'];
                        $temp = $cnaes->filter(function($value, $key) use ($parent){
                            return $value['cod_cnae2009'] === $parent;
                        });
                        array_push($breadcrumb,$temp->toList());


                        array_push($breadcrumb,$cnae->toList());
                        break;
                    case 3:
                        //Letra
                        $letra = substr($cnae->toList()[0]['codintegr'],0,1);
                        $temp = $cnaes->filter(function($value, $key) use ($letra){
                            return $value['cod_cnae2009'] === $letra;
                        });
                        array_push($breadcrumb,$temp->toList());

                        //Nivel 1
                        $parent = $cnae->toList()[0]['parent'];
                        $temp = $cnaes->filter(function($value, $key) use ($parent){
                            return $value['cod_cnae2009'] === $parent;
                        });
                        array_push($breadcrumb,$temp->toList());

                        //Nivel 2
                        array_push($breadcrumb,$cnae->toList());
                        break;
                }
            }else{
                //Filtro de la collection
                $filter = $cnaes->filter(function($cnae, $key){
                    return $cnae['parent'] === null;
                });
            }
        }


        //NEST -> estructula la collectión creando un árbol relacionado.
        //debug($cnaes->nest('cod_cnae2009', 'parent')->toArray());

        $company = $this->Cnaes->Companies->get($id);
        $q = $this->Cnaes->find('all')
            //->select(['cod_cnae'])
            ->where(['Cnaes.companie_id' => $id])
            ->toList()
        ;

        $cs = []; //Cnaes Save
        foreach ($q as $item) {

            array_push($cs, $item['cod_cnae']);
        }

        $this->set('cnaes_companies', $q);
        $this->set('company', $company);
        $this->set('cnaes_save', $cs);
        $this->set('search', $search);
        $this->set('cnaes', $filter);
        $this->set('breadcrumb', $breadcrumb);
    }


    function quitar_tildes($cadena) {
        $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
        $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        return $texto;
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */

    public function add($id)
    {
        $cnae = $this->Cnaes->newEntity();
        if ($this->request->is('post')) {
            if (isset($this->request->query['cnae'])) {
                $this->request->data['companie_id'] = $id;
                $this->request->data['cnae'] = $this->request->query['cnae'];
                $cnae = $this->Cnaes->patchEntity($cnae, $this->request->data);

                if ($this->Cnaes->save($cnae)) {
                    $this->Flash->success(__('The cnae has been saved.'));
                    return $this->redirect(['action' => 'index', $id, 'cod_cnae' => substr($cnae['cod_cnae'],0,strlen($cnae['cod_cnae'])-1)]);

                } else {
                    $this->Flash->error(__('The cnae could not be saved. Please, try again.'));
                    return $this->redirect(['action' => 'index', $id,'cod_cnae' => $cnae['cod_cnae']]);
                }
            }else{
                $this->Flash->error(__('Error'));
                return $this->redirect(['action' => 'index', $id]);
            }
        }else{
            $this->Flash->error(__('Error'));
            return $this->redirect(['action' => 'index', $id]);
        }
    }


    /**
     * Delete method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($companie_id = null, $cnae_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cnae = $this->Cnaes->get($cnae_id);
        $cod_cnae = $cnae->cod_cnae;

        if ($this->Cnaes->delete($cnae)) {
            $this->Flash->success(__('The Cnae has been deleted.'));
        } else {
            $this->Flash->error(__('The Cnae could not be deleted. Please, try again.'));
        }

        if (isset($this->request->query['origin']) && ($this->request->query['origin'] == 'cnaes')){
            return $this->redirect(['action' => 'index', $companie_id, 'cod_cnae' => substr($cod_cnae,0,strlen($cod_cnae)-1)]);
        }else{
            return $this->redirect(['controller' => 'companies','action' => 'edit', $companie_id, 'tab' => 'cnae']);
        }


    }
}
