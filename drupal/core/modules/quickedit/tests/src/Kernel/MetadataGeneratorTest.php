<?php

namespace Drupal\Tests\quickedit\Kernel;

use Drupal\entity_test\Entity\EntityTest;
use Drupal\quickedit\EditorSelector;
use Drupal\quickedit\MetadataGenerator;
<<<<<<< HEAD
use Drupal\quickedit_test\MockEditEntityFieldAccessCheck;
=======
use Drupal\quickedit_test\MockQuickEditEntityFieldAccessCheck;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\filter\Entity\FilterFormat;

/**
 * Tests in-place field editing metadata.
 *
 * @group quickedit
 */
class MetadataGeneratorTest extends QuickEditTestBase {

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('quickedit_test');
=======
  public static $modules = ['quickedit_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The manager for editor plugins.
   *
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $editorManager;

  /**
   * The metadata generator object to be tested.
   *
   * @var \Drupal\quickedit\MetadataGeneratorInterface.php
   */
  protected $metadataGenerator;

  /**
   * The editor selector object to be used by the metadata generator object.
   *
   * @var \Drupal\quickedit\EditorSelectorInterface
   */
  protected $editorSelector;

  /**
   * The access checker object to be used by the metadata generator object.
   *
<<<<<<< HEAD
   * @var \Drupal\quickedit\Access\EditEntityFieldAccessCheckInterface
=======
   * @var \Drupal\quickedit\Access\QuickEditEntityFieldAccessCheckInterface
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   */
  protected $accessChecker;

  protected function setUp() {
    parent::setUp();

    $this->editorManager = $this->container->get('plugin.manager.quickedit.editor');
<<<<<<< HEAD
    $this->accessChecker = new MockEditEntityFieldAccessCheck();
=======
    $this->accessChecker = new MockQuickEditEntityFieldAccessCheck();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->editorSelector = new EditorSelector($this->editorManager, $this->container->get('plugin.manager.field.formatter'));
    $this->metadataGenerator = new MetadataGenerator($this->accessChecker, $this->editorSelector, $this->editorManager);
  }

  /**
   * Tests a simple entity type, with two different simple fields.
   */
  public function testSimpleEntityType() {
    $field_1_name = 'field_text';
    $field_1_label = 'Plain text field';
    $this->createFieldWithStorage(
      $field_1_name, 'string', 1, $field_1_label,
      // Instance settings.
<<<<<<< HEAD
      array(),
      // Widget type & settings.
      'string_textfield',
      array('size' => 42),
      // 'default' formatter type & settings.
      'string',
      array()
=======
      [],
      // Widget type & settings.
      'string_textfield',
      ['size' => 42],
      // 'default' formatter type & settings.
      'string',
      []
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    );
    $field_2_name = 'field_nr';
    $field_2_label = 'Simple number field';
    $this->createFieldWithStorage(
      $field_2_name, 'integer', 1, $field_2_label,
      // Instance settings.
<<<<<<< HEAD
      array(),
      // Widget type & settings.
      'number',
      array(),
      // 'default' formatter type & settings.
      'number_integer',
      array()
=======
      [],
      // Widget type & settings.
      'number',
      [],
      // 'default' formatter type & settings.
      'number_integer',
      []
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    );

    // Create an entity with values for this text field.
    $entity = EntityTest::create();
    $entity->{$field_1_name}->value = 'Test';
    $entity->{$field_2_name}->value = 42;
    $entity->save();
<<<<<<< HEAD
    $entity = entity_load('entity_test', $entity->id());
=======
    $entity = EntityTest::load($entity->id());
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Verify metadata for field 1.
    $items_1 = $entity->get($field_1_name);
    $metadata_1 = $this->metadataGenerator->generateFieldMetadata($items_1, 'default');
<<<<<<< HEAD
    $expected_1 = array(
      'access' => TRUE,
      'label' => 'Plain text field',
      'editor' => 'plain_text',
    );
=======
    $expected_1 = [
      'access' => TRUE,
      'label' => 'Plain text field',
      'editor' => 'plain_text',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($expected_1, $metadata_1, 'The correct metadata is generated for the first field.');

    // Verify metadata for field 2.
    $items_2 = $entity->get($field_2_name);
    $metadata_2 = $this->metadataGenerator->generateFieldMetadata($items_2, 'default');
<<<<<<< HEAD
    $expected_2 = array(
      'access' => TRUE,
      'label' => 'Simple number field',
      'editor' => 'form',
    );
=======
    $expected_2 = [
      'access' => TRUE,
      'label' => 'Simple number field',
      'editor' => 'form',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($expected_2, $metadata_2, 'The correct metadata is generated for the second field.');
  }

  /**
   * Tests a field whose associated in-place editor generates custom metadata.
   */
  public function testEditorWithCustomMetadata() {
    $this->editorManager = $this->container->get('plugin.manager.quickedit.editor');
    $this->editorSelector = new EditorSelector($this->editorManager, $this->container->get('plugin.manager.field.formatter'));
    $this->metadataGenerator = new MetadataGenerator($this->accessChecker, $this->editorSelector, $this->editorManager);

    $this->editorManager = $this->container->get('plugin.manager.quickedit.editor');
    $this->editorSelector = new EditorSelector($this->editorManager, $this->container->get('plugin.manager.field.formatter'));
    $this->metadataGenerator = new MetadataGenerator($this->accessChecker, $this->editorSelector, $this->editorManager);

    // Create a rich text field.
    $field_name = 'field_rich';
    $field_label = 'Rich text field';
    $this->createFieldWithStorage(
      $field_name, 'text', 1, $field_label,
      // Instance settings.
<<<<<<< HEAD
      array(),
      // Widget type & settings.
      'text_textfield',
      array('size' => 42),
      // 'default' formatter type & settings.
      'text_default',
      array()
    );

    // Create a text format.
    $full_html_format = FilterFormat::create(array(
      'format' => 'full_html',
      'name' => 'Full HTML',
      'weight' => 1,
      'filters' => array(
        'filter_htmlcorrector' => array('status' => 1),
      ),
    ));
=======
      [],
      // Widget type & settings.
      'text_textfield',
      ['size' => 42],
      // 'default' formatter type & settings.
      'text_default',
      []
    );

    // Create a text format.
    $full_html_format = FilterFormat::create([
      'format' => 'full_html',
      'name' => 'Full HTML',
      'weight' => 1,
      'filters' => [
        'filter_htmlcorrector' => ['status' => 1],
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $full_html_format->save();

    // Create an entity with values for this rich text field.
    $entity = EntityTest::create();
    $entity->{$field_name}->value = 'Test';
    $entity->{$field_name}->format = 'full_html';
    $entity->save();
<<<<<<< HEAD
    $entity = entity_load('entity_test', $entity->id());
=======
    $entity = EntityTest::load($entity->id());
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Verify metadata.
    $items = $entity->get($field_name);
    $metadata = $this->metadataGenerator->generateFieldMetadata($items, 'default');
<<<<<<< HEAD
    $expected = array(
      'access' => TRUE,
      'label' => 'Rich text field',
      'editor' => 'wysiwyg',
      'custom' => array(
        'format' => 'full_html'
      ),
    );
=======
    $expected = [
      'access' => TRUE,
      'label' => 'Rich text field',
      'editor' => 'wysiwyg',
      'custom' => [
        'format' => 'full_html'
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($expected, $metadata); //, 'The correct metadata (including custom metadata) is generated.');
  }

}
