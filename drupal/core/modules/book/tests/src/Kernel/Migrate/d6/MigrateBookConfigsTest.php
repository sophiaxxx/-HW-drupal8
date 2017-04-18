<?php

namespace Drupal\Tests\book\Kernel\Migrate\d6;

<<<<<<< HEAD
use Drupal\config\Tests\SchemaCheckTestTrait;
=======
use Drupal\Tests\SchemaCheckTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * Upgrade variables to book.settings.yml.
 *
 * @group migrate_drupal_6
 */
class MigrateBookConfigsTest extends MigrateDrupal6TestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  public static $modules = ['book'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->executeMigration('d6_book_settings');
  }

  /**
   * Tests migration of book variables to book.settings.yml.
   */
  public function testBookSettings() {
    $config = $this->config('book.settings');
    $this->assertIdentical('book', $config->get('child_type'));
<<<<<<< HEAD
    $this->assertIdentical('all pages', $config->get('block.navigation.mode'));
    $this->assertIdentical(array('book'), $config->get('allowed_types'));
=======
    $this->assertSame('book pages', $config->get('block.navigation.mode'));
    $this->assertIdentical(['book'], $config->get('allowed_types'));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertConfigSchema(\Drupal::service('config.typed'), 'book.settings', $config->get());
  }

}
