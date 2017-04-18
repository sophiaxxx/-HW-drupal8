<?php

namespace Drupal\migrate_drupal_ui\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Tests that only user 1 can access the migrate UI.
 *
 * @group migrate_drupal_ui
 */
class MigrateAccessTest extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['migrate_drupal_ui'];

  /**
   * Tests that only user 1 can access the migrate UI.
   */
<<<<<<< HEAD
  protected function testAccess() {
    $this->drupalLogin($this->rootUser);
    $this->drupalGet('upgrade');
    $this->assertResponse(200);
    $this->assertText(t('Drupal Upgrade'));
=======
  public function testAccess() {
    $this->drupalLogin($this->rootUser);
    $this->drupalGet('upgrade');
    $this->assertResponse(200);
    $this->assertText(t('Upgrade'));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $user = $this->createUser(['administer software updates']);
    $this->drupalLogin($user);
    $this->drupalGet('upgrade');
    $this->assertResponse(403);
<<<<<<< HEAD
    $this->assertNoText(t('Drupal Upgrade'));
=======
    $this->assertNoText(t('Upgrade'));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
