<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunicationsContactsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunicationsContactsTable Test Case
 */
class CommunicationsContactsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommunicationsContactsTable
     */
    public $CommunicationsContacts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.communications_contacts',
        'app.communications',
        'app.companies',
        'app.idcards',
        'app.persons',
        'app.addresses',
        'app.sedes',
        'app.cnaes',
        'app.contacts',
        'app.contacts_communications',
        'app.images',
        'app.communications_companies',
        'app.networks',
        'app.companies_networks',
        'app.networks_persons',
        'app.tagged',
        'app.companies_tags',
        'app.tags',
        'app.tags_tagged',
        'app.timetables',
        'app.openinghours',
        'app.communications_persons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CommunicationsContacts') ? [] : ['className' => 'App\Model\Table\CommunicationsContactsTable'];
        $this->CommunicationsContacts = TableRegistry::get('CommunicationsContacts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommunicationsContacts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
