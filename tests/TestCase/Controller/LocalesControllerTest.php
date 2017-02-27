<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LocalesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LocalesController Test Case
 */
class LocalesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.locales',
        'app.superficies',
        'app.communications',
        'app.companies',
        'app.idcards',
        'app.persons',
        'app.networks_persons',
        'app.networks',
        'app.companies_networks',
        'app.communications_persons',
        'app.addresses',
        'app.sedes',
        'app.cnaes',
        'app.contacts',
        'app.communications_contacts',
        'app.images',
        'app.communications_companies',
        'app.tagged',
        'app.companies_tags',
        'app.tags',
        'app.tags_tagged',
        'app.timetables',
        'app.openinghours',
        'app.communications_locales'
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
