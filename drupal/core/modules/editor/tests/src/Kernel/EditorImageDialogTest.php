<?php

namespace Drupal\Tests\editor\Kernel;

use Drupal\Core\Form\FormState;
use Drupal\editor\Entity\Editor;
use Drupal\editor\Form\EditorImageDialog;
use Drupal\filter\Entity\FilterFormat;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\Entity\NodeType;

/**
 * Tests EditorImageDialog validation and conversion functionality.
 *
 * @group editor
 */
class EditorImageDialogTest extends EntityKernelTestBase {

  /**
<<<<<<< HEAD
   * Filter format for testing.
   *
   * @var \Drupal\filter\FilterFormatInterface
   */
  protected $format;
=======
   * Text editor config entity for testing.
   *
   * @var \Drupal\editor\EditorInterface
   */
  protected $editor;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['node', 'file', 'editor', 'editor_test', 'user', 'system'];

  /**
   * Sets up the test.
   */
  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('file');
    $this->installSchema('system', ['key_value_expire']);
<<<<<<< HEAD
    $this->installSchema('node', array('node_access'));
    $this->installSchema('file', array('file_usage'));
    $this->installConfig(['node']);

    // Add text formats.
    $this->format = FilterFormat::create([
=======
    $this->installSchema('node', ['node_access']);
    $this->installSchema('file', ['file_usage']);
    $this->installConfig(['node']);

    // Add text formats.
    $format = FilterFormat::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'format' => 'filtered_html',
      'name' => 'Filtered HTML',
      'weight' => 0,
      'filters' => [
        'filter_align' => ['status' => TRUE],
        'filter_caption' => ['status' => TRUE],
      ],
    ]);
<<<<<<< HEAD
    $this->format->save();
=======
    $format->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Set up text editor.
    $editor = Editor::create([
      'format' => 'filtered_html',
      'editor' => 'unicorn',
      'image_upload' => [
        'max_size' => 100,
        'scheme' => 'public',
        'directory' => '',
        'status' => TRUE,
      ],
    ]);
    $editor->save();
<<<<<<< HEAD
=======
    $this->editor = $editor;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Create a node type for testing.
    $type = NodeType::create(['type' => 'page', 'name' => 'page']);
    $type->save();
    node_add_body_field($type);
    $this->installEntitySchema('user');
    \Drupal::service('router.builder')->rebuild();
  }

  /**
   * Tests that editor image dialog works as expected.
   */
  public function testEditorImageDialog() {
    $input = [
      'editor_object' => [
        'src' => '/sites/default/files/inline-images/somefile.png',
        'alt' => 'fda',
        'width' => '',
        'height' => '',
        'data-entity-type' => 'file',
        'data-entity-uuid' => 'some-uuid',
        'data-align' => 'none',
        'hasCaption' => 'false',
      ],
      'dialogOptions' => [
        'title' => 'Edit Image',
        'dialogClass' => 'editor-image-dialog',
        'autoResize' => 'true',
      ],
      '_drupal_ajax' => '1',
      'ajax_page_state' => [
        'theme' => 'bartik',
        'theme_token' => 'some-token',
        'libraries' => '',
      ],
    ];
    $form_state = (new FormState())
      ->setRequestMethod('POST')
      ->setUserInput($input)
<<<<<<< HEAD
      ->addBuildInfo('args', [$this->format]);
=======
      ->addBuildInfo('args', [$this->editor]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $form_builder = $this->container->get('form_builder');
    $form_object = new EditorImageDialog(\Drupal::entityManager()->getStorage('file'));
    $form_id = $form_builder->getFormId($form_object, $form_state);
    $form = $form_builder->retrieveForm($form_id, $form_state);
    $form_builder->prepareForm($form_id, $form, $form_state);
    $form_builder->processForm($form_id, $form, $form_state);

    // Assert these two values are present and we don't get the 'not-this'
    // default back.
    $this->assertEqual(FALSE, $form_state->getValue(['attributes', 'hasCaption'], 'not-this'));
  }

}
