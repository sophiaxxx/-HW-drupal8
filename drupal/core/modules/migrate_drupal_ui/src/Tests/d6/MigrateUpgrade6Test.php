<?php

namespace Drupal\migrate_drupal_ui\Tests\d6;

use Drupal\migrate_drupal_ui\Tests\MigrateUpgradeTestBase;
use Drupal\user\Entity\User;

/**
 * Tests Drupal 6 upgrade using the migrate UI.
 *
 * The test method is provided by the MigrateUpgradeTestBase class.
 *
 * @group migrate_drupal_ui
 */
class MigrateUpgrade6Test extends MigrateUpgradeTestBase {

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->loadFixture(drupal_get_path('module', 'migrate_drupal') . '/tests/fixtures/drupal6.php');
  }

  /**
   * {@inheritdoc}
   */
  protected function getSourceBasePath() {
    return __DIR__ . '/files';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEntityCounts() {
    return [
      'aggregator_item' => 1,
      'aggregator_feed' => 1,
      'block' => 35,
      'block_content' => 2,
      'block_content_type' => 1,
      'comment' => 3,
      'comment_type' => 3,
      'contact_form' => 5,
      'configurable_language' => 5,
      'editor' => 2,
<<<<<<< HEAD
      'field_config' => 63,
      'field_storage_config' => 43,
=======
      'field_config' => 71,
      'field_storage_config' => 46,
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'file' => 7,
      'filter_format' => 7,
      'image_style' => 5,
      'language_content_settings' => 2,
      'migration' => 105,
<<<<<<< HEAD
      'node' => 10,
      'node_type' => 11,
      'rdf_mapping' => 5,
=======
      'node' => 11,
      'node_type' => 13,
      'rdf_mapping' => 7,
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'search_page' => 2,
      'shortcut' => 2,
      'shortcut_set' => 1,
      'action' => 22,
      'menu' => 8,
      'taxonomy_term' => 6,
      'taxonomy_vocabulary' => 6,
      'tour' => 4,
      'user' => 7,
      'user_role' => 6,
      'menu_link_content' => 4,
      'view' => 14,
      'date_format' => 11,
      'entity_form_display' => 19,
      'entity_form_mode' => 1,
      'entity_view_display' => 41,
      'entity_view_mode' => 14,
      'base_field_override' => 38,
    ];
  }

  /**
   * Executes all steps of migrations upgrade.
   */
<<<<<<< HEAD
  protected function testMigrateUpgrade() {
=======
  public function testMigrateUpgrade() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    parent::testMigrateUpgrade();

    // Ensure migrated users can log in.
    $user = User::load(2);
    $user->pass_raw = 'john.doe_pass';
    $this->drupalLogin($user);
  }

}
