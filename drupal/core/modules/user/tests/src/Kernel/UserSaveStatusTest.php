<?php

namespace Drupal\Tests\user\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\user\Entity\User;

/**
 * Tests user saving status.
 *
 * @group user
 */
class UserSaveStatusTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('system', 'user', 'field');
=======
  public static $modules = ['system', 'user', 'field'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('user');
  }

  /**
   * Test SAVED_NEW and SAVED_UPDATED statuses for user entity type.
   */
<<<<<<< HEAD
  function testUserSaveStatus() {
    // Create a new user.
    $values = array(
      'uid' => 1,
      'name' => $this->randomMachineName(),
    );
=======
  public function testUserSaveStatus() {
    // Create a new user.
    $values = [
      'uid' => 1,
      'name' => $this->randomMachineName(),
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $user = User::create($values);

    // Test SAVED_NEW.
    $return = $user->save();
    $this->assertEqual($return, SAVED_NEW, "User was saved with SAVED_NEW status.");

    // Test SAVED_UPDATED.
    $user->name = $this->randomMachineName();
    $return = $user->save();
    $this->assertEqual($return, SAVED_UPDATED, "User was saved with SAVED_UPDATED status.");
  }

}
