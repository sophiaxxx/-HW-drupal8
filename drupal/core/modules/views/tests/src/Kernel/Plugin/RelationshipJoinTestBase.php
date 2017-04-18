<?php

namespace Drupal\Tests\views\Kernel\Plugin;

use Drupal\user\Entity\User;
use Drupal\views\Views;

/**
 * Provides a base class for a testing a relationship.
 *
 * @see \Drupal\views\Tests\Handler\JoinTest
 * @see \Drupal\views\Tests\Plugin\RelationshipTest
 */
abstract class RelationshipJoinTestBase extends PluginKernelTestBase {

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
   * @var \Drupal\user\Entity\User
   */
  protected $rootUser;

  /**
   * {@inheritdoc}
   */
  protected function setUpFixtures() {
    $this->installEntitySchema('user');
<<<<<<< HEAD
    $this->installConfig(array('user'));
=======
    $this->installConfig(['user']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    parent::setUpFixtures();

    // Create a record for uid 1.
    $this->rootUser = User::create(['name' => $this->randomMachineName()]);
    $this->rootUser->save();

    Views::viewsData()->clear();
  }

  /**
   * Overrides \Drupal\views\Tests\ViewTestBase::schemaDefinition().
   *
   * Adds a uid column to test the relationships.
   */
  protected function schemaDefinition() {
    $schema = parent::schemaDefinition();

<<<<<<< HEAD
    $schema['views_test_data']['fields']['uid'] = array(
=======
    $schema['views_test_data']['fields']['uid'] = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'description' => "The {users_field_data}.uid of the author of the beatle entry.",
      'type' => 'int',
      'unsigned' => TRUE,
      'not null' => TRUE,
      'default' => 0
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    return $schema;
  }

  /**
   * Overrides \Drupal\views\Tests\ViewTestBase::viewsData().
   *
   * Adds a relationship for the uid column.
   */
  protected function viewsData() {
    $data = parent::viewsData();
<<<<<<< HEAD
    $data['views_test_data']['uid'] = array(
      'title' => t('UID'),
      'help' => t('The test data UID'),
      'relationship' => array(
        'id' => 'standard',
        'base' => 'users_field_data',
        'base field' => 'uid'
      )
    );
=======
    $data['views_test_data']['uid'] = [
      'title' => t('UID'),
      'help' => t('The test data UID'),
      'relationship' => [
        'id' => 'standard',
        'base' => 'users_field_data',
        'base field' => 'uid'
      ]
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    return $data;
  }

}
