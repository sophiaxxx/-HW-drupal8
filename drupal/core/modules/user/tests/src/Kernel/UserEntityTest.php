<?php

namespace Drupal\Tests\user\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\user\Entity\User;
use Drupal\user\RoleInterface;

/**
 * Tests the user entity class.
 *
 * @group user
 * @see \Drupal\user\Entity\User
 */
class UserEntityTest extends KernelTestBase {

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

  /**
   * Tests some of the methods.
   *
   * @see \Drupal\user\Entity\User::getRoles()
   * @see \Drupal\user\Entity\User::addRole()
   * @see \Drupal\user\Entity\User::removeRole()
   */
  public function testUserMethods() {
    $role_storage = $this->container->get('entity.manager')->getStorage('user_role');
<<<<<<< HEAD
    $role_storage->create(array('id' => 'test_role_one'))->save();
    $role_storage->create(array('id' => 'test_role_two'))->save();
    $role_storage->create(array('id' => 'test_role_three'))->save();

    $values = array(
      'uid' => 1,
      'roles' => array('test_role_one'),
    );
=======
    $role_storage->create(['id' => 'test_role_one'])->save();
    $role_storage->create(['id' => 'test_role_two'])->save();
    $role_storage->create(['id' => 'test_role_three'])->save();

    $values = [
      'uid' => 1,
      'roles' => ['test_role_one'],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $user = User::create($values);

    $this->assertTrue($user->hasRole('test_role_one'));
    $this->assertFalse($user->hasRole('test_role_two'));
<<<<<<< HEAD
    $this->assertEqual(array(RoleInterface::AUTHENTICATED_ID, 'test_role_one'), $user->getRoles());
=======
    $this->assertEqual([RoleInterface::AUTHENTICATED_ID, 'test_role_one'], $user->getRoles());
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $user->addRole('test_role_one');
    $this->assertTrue($user->hasRole('test_role_one'));
    $this->assertFalse($user->hasRole('test_role_two'));
<<<<<<< HEAD
    $this->assertEqual(array(RoleInterface::AUTHENTICATED_ID, 'test_role_one'), $user->getRoles());
=======
    $this->assertEqual([RoleInterface::AUTHENTICATED_ID, 'test_role_one'], $user->getRoles());
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $user->addRole('test_role_two');
    $this->assertTrue($user->hasRole('test_role_one'));
    $this->assertTrue($user->hasRole('test_role_two'));
<<<<<<< HEAD
    $this->assertEqual(array(RoleInterface::AUTHENTICATED_ID, 'test_role_one', 'test_role_two'), $user->getRoles());
=======
    $this->assertEqual([RoleInterface::AUTHENTICATED_ID, 'test_role_one', 'test_role_two'], $user->getRoles());
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $user->removeRole('test_role_three');
    $this->assertTrue($user->hasRole('test_role_one'));
    $this->assertTrue($user->hasRole('test_role_two'));
<<<<<<< HEAD
    $this->assertEqual(array(RoleInterface::AUTHENTICATED_ID, 'test_role_one', 'test_role_two'), $user->getRoles());
=======
    $this->assertEqual([RoleInterface::AUTHENTICATED_ID, 'test_role_one', 'test_role_two'], $user->getRoles());
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $user->removeRole('test_role_one');
    $this->assertFalse($user->hasRole('test_role_one'));
    $this->assertTrue($user->hasRole('test_role_two'));
<<<<<<< HEAD
    $this->assertEqual(array(RoleInterface::AUTHENTICATED_ID, 'test_role_two'), $user->getRoles());
=======
    $this->assertEqual([RoleInterface::AUTHENTICATED_ID, 'test_role_two'], $user->getRoles());
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
