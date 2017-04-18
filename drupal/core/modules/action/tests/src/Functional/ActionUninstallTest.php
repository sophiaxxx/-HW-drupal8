<?php

namespace Drupal\Tests\action\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests that uninstalling actions does not remove other module's actions.
 *
 * @group action
 * @see \Drupal\action\Plugin\views\field\BulkForm
 */
class ActionUninstallTest extends BrowserTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('views', 'action');
=======
  public static $modules = ['views', 'action'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests Action uninstall.
   */
  public function testActionUninstall() {
<<<<<<< HEAD
    \Drupal::service('module_installer')->uninstall(array('action'));

    $this->assertTrue(entity_load('action', 'user_block_user_action', TRUE), 'Configuration entity \'user_block_user_action\' still exists after uninstalling action module.' );

    $admin_user = $this->drupalCreateUser(array('administer users'));
=======
    \Drupal::service('module_installer')->uninstall(['action']);

    $storage = $this->container->get('entity_type.manager')->getStorage('action');
    $storage->resetCache(['user_block_user_action']);
    $this->assertTrue($storage->load('user_block_user_action'), 'Configuration entity \'user_block_user_action\' still exists after uninstalling action module.' );

    $admin_user = $this->drupalCreateUser(['administer users']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->drupalLogin($admin_user);

    $this->drupalGet('admin/people');
    // Ensure we have the user_block_user_action listed.
    $this->assertRaw('<option value="user_block_user_action">Block the selected user(s)</option>');

  }

}
