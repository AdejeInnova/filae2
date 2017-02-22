<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ContactsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ContactsController Test Case
 */
class ContactsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contacts',
        'app.companies',
        'app.idcards',
        'app.persons',
        'app.addresses',
        'app.sedes',
        'app.cnaes',
        'app.images',
        'app.communications',
        'app.communications_companies',
        'app.communications_persons',
        'app.contacts_communications',
        'app.networks',
        'app.companies_networks',
        'app.networks_persons',
        'app.tagged',
        'app.companies_tags',
        'app.tags',
        'app.tags_tagged',
        'app.timetables',
        'app.openinghours'
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
