<?php

namespace Drupal\Tests\migrate\Kernel;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests the migration plugin.
 *
 * @group migrate
 *
 * @coversDefaultClass \Drupal\migrate\Plugin\Migration
 */
class MigrationTest extends KernelTestBase {

  /**
   * Enable field because we are using one of its source plugins.
   *
   * @var array
   */
  public static $modules = ['migrate', 'field'];

  /**
   * Tests Migration::set().
   *
   * @covers ::set
   */
  public function testSetInvalidation() {
    $migration = \Drupal::service('plugin.manager.migration')->createStubMigration([
      'source' => ['plugin' => 'empty'],
      'destination' => ['plugin' => 'entity:entity_view_mode'],
    ]);
    $this->assertEqual('empty', $migration->getSourcePlugin()->getPluginId());
    $this->assertEqual('entity:entity_view_mode', $migration->getDestinationPlugin()->getPluginId());

    // Test the source plugin is invalidated.
<<<<<<< HEAD
    $migration->set('source', ['plugin' => 'd6_field']);
    $this->assertEqual('d6_field', $migration->getSourcePlugin()->getPluginId());
=======
    $migration->set('source', ['plugin' => 'embedded_data', 'data_rows' => [], 'ids' => []]);
    $this->assertEqual('embedded_data', $migration->getSourcePlugin()->getPluginId());
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test the destination plugin is invalidated.
    $migration->set('destination', ['plugin' => 'null']);
    $this->assertEqual('null', $migration->getDestinationPlugin()->getPluginId());
  }

}
