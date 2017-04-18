<?php

namespace Drupal\KernelTests\Core\Config;

<<<<<<< HEAD
use Drupal\Core\Config\Schema\SchemaIncompleteException;
use Drupal\KernelTests\KernelTestBase;
=======
use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\Traits\Core\Config\SchemaConfigListenerTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

/**
 * Tests the functionality of ConfigSchemaChecker in KernelTestBase tests.
 *
 * @group config
 */
class SchemaConfigListenerTest extends KernelTestBase {

<<<<<<< HEAD
  /**
   * {@inheritdoc}
   */
  public static $modules = array('config_test');

  /**
   * Tests \Drupal\Core\Config\Testing\ConfigSchemaChecker.
   */
  public function testConfigSchemaChecker() {
    // Test a non-existing schema.
    $message = 'Expected SchemaIncompleteException thrown';
    try {
      $this->config('config_schema_test.schemaless')->set('foo', 'bar')->save();
      $this->fail($message);
    }
    catch (SchemaIncompleteException $e) {
      $this->pass($message);
      $this->assertEqual('No schema for config_schema_test.schemaless', $e->getMessage());
    }

    // Test a valid schema.
    $message = 'Unexpected SchemaIncompleteException thrown';
    $config = $this->config('config_test.types')->set('int', 10);
    try {
      $config->save();
      $this->pass($message);
    }
    catch (SchemaIncompleteException $e) {
      $this->fail($message);
    }

    // Test an invalid schema.
    $message = 'Expected SchemaIncompleteException thrown';
    $config = $this->config('config_test.types')
      ->set('foo', 'bar')
      ->set('array', 1);
    try {
      $config->save();
      $this->fail($message);
    }
    catch (SchemaIncompleteException $e) {
      $this->pass($message);
      $this->assertEqual('Schema errors for config_test.types with the following errors: config_test.types:foo missing schema, config_test.types:array variable type is integer but applied schema class is Drupal\Core\Config\Schema\Sequence', $e->getMessage());
    }
=======
  use SchemaConfigListenerTestTrait;

  /**
   * {@inheritdoc}
   */
  public static $modules = ['config_test'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    // Install configuration provided by the module so that the order of the
    // config keys is the same as
    // \Drupal\FunctionalTests\Core\Config\SchemaConfigListenerTest.
    $this->installConfig(['config_test']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
