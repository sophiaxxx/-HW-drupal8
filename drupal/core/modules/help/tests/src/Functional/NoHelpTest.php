<?php

namespace Drupal\Tests\help\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Verify no help is displayed for modules not providing any help.
 *
 * @group help
 */
class NoHelpTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * Use one of the test modules that do not implement hook_help().
   *
   * @var array.
   */
<<<<<<< HEAD
  public static $modules = array('help', 'menu_test');
=======
  public static $modules = ['help', 'menu_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The user who will be created.
   */
  protected $adminUser;

  protected function setUp() {
    parent::setUp();
<<<<<<< HEAD
    $this->adminUser = $this->drupalCreateUser(array('access administration pages'));
=======
    $this->adminUser = $this->drupalCreateUser(['access administration pages']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Ensures modules not implementing help do not appear on admin/help.
   */
  public function testMainPageNoHelp() {
    $this->drupalLogin($this->adminUser);

    $this->drupalGet('admin/help');
    $this->assertResponse(200);
    $this->assertText('Module overviews are provided by modules');
    $this->assertFalse(\Drupal::moduleHandler()->implementsHook('menu_test', 'help'), 'The menu_test module does not implement hook_help');
    $this->assertNoText(\Drupal::moduleHandler()->getName('menu_test'), 'Making sure the test module menu_test does not display a help link on admin/help.');

    $this->drupalGet('admin/help/menu_test');
    $this->assertResponse(404, 'Getting a module overview help page for a module that does not implement hook_help() results in a 404.');
  }

}
