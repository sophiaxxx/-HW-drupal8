<?php

namespace Drupal\Tests\user\Kernel\Views;

use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Tests\ViewTestData;

/**
 * Provides a common test base for user views tests.
 */
abstract class UserKernelTestBase extends ViewsKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('user_test_views', 'user', 'system', 'field');
=======
  public static $modules = ['user_test_views', 'user', 'system', 'field'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Users to use during this test.
   *
   * @var array
   */
<<<<<<< HEAD
  protected $users = array();
=======
  protected $users = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The entity storage for roles.
   *
   * @var \Drupal\user\RoleStorage
   */
  protected $roleStorage;

  /**
   * The entity storage for users.
   *
   * @var \Drupal\user\UserStorage
   */
  protected $userStorage;

  protected function setUp($import_test_views = TRUE) {
    parent::setUp();

<<<<<<< HEAD
    ViewTestData::createTestViews(get_class($this), array('user_test_views'));
=======
    ViewTestData::createTestViews(get_class($this), ['user_test_views']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->installEntitySchema('user');

    $entity_manager = $this->container->get('entity.manager');
    $this->roleStorage = $entity_manager->getStorage('user_role');
    $this->userStorage = $entity_manager->getStorage('user');
  }

  /**
   * Set some test data for permission related tests.
   */
  protected function setupPermissionTestData() {
    // Setup a role without any permission.
<<<<<<< HEAD
    $this->roleStorage->create(array('id' => 'authenticated'))
      ->save();
    $this->roleStorage->create(array('id' => 'no_permission'))
      ->save();
    // Setup a role with just one permission.
    $this->roleStorage->create(array('id' => 'one_permission'))
      ->save();
    user_role_grant_permissions('one_permission', array('administer permissions'));
    // Setup a role with multiple permissions.
    $this->roleStorage->create(array('id' => 'multiple_permissions'))
      ->save();
    user_role_grant_permissions('multiple_permissions', array('administer permissions', 'administer users', 'access user profiles'));
=======
    $this->roleStorage->create(['id' => 'authenticated'])
      ->save();
    $this->roleStorage->create(['id' => 'no_permission'])
      ->save();
    // Setup a role with just one permission.
    $this->roleStorage->create(['id' => 'one_permission'])
      ->save();
    user_role_grant_permissions('one_permission', ['administer permissions']);
    // Setup a role with multiple permissions.
    $this->roleStorage->create(['id' => 'multiple_permissions'])
      ->save();
    user_role_grant_permissions('multiple_permissions', ['administer permissions', 'administer users', 'access user profiles']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Setup a user without an extra role.
    $this->users[] = $account = $this->userStorage->create(['name' => $this->randomString()]);
    $account->save();
    // Setup a user with just the first role (so no permission beside the
    // ones from the authenticated role).
<<<<<<< HEAD
    $this->users[] = $account = $this->userStorage->create(array('name' => 'first_role'));
    $account->addRole('no_permission');
    $account->save();
    // Setup a user with just the second role (so one additional permission).
    $this->users[] = $account = $this->userStorage->create(array('name' => 'second_role'));
    $account->addRole('one_permission');
    $account->save();
    // Setup a user with both the second and the third role.
    $this->users[] = $account = $this->userStorage->create(array('name' => 'second_third_role'));
=======
    $this->users[] = $account = $this->userStorage->create(['name' => 'first_role']);
    $account->addRole('no_permission');
    $account->save();
    // Setup a user with just the second role (so one additional permission).
    $this->users[] = $account = $this->userStorage->create(['name' => 'second_role']);
    $account->addRole('one_permission');
    $account->save();
    // Setup a user with both the second and the third role.
    $this->users[] = $account = $this->userStorage->create(['name' => 'second_third_role']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $account->addRole('one_permission');
    $account->addRole('multiple_permissions');
    $account->save();
  }

}
