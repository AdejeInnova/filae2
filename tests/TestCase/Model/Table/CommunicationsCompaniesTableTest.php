<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunicationsCompaniesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunicationsCompaniesTable Test Case
 */
class CommunicationsCompaniesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommunicationsCompaniesTable
     */
    public $CommunicationsCompanies;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CommunicationsCompanies') ? [] : ['className' => 'App\Model\Table\CommunicationsCompaniesTable'];
        $this->CommunicationsCompanies = TableRegistry::get('CommunicationsCompanies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommunicationsCompanies);

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
