<?php

namespace Drupal\views_ui\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Tests configuration schema against new views.
 *
 * @group views_ui
 */
class NewViewConfigSchemaTest extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['views_ui', 'node', 'comment', 'file', 'taxonomy', 'dblog', 'aggregator'];

  /**
   * Tests creating brand new views.
   */
  public function testNewViews() {
    $this->drupalLogin($this->drupalCreateUser(['administer views']));

    // Create views with all core Views wizards.
    $wizards = [
      // Wizard with their own classes.
      'node',
      'node_revision',
      'users',
      'comment',
      'file_managed',
      'taxonomy_term',
      'watchdog',
      // Standard derivative classes.
      'standard:aggregator_feed',
      'standard:aggregator_item',
<<<<<<< HEAD
    );
    foreach ($wizards as $wizard_key) {
      $edit = array();
=======
    ];
    foreach ($wizards as $wizard_key) {
      $edit = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $edit['label'] = $this->randomString();
      $edit['id'] = strtolower($this->randomMachineName());
      $edit['show[wizard_key]'] = $wizard_key;
      $edit['description'] = $this->randomString();
      $this->drupalPostForm('admin/structure/views/add', $edit, t('Save and edit'));
    }
  }

}
