<?php

namespace Drupal\Tests\comment\Kernel;

use Drupal\comment\Entity\CommentType;
use Drupal\KernelTests\KernelTestBase;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests that comment fields cannot be added to entities with non-integer IDs.
 *
 * @group comment
 */
class CommentStringIdEntitiesTest extends KernelTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array(
=======
  public static $modules = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    'comment',
    'user',
    'field',
    'field_ui',
    'entity_test',
    'text',
<<<<<<< HEAD
  );
=======
  ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('comment');
<<<<<<< HEAD
    $this->installSchema('comment', array('comment_entity_statistics'));
    // Create the comment body field storage.
    $this->installConfig(array('field'));
=======
    $this->installSchema('comment', ['comment_entity_statistics']);
    // Create the comment body field storage.
    $this->installConfig(['field']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests that comment fields cannot be added entities with non-integer IDs.
   */
  public function testCommentFieldNonStringId() {
    try {
<<<<<<< HEAD
      $bundle = CommentType::create(array(
=======
      $bundle = CommentType::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => 'foo',
        'label' => 'foo',
        'description' => '',
        'target_entity_type_id' => 'entity_test_string_id',
<<<<<<< HEAD
      ));
      $bundle->save();
      $field_storage = FieldStorageConfig::create(array(
        'field_name' => 'foo',
        'entity_type' => 'entity_test_string_id',
        'settings' => array(
          'comment_type' => 'entity_test_string_id',
        ),
        'type' => 'comment',
      ));
=======
      ]);
      $bundle->save();
      $field_storage = FieldStorageConfig::create([
        'field_name' => 'foo',
        'entity_type' => 'entity_test_string_id',
        'settings' => [
          'comment_type' => 'entity_test_string_id',
        ],
        'type' => 'comment',
      ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $field_storage->save();
      $this->fail('Did not throw an exception as expected.');
    }
    catch (\UnexpectedValueException $e) {
      $this->pass('Exception thrown when trying to create comment field on Entity Type with string ID.');
    }
  }

}
