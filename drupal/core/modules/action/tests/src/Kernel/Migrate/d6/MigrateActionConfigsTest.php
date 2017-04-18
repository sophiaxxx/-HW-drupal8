<?php

namespace Drupal\Tests\action\Kernel\Migrate\d6;

<<<<<<< HEAD
use Drupal\config\Tests\SchemaCheckTestTrait;
=======
use Drupal\Tests\SchemaCheckTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * Upgrade variables to action.settings.yml.
 *
 * @group migrate_drupal_6
 */
class MigrateActionConfigsTest extends MigrateDrupal6TestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  public static $modules = ['action'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
<<<<<<< HEAD
    $this->executeMigration('d6_action_settings');
=======
    $this->executeMigration('action_settings');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests migration of action variables to action.settings.yml.
   */
  public function testActionSettings() {
    $config = $this->config('action.settings');
    $this->assertIdentical(35, $config->get('recursion_limit'));
    $this->assertConfigSchema(\Drupal::service('config.typed'), 'action.settings', $config->get());
  }

}
