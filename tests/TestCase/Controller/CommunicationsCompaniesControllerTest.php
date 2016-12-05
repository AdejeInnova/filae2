<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CommunicationsCompaniesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CommunicationsCompaniesController Test Case
 */
class CommunicationsCompaniesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.communications_companies',
        'app.communications',
        'app.companies',
        'app.idcards',
        'app.persons',
        'app.addresses',
        'app.roads',
        'app.towns',
        'app.townships',
        'app.cores',
        'app.sedes',
        'app.cnaes',
        'app.contacts',
        'app.images',
        'app.networks',
        'app.companies_networks',
        'app.networks_persons',
        'app.communications_persons',
        'app.contacts_communications'
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
