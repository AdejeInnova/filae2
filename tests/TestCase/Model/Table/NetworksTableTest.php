<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NetworksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NetworksTable Test Case
 */
class NetworksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NetworksTable
     */
    public $Networks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.networks',
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
        'app.communications',
        'app.communications_companies',
        'app.companies_networks',
        'app.networks_persons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Networks') ? [] : ['className' => 'App\Model\Table\NetworksTable'];
        $this->Networks = TableRegistry::get('Networks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Networks);

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
