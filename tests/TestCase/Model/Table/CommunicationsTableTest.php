<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunicationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunicationsTable Test Case
 */
class CommunicationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommunicationsTable
     */
    public $Communications;

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
        'app.addresses',
        'app.roads',
        'app.towns',
        'app.townships',
        'app.cores',
        'app.sedes',
        'app.cnaes',
        'app.contacts',
        'app.images',
        'app.communications_companies',
        'app.networks',
        'app.companies_networks',
        'app.networks_persons',
        'app.communications_persons',
        'app.contacts_communications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Communications') ? [] : ['className' => 'App\Model\Table\CommunicationsTable'];
        $this->Communications = TableRegistry::get('Communications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Communications);

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
}
