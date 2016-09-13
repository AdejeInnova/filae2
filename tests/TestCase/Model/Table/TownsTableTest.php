<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TownsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TownsTable Test Case
 */
class TownsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TownsTable
     */
    public $Towns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.towns',
        'app.townships',
        'app.addresses',
        'app.cores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Towns') ? [] : ['className' => 'App\Model\Table\TownsTable'];
        $this->Towns = TableRegistry::get('Towns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Towns);

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
