<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CommunicationsCompanies Controller
 *
 * @property \App\Model\Table\CommunicationsCompaniesTable $CommunicationsCompanies
 */
class CommunicationsCompaniesController extends AppController
{
    /**
     * Delete method
     *
     * @param string|null $id Communications Company id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $companie_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $communicationsCompany = $this->CommunicationsCompanies->get($id);
        if ($this->CommunicationsCompanies->delete($communicationsCompany)) {
            $this->Flash->success(__('The communications company has been deleted.'));
        } else {
            $this->Flash->error(__('The communications company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'companies','action' => 'edit',$companie_id, 'tab' => 'communications']);
    }
}
