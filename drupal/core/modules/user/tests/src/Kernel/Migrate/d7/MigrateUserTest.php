<?php

namespace Drupal\Tests\user\Kernel\Migrate\d7;

<<<<<<< HEAD
=======
use Drupal\comment\Entity\CommentType;
use Drupal\Core\Database\Database;
use Drupal\node\Entity\NodeType;
use Drupal\taxonomy\Entity\Vocabulary;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Tests\migrate_drupal\Kernel\d7\MigrateDrupal7TestBase;
use Drupal\user\Entity\User;
use Drupal\user\RoleInterface;
use Drupal\user\UserInterface;

/**
 * Users migration.
 *
 * @group user
 */
class MigrateUserTest extends MigrateDrupal7TestBase {

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = ['file', 'image'];
=======
  public static $modules = [
    'comment',
    'datetime',
    'file',
    'image',
    'language',
    'link',
    'node',
    'system',
    'taxonomy',
    'telephone',
    'text',
  ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    // Prepare to migrate user pictures as well.
    $this->installEntitySchema('file');
<<<<<<< HEAD
    $this->executeMigrations([
      'user_picture_field',
      'user_picture_field_instance',
      'd7_user_role',
=======
    $this->createType('page');
    $this->createType('article');
    $this->createType('blog');
    $this->createType('book');
    $this->createType('forum');
    $this->createType('test_content_type');
    Vocabulary::create(['vid' => 'test_vocabulary'])->save();
    $this->executeMigrations([
      'language',
      'user_picture_field',
      'user_picture_field_instance',
      'd7_user_role',
      'd7_field',
      'd7_field_instance',
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'd7_user',
    ]);
  }

  /**
<<<<<<< HEAD
=======
   * Creates a node type with a corresponding comment type.
   *
   * @param string $id
   *   The node type ID.
   */
  protected function createType($id) {
    NodeType::create([
      'type' => $id,
      'label' => $this->randomString(),
    ])->save();

    CommentType::create([
      'id' => 'comment_node_' . $id,
      'label' => $this->randomString(),
      'target_entity_type_id' => 'node',
    ])->save();
  }

  /**
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * Asserts various aspects of a user account.
   *
   * @param string $id
   *   The user ID.
   * @param string $label
   *   The username.
   * @param string $mail
   *   The user's email address.
   * @param string $password
   *   The password for this user.
<<<<<<< HEAD
=======
   * @param int $created
   *   The user's creation time.
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * @param int $access
   *   The last access time.
   * @param int $login
   *   The last login time.
   * @param bool $blocked
   *   Whether or not the account is blocked.
   * @param string $langcode
   *   The user account's language code.
<<<<<<< HEAD
=======
   * @param string $timezone
   *   The user account's timezone name.
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * @param string $init
   *   The user's initial email address.
   * @param string[] $roles
   *   Role IDs the user account is expected to have.
<<<<<<< HEAD
   * @param bool $has_picture
   *   Whether the user is expected to have a picture attached.
   */
  protected function assertEntity($id, $label, $mail, $password, $access, $login, $blocked, $langcode, $init, array $roles = [RoleInterface::AUTHENTICATED_ID], $has_picture = FALSE) {
    /** @var \Drupal\user\UserInterface $user */
    $user = User::load($id);
    $this->assertTrue($user instanceof UserInterface);
    $this->assertIdentical($label, $user->label());
    $this->assertIdentical($mail, $user->getEmail());
    $this->assertIdentical($access, $user->getLastAccessedTime());
    $this->assertIdentical($login, $user->getLastLoginTime());
    $this->assertIdentical($blocked, $user->isBlocked());
    // $user->getPreferredLangcode() might fallback to default language if the
    // user preferred language is not configured on the site. We just want to
    // test if the value was imported correctly.
    $this->assertIdentical($langcode, $user->langcode->value);
    $this->assertIdentical($langcode, $user->preferred_langcode->value);
    $this->assertIdentical($langcode, $user->preferred_admin_langcode->value);
    $this->assertIdentical($init, $user->getInitialEmail());
    $this->assertIdentical($roles, $user->getRoles());
    $this->assertIdentical($has_picture, !$user->user_picture->isEmpty());
    $this->assertIdentical($password, $user->getPassword());
=======
   * @param int $field_integer
   *   The value of the integer field.
   * @param int|false $field_file_target_id
   *   (optional) The target ID of the file field.
   * @param bool $has_picture
   *   (optional) Whether the user is expected to have a picture attached.
   */
  protected function assertEntity($id, $label, $mail, $password, $created, $access, $login, $blocked, $langcode, $timezone, $init, $roles, $field_integer, $field_file_target_id = FALSE, $has_picture = FALSE) {
    /** @var \Drupal\user\UserInterface $user */
    $user = User::load($id);
    $this->assertTrue($user instanceof UserInterface);
    $this->assertSame($label, $user->label());
    $this->assertSame($mail, $user->getEmail());
    $this->assertSame($password, $user->getPassword());
    $this->assertSame($created, $user->getCreatedTime());
    $this->assertSame($access, $user->getLastAccessedTime());
    $this->assertSame($login, $user->getLastLoginTime());
    $this->assertNotSame($blocked, $user->isBlocked());

    // Ensure the user's langcode, preferred_langcode and
    // preferred_admin_langcode are valid.
    // $user->getPreferredLangcode() might fallback to default language if the
    // user preferred language is not configured on the site. We just want to
    // test if the value was imported correctly.
    $language_manager = $this->container->get('language_manager');
    $default_langcode = $language_manager->getDefaultLanguage()->getId();
    if ($langcode == '') {
      $this->assertSame('en', $user->langcode->value);
      $this->assertSame($default_langcode, $user->preferred_langcode->value);
      $this->assertSame($default_langcode, $user->preferred_admin_langcode->value);
    }
    elseif ($language_manager->getLanguage($langcode) === NULL) {
      $this->assertSame($default_langcode, $user->langcode->value);
      $this->assertSame($default_langcode, $user->preferred_langcode->value);
      $this->assertSame($default_langcode, $user->preferred_admin_langcode->value);
    }
    else {
      $this->assertSame($langcode, $user->langcode->value);
      $this->assertSame($langcode, $user->preferred_langcode->value);
      $this->assertSame($langcode, $user->preferred_admin_langcode->value);
    }

    $this->assertSame($timezone, $user->getTimeZone());
    $this->assertSame($init, $user->getInitialEmail());
    $this->assertSame($roles, $user->getRoles());
    $this->assertSame($has_picture, !$user->user_picture->isEmpty());
    if (!is_null($field_integer)) {
      $this->assertTrue($user->hasField('field_integer'));
      $this->assertEquals($field_integer[0], $user->field_integer->value);
    }
    if (!empty($field_file_target_id)) {
      $this->assertTrue($user->hasField('field_file'));
      $this->assertSame($field_file_target_id, $user->field_file->target_id);
    }
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests the Drupal 7 user to Drupal 8 migration.
   */
  public function testUser() {
<<<<<<< HEAD
    $password = '$S$DGFZUE.FhrXbe4y52eC7p0ZVRGD/gOPtVctDlmC89qkujnBokAlJ';
    $this->assertEntity(2, 'Odo', 'odo@local.host', $password, '0', '0', FALSE, '', 'odo@local.host');

    // Ensure that the user can authenticate.
    $this->assertEquals(2, \Drupal::service('user.auth')->authenticate('Odo', 'a password'));
    // After authenticating the password will be rehashed because the password
    // stretching iteration count has changed from 15 in Drupal 7 to 16 in
    // Drupal 8.
    $user = User::load(2);
    $rehash = $user->getPassword();
    $this->assertNotEquals($password, $rehash);

    // Authenticate again and there should be no re-hash.
    $this->assertEquals(2, \Drupal::service('user.auth')->authenticate('Odo', 'a password'));
    $user = User::load(2);
    $this->assertEquals($rehash, $user->getPassword());
=======
    $users = Database::getConnection('default', 'migrate')
      ->select('users', 'u')
      ->fields('u')
      ->condition('uid', 1, '>')
      ->execute()
      ->fetchAll();

    foreach ($users as $source) {
      $rids = Database::getConnection('default', 'migrate')
        ->select('users_roles', 'ur')
        ->fields('ur', ['rid'])
        ->condition('ur.uid', $source->uid)
        ->execute()
        ->fetchCol();
      $roles = [RoleInterface::AUTHENTICATED_ID];
      $id_map = $this->getMigration('d7_user_role')->getIdMap();
      foreach ($rids as $rid) {
        $role = $id_map->lookupDestinationId([$rid]);
        $roles[] = reset($role);
      }

      $field_integer = Database::getConnection('default', 'migrate')
        ->select('field_data_field_integer', 'fi')
        ->fields('fi', ['field_integer_value'])
        ->condition('fi.entity_id', $source->uid)
        ->execute()
        ->fetchCol();
      $field_integer = !empty($field_integer) ? $field_integer : NULL;

      $field_file = Database::getConnection('default', 'migrate')
        ->select('field_data_field_file', 'ff')
        ->fields('ff', ['field_file_fid'])
        ->condition('ff.entity_id', $source->uid)
        ->execute()
        ->fetchField();

      $this->assertEntity(
        $source->uid,
        $source->name,
        $source->mail,
        $source->pass,
        $source->created,
        $source->access,
        $source->login,
        $source->status,
        $source->language,
        $source->timezone,
        $source->init,
        $roles,
        $field_integer,
        $field_file
      );

      // Ensure that the user can authenticate.
      $this->assertEquals($source->uid, $this->container->get('user.auth')->authenticate($source->name, 'a password'));
      // After authenticating the password will be rehashed because the password
      // stretching iteration count has changed from 15 in Drupal 7 to 16 in
      // Drupal 8.
      $user = User::load($source->uid);
      $rehash = $user->getPassword();
      $this->assertNotEquals($source->pass, $rehash);

      // Authenticate again and there should be no re-hash.
      $this->assertEquals($source->uid, $this->container->get('user.auth')->authenticate($source->name, 'a password'));
      $user = User::load($source->uid);
      $this->assertEquals($rehash, $user->getPassword());
    }
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
