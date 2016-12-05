<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompaniesNetworks Controller
 *
 * @property \App\Model\Table\CompaniesNetworksTable $CompaniesNetworks
 */
class CompaniesNetworksController extends AppController
{

    /**
     * Delete method
     *
     * @param string|null $id Companies Network id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $companie_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $companiesNetwork = $this->CompaniesNetworks->get($id);
        if ($this->CompaniesNetworks->delete($companiesNetwork)) {
            $this->Flash->success(__('The companies network has been deleted.'));
        } else {
            $this->Flash->error(__('The companies network could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'companies','action' => 'edit', $companie_id, 'tab' => 'networks']);
    }
}
