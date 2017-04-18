<?php

namespace Drupal\Tests\user\Kernel\Condition;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\KernelTests\KernelTestBase;
use Drupal\user\Entity\Role;
use Drupal\user\Entity\User;
use Drupal\user\RoleInterface;

/**
 * Tests the user role condition.
 *
 * @group user
 */
class UserRoleConditionTest extends KernelTestBase {

  /**
   * The condition plugin manager.
   *
   * @var \Drupal\Core\Condition\ConditionManager
   */
  protected $manager;

  /**
   * An anonymous user for testing purposes.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $anonymous;

  /**
   * An authenticated user for testing purposes.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $authenticated;

  /**
   * A custom role for testing purposes.
   *
   * @var \Drupal\user\Entity\RoleInterface
   */
  protected $role;

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
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->installSchema('system', 'sequences');
    $this->installEntitySchema('user');

    $this->manager = $this->container->get('plugin.manager.condition');

    // Set up the authenticated and anonymous roles.
<<<<<<< HEAD
    Role::create(array(
      'id' => RoleInterface::ANONYMOUS_ID,
      'label' => 'Anonymous user',
    ))->save();
    Role::create(array(
      'id' => RoleInterface::AUTHENTICATED_ID,
      'label' => 'Authenticated user',
    ))->save();
=======
    Role::create([
      'id' => RoleInterface::ANONYMOUS_ID,
      'label' => 'Anonymous user',
    ])->save();
    Role::create([
      'id' => RoleInterface::AUTHENTICATED_ID,
      'label' => 'Authenticated user',
    ])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Create new role.
    $rid = strtolower($this->randomMachineName(8));
    $label = $this->randomString(8);
<<<<<<< HEAD
    $role = Role::create(array(
      'id' => $rid,
      'label' => $label,
    ));
=======
    $role = Role::create([
      'id' => $rid,
      'label' => $label,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $role->save();
    $this->role = $role;

    // Setup an anonymous user for our tests.
<<<<<<< HEAD
    $this->anonymous = User::create(array(
      'name' => '',
      'uid' => 0,
    ));
=======
    $this->anonymous = User::create([
      'name' => '',
      'uid' => 0,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->anonymous->save();
    // Loading the anonymous user adds the correct role.
    $this->anonymous = User::load($this->anonymous->id());

    // Setup an authenticated user for our tests.
<<<<<<< HEAD
    $this->authenticated = User::create(array(
      'name' => $this->randomMachineName(),
    ));
=======
    $this->authenticated = User::create([
      'name' => $this->randomMachineName(),
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->authenticated->save();
    // Add the custom role.
    $this->authenticated->addRole($this->role->id());
  }

  /**
   * Test the user_role condition.
   */
  public function testConditions() {
    // Grab the user role condition and configure it to check against
    // authenticated user roles.
    /** @var $condition \Drupal\Core\Condition\ConditionInterface */
    $condition = $this->manager->createInstance('user_role')
<<<<<<< HEAD
      ->setConfig('roles', array(RoleInterface::AUTHENTICATED_ID => RoleInterface::AUTHENTICATED_ID))
=======
      ->setConfig('roles', [RoleInterface::AUTHENTICATED_ID => RoleInterface::AUTHENTICATED_ID])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->setContextValue('user', $this->anonymous);
    $this->assertFalse($condition->execute(), 'Anonymous users fail role checks for authenticated.');
    // Check for the proper summary.
    // Summaries require an extra space due to negate handling in summary().
    $this->assertEqual($condition->summary(), 'The user is a member of Authenticated user');

    // Set the user role to anonymous.
<<<<<<< HEAD
    $condition->setConfig('roles', array(RoleInterface::ANONYMOUS_ID => RoleInterface::ANONYMOUS_ID));
=======
    $condition->setConfig('roles', [RoleInterface::ANONYMOUS_ID => RoleInterface::ANONYMOUS_ID]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($condition->execute(), 'Anonymous users pass role checks for anonymous.');
    // Check for the proper summary.
    $this->assertEqual($condition->summary(), 'The user is a member of Anonymous user');

    // Set the user role to check anonymous or authenticated.
<<<<<<< HEAD
    $condition->setConfig('roles', array(RoleInterface::ANONYMOUS_ID => RoleInterface::ANONYMOUS_ID, RoleInterface::AUTHENTICATED_ID => RoleInterface::AUTHENTICATED_ID));
=======
    $condition->setConfig('roles', [RoleInterface::ANONYMOUS_ID => RoleInterface::ANONYMOUS_ID, RoleInterface::AUTHENTICATED_ID => RoleInterface::AUTHENTICATED_ID]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($condition->execute(), 'Anonymous users pass role checks for anonymous or authenticated.');
    // Check for the proper summary.
    $this->assertEqual($condition->summary(), 'The user is a member of Anonymous user, Authenticated user');

    // Set the context to the authenticated user and check that they also pass
    // against anonymous or authenticated roles.
    $condition->setContextValue('user', $this->authenticated);
    $this->assertTrue($condition->execute(), 'Authenticated users pass role checks for anonymous or authenticated.');

    // Set the role to just authenticated and recheck.
<<<<<<< HEAD
    $condition->setConfig('roles', array(RoleInterface::AUTHENTICATED_ID => RoleInterface::AUTHENTICATED_ID));
    $this->assertTrue($condition->execute(), 'Authenticated users pass role checks for authenticated.');

    // Test Constructor injection.
    $condition = $this->manager->createInstance('user_role', array('roles' => array(RoleInterface::AUTHENTICATED_ID => RoleInterface::AUTHENTICATED_ID), 'context' => array('user' => $this->authenticated)));
=======
    $condition->setConfig('roles', [RoleInterface::AUTHENTICATED_ID => RoleInterface::AUTHENTICATED_ID]);
    $this->assertTrue($condition->execute(), 'Authenticated users pass role checks for authenticated.');

    // Test Constructor injection.
    $condition = $this->manager->createInstance('user_role', ['roles' => [RoleInterface::AUTHENTICATED_ID => RoleInterface::AUTHENTICATED_ID], 'context' => ['user' => $this->authenticated]]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($condition->execute(), 'Constructor injection of context and configuration working as anticipated.');

    // Check the negated summary.
    $condition->setConfig('negate', TRUE);
    $this->assertEqual($condition->summary(), 'The user is not a member of Authenticated user');

    // Check the complex negated summary.
<<<<<<< HEAD
    $condition->setConfig('roles', array(RoleInterface::ANONYMOUS_ID => RoleInterface::ANONYMOUS_ID, RoleInterface::AUTHENTICATED_ID => RoleInterface::AUTHENTICATED_ID));
    $this->assertEqual($condition->summary(), 'The user is not a member of Anonymous user, Authenticated user');

    // Check a custom role.
    $condition->setConfig('roles', array($this->role->id() => $this->role->id()));
    $condition->setConfig('negate', FALSE);
    $this->assertTrue($condition->execute(), 'Authenticated user is a member of the custom role.');
    $this->assertEqual($condition->summary(), SafeMarkup::format('The user is a member of @roles', array('@roles' => $this->role->label())));
=======
    $condition->setConfig('roles', [RoleInterface::ANONYMOUS_ID => RoleInterface::ANONYMOUS_ID, RoleInterface::AUTHENTICATED_ID => RoleInterface::AUTHENTICATED_ID]);
    $this->assertEqual($condition->summary(), 'The user is not a member of Anonymous user, Authenticated user');

    // Check a custom role.
    $condition->setConfig('roles', [$this->role->id() => $this->role->id()]);
    $condition->setConfig('negate', FALSE);
    $this->assertTrue($condition->execute(), 'Authenticated user is a member of the custom role.');
    $this->assertEqual($condition->summary(), SafeMarkup::format('The user is a member of @roles', ['@roles' => $this->role->label()]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
