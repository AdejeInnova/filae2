<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CommunicationsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CommunicationsController Test Case
 */
class CommunicationsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.communications',
        'app.companies',
        'app.idcards',
        'app.persons',
        'app.networks_persons',
        'app.networks',
        'app.companies_networks',
        'app.communications_persons',
        'app.addresses',
        'app.roads',
        'app.towns',
        'app.townships',
        'app.cores',
        'app.sedes',
        'app.cnaes',
        'app.contacts',
        'app.contacts_communications',
        'app.images',
        'app.communications_companies'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
