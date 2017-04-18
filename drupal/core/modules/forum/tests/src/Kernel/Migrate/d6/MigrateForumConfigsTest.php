<?php

namespace Drupal\Tests\forum\Kernel\Migrate\d6;

<<<<<<< HEAD
use Drupal\config\Tests\SchemaCheckTestTrait;
=======
use Drupal\Tests\SchemaCheckTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * Upgrade variables to forum.settings.yml.
 *
 * @group migrate_drupal_6
 */
class MigrateForumConfigsTest extends MigrateDrupal6TestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('comment', 'forum', 'taxonomy');
=======
  public static $modules = ['comment', 'forum', 'taxonomy'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->executeMigration('d6_taxonomy_vocabulary');
    $this->executeMigration('d6_forum_settings');
  }

  /**
   * Tests migration of forum variables to forum.settings.yml.
   */
  public function testForumSettings() {
    $config = $this->config('forum.settings');
    $this->assertIdentical(15, $config->get('topics.hot_threshold'));
    $this->assertIdentical(25, $config->get('topics.page_limit'));
    $this->assertIdentical(1, $config->get('topics.order'));
    $this->assertIdentical('vocabulary_1_i_0_', $config->get('vocabulary'));
    // This is 'forum_block_num_0' in D6, but block:active:limit' in D8.
<<<<<<< HEAD
    $this->assertIdentical(5, $config->get('block.active.limit'));
    // This is 'forum_block_num_1' in D6, but 'block:new:limit' in D8.
    $this->assertIdentical(5, $config->get('block.new.limit'));
=======
    $this->assertSame(3, $config->get('block.active.limit'));
    // This is 'forum_block_num_1' in D6, but 'block:new:limit' in D8.
    $this->assertSame(4, $config->get('block.new.limit'));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertConfigSchema(\Drupal::service('config.typed'), 'forum.settings', $config->get());
  }

}
