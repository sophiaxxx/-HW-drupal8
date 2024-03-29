<?php

namespace Drupal\Tests\user\Kernel;

<<<<<<< HEAD
use Drupal\config\Tests\SchemaCheckTestTrait;
=======
use Drupal\Tests\SchemaCheckTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\KernelTests\KernelTestBase;
use Drupal\user\Entity\Role;

/**
 * Ensures the user action for adding and removing roles have valid config
 * schema.
 *
 * @group user
 */
class UserActionConfigSchemaTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('system', 'user');
=======
  public static $modules = ['system', 'user'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests whether the user action config schema are valid.
   */
<<<<<<< HEAD
  function testValidUserActionConfigSchema() {
    $rid = strtolower($this->randomMachineName(8));
    Role::create(array('id' => $rid))->save();
=======
  public function testValidUserActionConfigSchema() {
    $rid = strtolower($this->randomMachineName(8));
    Role::create(['id' => $rid])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test user_add_role_action configuration.
    $config = $this->config('system.action.user_add_role_action.' . $rid);
    $this->assertEqual($config->get('id'), 'user_add_role_action.' . $rid);
    $this->assertConfigSchema(\Drupal::service('config.typed'), $config->getName(), $config->get());

    // Test user_remove_role_action configuration.
    $config = $this->config('system.action.user_remove_role_action.' . $rid);
    $this->assertEqual($config->get('id'), 'user_remove_role_action.' . $rid);
    $this->assertConfigSchema(\Drupal::service('config.typed'), $config->getName(), $config->get());
  }

}
