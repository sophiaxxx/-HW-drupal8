<?php

namespace Drupal\Tests\migrate\Kernel;

use Drupal\migrate\Plugin\MigrationInterface;

/**
 * Tests migration status tracking.
 *
 * @group migrate
 */
class MigrateStatusTest extends MigrateTestBase {

  /**
   * Tests different connection types.
   */
  public function testStatus() {
    // Create a minimally valid migration.
    $definition = [
      'id' => 'migration_status_test',
      'migration_tags' => ['Testing'],
      'source' => ['plugin' => 'empty'],
      'destination' => [
        'plugin' => 'config',
        'config_name' => 'migrate_test.settings',
      ],
      'process' => ['foo' => 'bar'],
    ];
    $migration = \Drupal::service('plugin.manager.migration')->createStubMigration($definition);

    // Default status is idle.
    $status = $migration->getStatus();
    $this->assertIdentical($status, MigrationInterface::STATUS_IDLE);

    // Test setting and retrieving all known status values.
<<<<<<< HEAD
    $status_list = array(
=======
    $status_list = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      MigrationInterface::STATUS_IDLE,
      MigrationInterface::STATUS_IMPORTING,
      MigrationInterface::STATUS_ROLLING_BACK,
      MigrationInterface::STATUS_STOPPING,
      MigrationInterface::STATUS_DISABLED,
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($status_list as $status) {
      $migration->setStatus($status);
      $this->assertIdentical($migration->getStatus(), $status);
    }
  }

}
