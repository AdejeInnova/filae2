<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OpeninghoursTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OpeninghoursTable Test Case
 */
class OpeninghoursTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OpeninghoursTable
     */
    public $Openinghours;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.openinghours',
        'app.timetables',
        'app.companies',
        'app.idcards',
        'app.persons',
        'app.addresses',
        'app.sedes',
        'app.cnaes',
        'app.contacts',
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
        'app.tags_tagged'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Openinghours') ? [] : ['className' => 'App\Model\Table\OpeninghoursTable'];
        $this->Openinghours = TableRegistry::get('Openinghours', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Openinghours);

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
