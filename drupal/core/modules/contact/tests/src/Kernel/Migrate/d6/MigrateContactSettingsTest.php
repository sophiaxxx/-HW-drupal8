<?php

namespace Drupal\Tests\contact\Kernel\Migrate\d6;

<<<<<<< HEAD
use Drupal\config\Tests\SchemaCheckTestTrait;
=======
use Drupal\Tests\SchemaCheckTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * Upgrade variables to contact.settings.yml.
 *
 * @group migrate_drupal_6
 */
class MigrateContactSettingsTest extends MigrateDrupal6TestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  public static $modules = ['contact'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->executeMigrations(['contact_category', 'd6_contact_settings']);
  }

  /**
   * Tests migration of contact variables to contact.settings.yml.
   */
  public function testContactSettings() {
    $config = $this->config('contact.settings');
    $this->assertIdentical(TRUE, $config->get('user_default_enabled'));
    $this->assertIdentical(3, $config->get('flood.limit'));
    $this->assertIdentical('some_other_category', $config->get('default_form'));
    $this->assertConfigSchema(\Drupal::service('config.typed'), 'contact.settings', $config->get());
  }

}
