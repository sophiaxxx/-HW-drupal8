<?php

namespace Drupal\Tests\user\Kernel;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Language\Language;
use Drupal\Core\Render\Element\Email;
use Drupal\KernelTests\KernelTestBase;
use Drupal\user\Entity\Role;
use Drupal\user\Entity\User;

/**
 * Verify that user validity checks behave as designed.
 *
 * @group user
 */
class UserValidationTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('field', 'user', 'system');
=======
  public static $modules = ['field', 'user', 'system'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('user');
<<<<<<< HEAD
    $this->installSchema('system', array('sequences'));

    // Make sure that the default roles exist.
    $this->installConfig(array('user'));
=======
    $this->installSchema('system', ['sequences']);

    // Make sure that the default roles exist.
    $this->installConfig(['user']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  }

  /**
   * Tests user name validation.
   */
<<<<<<< HEAD
  function testUsernames() {
    $test_cases = array( // '<username>' => array('<description>', 'assert<testName>'),
      'foo'                    => array('Valid username', 'assertNull'),
      'FOO'                    => array('Valid username', 'assertNull'),
      'Foo O\'Bar'             => array('Valid username', 'assertNull'),
      'foo@bar'                => array('Valid username', 'assertNull'),
      'foo@example.com'        => array('Valid username', 'assertNull'),
      'foo@-example.com'       => array('Valid username', 'assertNull'), // invalid domains are allowed in usernames
      'þòøÇßªř€'               => array('Valid username', 'assertNull'),
      'ᚠᛇᚻ᛫ᛒᛦᚦ'                => array('Valid UTF8 username', 'assertNull'), // runes
      ' foo'                   => array('Invalid username that starts with a space', 'assertNotNull'),
      'foo '                   => array('Invalid username that ends with a space', 'assertNotNull'),
      'foo  bar'               => array('Invalid username that contains 2 spaces \'&nbsp;&nbsp;\'', 'assertNotNull'),
      ''                       => array('Invalid empty username', 'assertNotNull'),
      'foo/'                   => array('Invalid username containing invalid chars', 'assertNotNull'),
      'foo' . chr(0) . 'bar'   => array('Invalid username containing chr(0)', 'assertNotNull'), // NULL
      'foo' . chr(13) . 'bar'  => array('Invalid username containing chr(13)', 'assertNotNull'), // CR
      str_repeat('x', USERNAME_MAX_LENGTH + 1) => array('Invalid excessively long username', 'assertNotNull'),
    );
=======
  public function testUsernames() {
    $test_cases = [ // '<username>' => array('<description>', 'assert<testName>'),
      'foo'                    => ['Valid username', 'assertNull'],
      'FOO'                    => ['Valid username', 'assertNull'],
      'Foo O\'Bar'             => ['Valid username', 'assertNull'],
      'foo@bar'                => ['Valid username', 'assertNull'],
      'foo@example.com'        => ['Valid username', 'assertNull'],
      'foo@-example.com'       => ['Valid username', 'assertNull'], // invalid domains are allowed in usernames
      'þòøÇßªř€'               => ['Valid username', 'assertNull'],
      'foo+bar'                => ['Valid username', 'assertNull'], // '+' symbol is allowed
      'ᚠᛇᚻ᛫ᛒᛦᚦ'                => ['Valid UTF8 username', 'assertNull'], // runes
      ' foo'                   => ['Invalid username that starts with a space', 'assertNotNull'],
      'foo '                   => ['Invalid username that ends with a space', 'assertNotNull'],
      'foo  bar'               => ['Invalid username that contains 2 spaces \'&nbsp;&nbsp;\'', 'assertNotNull'],
      ''                       => ['Invalid empty username', 'assertNotNull'],
      'foo/'                   => ['Invalid username containing invalid chars', 'assertNotNull'],
      'foo' . chr(0) . 'bar'   => ['Invalid username containing chr(0)', 'assertNotNull'], // NULL
      'foo' . chr(13) . 'bar'  => ['Invalid username containing chr(13)', 'assertNotNull'], // CR
      str_repeat('x', USERNAME_MAX_LENGTH + 1) => ['Invalid excessively long username', 'assertNotNull'],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($test_cases as $name => $test_case) {
      list($description, $test) = $test_case;
      $result = user_validate_name($name);
      $this->$test($result, $description . ' (' . $name . ')');
    }
  }

  /**
   * Runs entity validation checks.
   */
<<<<<<< HEAD
  function testValidation() {
    $user = User::create(array(
      'name' => 'test',
      'mail' => 'test@example.com',
    ));
=======
  public function testValidation() {
    $user = User::create([
      'name' => 'test',
      'mail' => 'test@example.com',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $violations = $user->validate();
    $this->assertEqual(count($violations), 0, 'No violations when validating a default user.');

    // Only test one example invalid name here, the rest is already covered in
    // the testUsernames() method in this class.
    $name = $this->randomMachineName(61);
    $user->set('name', $name);
    $violations = $user->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when name is too long.');
    $this->assertEqual($violations[0]->getPropertyPath(), 'name');
<<<<<<< HEAD
    $this->assertEqual($violations[0]->getMessage(), t('The username %name is too long: it must be %max characters or less.', array('%name' => $name, '%max' => 60)));
=======
    $this->assertEqual($violations[0]->getMessage(), t('The username %name is too long: it must be %max characters or less.', ['%name' => $name, '%max' => 60]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Create a second test user to provoke a name collision.
    $user2 = User::create([
      'name' => 'existing',
      'mail' => 'existing@example.com',
    ]);
    $user2->save();
    $user->set('name', 'existing');
    $violations = $user->validate();
    $this->assertEqual(count($violations), 1, 'Violation found on name collision.');
    $this->assertEqual($violations[0]->getPropertyPath(), 'name');
<<<<<<< HEAD
    $this->assertEqual($violations[0]->getMessage(), t('The username %name is already taken.', array('%name' => 'existing')));
=======
    $this->assertEqual($violations[0]->getMessage(), t('The username %name is already taken.', ['%name' => 'existing']));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Make the name valid.
    $user->set('name', $this->randomMachineName());

    $user->set('mail', 'invalid');
    $violations = $user->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when email is invalid');
    $this->assertEqual($violations[0]->getPropertyPath(), 'mail.0.value');
    $this->assertEqual($violations[0]->getMessage(), t('This value is not a valid email address.'));

    $mail = $this->randomMachineName(Email::EMAIL_MAX_LENGTH - 11) . '@example.com';
    $user->set('mail', $mail);
    $violations = $user->validate();
    // @todo There are two violations because EmailItem::getConstraints()
    //   overlaps with the implicit constraint of the 'email' property type used
    //   in EmailItem::propertyDefinitions(). Resolve this in
    //   https://www.drupal.org/node/2023465.
    $this->assertEqual(count($violations), 2, 'Violations found when email is too long');
    $this->assertEqual($violations[0]->getPropertyPath(), 'mail.0.value');
<<<<<<< HEAD
    $this->assertEqual($violations[0]->getMessage(), t('%name: the email address can not be longer than @max characters.', array('%name' => $user->get('mail')->getFieldDefinition()->getLabel(), '@max' => Email::EMAIL_MAX_LENGTH)));
=======
    $this->assertEqual($violations[0]->getMessage(), t('%name: the email address can not be longer than @max characters.', ['%name' => $user->get('mail')->getFieldDefinition()->getLabel(), '@max' => Email::EMAIL_MAX_LENGTH]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($violations[1]->getPropertyPath(), 'mail.0.value');
    $this->assertEqual($violations[1]->getMessage(), t('This value is not a valid email address.'));

    // Provoke an email collision with an existing user.
    $user->set('mail', 'existing@example.com');
    $violations = $user->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when email already exists.');
    $this->assertEqual($violations[0]->getPropertyPath(), 'mail');
<<<<<<< HEAD
    $this->assertEqual($violations[0]->getMessage(), t('The email address %mail is already taken.', array('%mail' => 'existing@example.com')));
=======
    $this->assertEqual($violations[0]->getMessage(), t('The email address %mail is already taken.', ['%mail' => 'existing@example.com']));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $user->set('mail', NULL);
    $violations = $user->validate();
    $this->assertEqual(count($violations), 1, 'Email addresses may not be removed');
    $this->assertEqual($violations[0]->getPropertyPath(), 'mail');
<<<<<<< HEAD
    $this->assertEqual($violations[0]->getMessage(), t('@name field is required.', array('@name' => $user->getFieldDefinition('mail')->getLabel())));
=======
    $this->assertEqual($violations[0]->getMessage(), t('@name field is required.', ['@name' => $user->getFieldDefinition('mail')->getLabel()]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $user->set('mail', 'someone@example.com');

    $user->set('timezone', $this->randomString(33));
    $this->assertLengthViolation($user, 'timezone', 32, 2, 1);
    $user->set('timezone', 'invalid zone');
    $this->assertAllowedValuesViolation($user, 'timezone');
    $user->set('timezone', NULL);

    $user->set('init', 'invalid');
    $violations = $user->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when init email is invalid');
    $user->set('init', NULL);

    $user->set('langcode', 'invalid');
    $this->assertAllowedValuesViolation($user, 'langcode');
    $user->set('langcode', NULL);

    // Only configurable langcodes are allowed for preferred languages.
    $user->set('preferred_langcode', Language::LANGCODE_NOT_SPECIFIED);
    $this->assertAllowedValuesViolation($user, 'preferred_langcode');
    $user->set('preferred_langcode', NULL);

    $user->set('preferred_admin_langcode', Language::LANGCODE_NOT_SPECIFIED);
    $this->assertAllowedValuesViolation($user, 'preferred_admin_langcode');
    $user->set('preferred_admin_langcode', NULL);

<<<<<<< HEAD
    Role::create(array('id' => 'role1'))->save();
    Role::create(array('id' => 'role2'))->save();
=======
    Role::create(['id' => 'role1'])->save();
    Role::create(['id' => 'role2'])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test cardinality of user roles.
    $user = User::create([
      'name' => 'role_test',
      'mail' => 'test@example.com',
<<<<<<< HEAD
      'roles' => array('role1', 'role2'),
=======
      'roles' => ['role1', 'role2'],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    ]);
    $violations = $user->validate();
    $this->assertEqual(count($violations), 0);

    $user->roles[1]->target_id = 'unknown_role';
    $violations = $user->validate();
    $this->assertEqual(count($violations), 1);
    $this->assertEqual($violations[0]->getPropertyPath(), 'roles.1.target_id');
<<<<<<< HEAD
    $this->assertEqual($violations[0]->getMessage(), t('The referenced entity (%entity_type: %name) does not exist.', array('%entity_type' => 'user_role', '%name' => 'unknown_role')));
=======
    $this->assertEqual($violations[0]->getMessage(), t('The referenced entity (%entity_type: %name) does not exist.', ['%entity_type' => 'user_role', '%name' => 'unknown_role']));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Verifies that a length violation exists for the given field.
   *
   * @param \Drupal\core\Entity\EntityInterface $entity
   *   The entity object to validate.
   * @param string $field_name
   *   The field that violates the maximum length.
   * @param int $length
   *   Number of characters that was exceeded.
   * @param int $count
   *   (optional) The number of expected violations. Defaults to 1.
   * @param int $expected_index
   *   (optional) The index at which to expect the violation. Defaults to 0.
   */
  protected function assertLengthViolation(EntityInterface $entity, $field_name, $length, $count = 1, $expected_index = 0) {
    $violations = $entity->validate();
    $this->assertEqual(count($violations), $count, "Violation found when $field_name is too long.");
    $this->assertEqual($violations[$expected_index]->getPropertyPath(), "$field_name.0.value");
    $field_label = $entity->get($field_name)->getFieldDefinition()->getLabel();
<<<<<<< HEAD
    $this->assertEqual($violations[$expected_index]->getMessage(), t('%name: may not be longer than @max characters.', array('%name' => $field_label, '@max' => $length)));
=======
    $this->assertEqual($violations[$expected_index]->getMessage(), t('%name: may not be longer than @max characters.', ['%name' => $field_label, '@max' => $length]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Verifies that a AllowedValues violation exists for the given field.
   *
   * @param \Drupal\core\Entity\EntityInterface $entity
   *   The entity object to validate.
   * @param string $field_name
   *   The name of the field to verify.
   */
  protected function assertAllowedValuesViolation(EntityInterface $entity, $field_name) {
    $violations = $entity->validate();
    $this->assertEqual(count($violations), 1, "Allowed values violation for $field_name found.");
    $this->assertEqual($violations[0]->getPropertyPath(), "$field_name.0.value");
    $this->assertEqual($violations[0]->getMessage(), t('The value you selected is not a valid choice.'));
  }

}
