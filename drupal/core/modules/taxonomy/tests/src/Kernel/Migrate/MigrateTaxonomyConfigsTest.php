<?php

namespace Drupal\Tests\taxonomy\Kernel\Migrate;

<<<<<<< HEAD
use Drupal\config\Tests\SchemaCheckTestTrait;
=======
use Drupal\Tests\SchemaCheckTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * Upgrade variables to taxonomy.settings.yml.
 *
 * @group migrate_drupal_6
 */
class MigrateTaxonomyConfigsTest extends MigrateDrupal6TestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('taxonomy');
=======
  public static $modules = ['taxonomy'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->executeMigration('taxonomy_settings');
  }

  /**
   * Tests migration of taxonomy variables to taxonomy.settings.yml.
   */
  public function testTaxonomySettings() {
    $config = $this->config('taxonomy.settings');
    $this->assertIdentical(100, $config->get('terms_per_page_admin'));
    $this->assertIdentical(FALSE, $config->get('override_selector'));
    $this->assertConfigSchema(\Drupal::service('config.typed'), 'taxonomy.settings', $config->get());
  }

}
