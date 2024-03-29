<?php

namespace Drupal\Tests\user\Kernel;

use Drupal\user\Entity\User;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests available user fields in twig.
 *
 * @group user
 */
class UserFieldsTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['user', 'system'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('user');

    // Set up a test theme that prints the user's mail field.
<<<<<<< HEAD
    \Drupal::service('theme_handler')->install(array('user_test_theme'));
=======
    \Drupal::service('theme_handler')->install(['user_test_theme']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    \Drupal::theme()->setActiveTheme(\Drupal::service('theme.initialization')->initTheme('user_test_theme'));
    // Clear the theme registry.
    $this->container->set('theme.registry', NULL);
  }

  /**
   * Tests account's available fields.
   */
<<<<<<< HEAD
  function testUserFields() {
=======
  public function testUserFields() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Create the user to test the user fields.
    $user = User::create([
      'name' => 'foobar',
      'mail' => 'foobar@example.com',
    ]);
    $build = user_view($user);
    $output = \Drupal::service('renderer')->renderRoot($build);
    $this->setRawContent($output);
    $userEmail = $user->getEmail();
    $this->assertText($userEmail, "User's mail field is found in the twig template");
  }

}
