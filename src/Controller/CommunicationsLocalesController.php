<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CommunicationsLocales Controller
 *
 * @property \App\Model\Table\CommunicationsLocalesTable $CommunicationsLocales
 */
class CommunicationsLocalesController extends AppController
{
    /**
     * Delete method
     *
     * @param string|null $id Communications Locale id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $local_id = null)
    {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $communicationsLocal = $this->CommunicationsLocales->get($id);
        if ($this->CommunicationsLocales->delete($communicationsLocal)) {
            //$this->Flash->success(__('The communications local has been deleted.'));
        } else {
            //$this->Flash->error(__('The communications company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'locales','action' => 'edit',$local_id, 'tab' => 'communications']);
    }
}
