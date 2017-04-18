<?php

namespace Drupal\Tests\statistics\Kernel\Migrate\d6;

<<<<<<< HEAD
use Drupal\config\Tests\SchemaCheckTestTrait;
=======
use Drupal\Tests\SchemaCheckTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * Upgrade variables to statistics.settings.yml.
 *
 * @group migrate_drupal_6
 */
class MigrateStatisticsConfigsTest extends MigrateDrupal6TestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('statistics');
=======
  public static $modules = ['statistics'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
<<<<<<< HEAD
    $this->executeMigration('d6_statistics_settings');
=======
    $this->executeMigration('statistics_settings');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests migration of statistics variables to statistics.settings.yml.
   */
  public function testStatisticsSettings() {
    $config = $this->config('statistics.settings');
<<<<<<< HEAD
    $this->assertIdentical(FALSE, $config->get('access_log.enabled'));
    $this->assertIdentical(259200, $config->get('access_log.max_lifetime'));
    $this->assertIdentical(0, $config->get('count_content_views'));
=======
    $this->assertSame(1, $config->get('count_content_views'));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertConfigSchema(\Drupal::service('config.typed'), 'statistics.settings', $config->get());
  }

}
