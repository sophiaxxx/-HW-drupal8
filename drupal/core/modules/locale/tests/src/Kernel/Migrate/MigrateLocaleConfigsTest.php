<?php

namespace Drupal\Tests\locale\Kernel\Migrate;

<<<<<<< HEAD
use Drupal\config\Tests\SchemaCheckTestTrait;
=======
use Drupal\Tests\SchemaCheckTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * Upgrade variables to locale.settings.yml.
 *
 * @group migrate_drupal_6
 */
class MigrateLocaleConfigsTest extends MigrateDrupal6TestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('locale', 'language');
=======
  public static $modules = ['locale', 'language'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->executeMigration('locale_settings');
  }

  /**
   * Tests migration of locale variables to locale.settings.yml.
   */
  public function testLocaleSettings() {
    $config = $this->config('locale.settings');
    $this->assertIdentical(TRUE, $config->get('cache_strings'));
    $this->assertIdentical('languages', $config->get('javascript.directory'));
    $this->assertConfigSchema(\Drupal::service('config.typed'), 'locale.settings', $config->get());
  }

}
