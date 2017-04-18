<?php

namespace Drupal\Tests\editor\Kernel;

use Drupal\editor\Entity\Editor;
use Drupal\filter\Entity\FilterFormat;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests detection of text editors and correct generation of attachments.
 *
 * @group editor
 */
class EditorManagerTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('system', 'user', 'filter', 'editor');
=======
  public static $modules = ['system', 'user', 'filter', 'editor'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The manager for text editor plugins.
   *
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $editorManager;

  protected function setUp() {
    parent::setUp();

    // Install the Filter module.

    // Add text formats.
<<<<<<< HEAD
    $filtered_html_format = FilterFormat::create(array(
      'format' => 'filtered_html',
      'name' => 'Filtered HTML',
      'weight' => 0,
      'filters' => array(),
    ));
    $filtered_html_format->save();
    $full_html_format = FilterFormat::create(array(
      'format' => 'full_html',
      'name' => 'Full HTML',
      'weight' => 1,
      'filters' => array(),
    ));
=======
    $filtered_html_format = FilterFormat::create([
      'format' => 'filtered_html',
      'name' => 'Filtered HTML',
      'weight' => 0,
      'filters' => [],
    ]);
    $filtered_html_format->save();
    $full_html_format = FilterFormat::create([
      'format' => 'full_html',
      'name' => 'Full HTML',
      'weight' => 1,
      'filters' => [],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $full_html_format->save();
  }

  /**
   * Tests the configurable text editor manager.
   */
  public function testManager() {
    $this->editorManager = $this->container->get('plugin.manager.editor');

    // Case 1: no text editor available:
    // - listOptions() should return an empty list of options
    // - getAttachments() should return an empty #attachments array (and not
    //   a JS settings structure that is empty)
<<<<<<< HEAD
    $this->assertIdentical(array(), $this->editorManager->listOptions(), 'When no text editor is enabled, the manager works correctly.');
    $this->assertIdentical(array(), $this->editorManager->getAttachments(array()), 'No attachments when no text editor is enabled and retrieving attachments for zero text formats.');
    $this->assertIdentical(array(), $this->editorManager->getAttachments(array('filtered_html', 'full_html')), 'No attachments when no text editor is enabled and retrieving attachments for multiple text formats.');

    // Enable the Text Editor Test module, which has the Unicorn Editor and
    // clear the editor manager's cache so it is picked up.
    $this->enableModules(array('editor_test'));
=======
    $this->assertIdentical([], $this->editorManager->listOptions(), 'When no text editor is enabled, the manager works correctly.');
    $this->assertIdentical([], $this->editorManager->getAttachments([]), 'No attachments when no text editor is enabled and retrieving attachments for zero text formats.');
    $this->assertIdentical([], $this->editorManager->getAttachments(['filtered_html', 'full_html']), 'No attachments when no text editor is enabled and retrieving attachments for multiple text formats.');

    // Enable the Text Editor Test module, which has the Unicorn Editor and
    // clear the editor manager's cache so it is picked up.
    $this->enableModules(['editor_test']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->editorManager = $this->container->get('plugin.manager.editor');
    $this->editorManager->clearCachedDefinitions();

    // Case 2: a text editor available.
    $this->assertIdentical('Unicorn Editor', (string) $this->editorManager->listOptions()['unicorn'], 'When some text editor is enabled, the manager works correctly.');

    // Case 3: a text editor available & associated (but associated only with
    // the 'Full HTML' text format).
    $unicorn_plugin = $this->editorManager->createInstance('unicorn');
    $editor = Editor::create([
      'format' => 'full_html',
      'editor' => 'unicorn',
    ]);
    $editor->save();
<<<<<<< HEAD
    $this->assertIdentical(array(), $this->editorManager->getAttachments(array()), 'No attachments when one text editor is enabled and retrieving attachments for zero text formats.');
    $expected = array(
      'library' => array(
        0 => 'editor_test/unicorn',
      ),
=======
    $this->assertIdentical([], $this->editorManager->getAttachments([]), 'No attachments when one text editor is enabled and retrieving attachments for zero text formats.');
    $expected = [
      'library' => [
        0 => 'editor_test/unicorn',
      ],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'drupalSettings' => [
        'editor' => [
          'formats' => [
            'full_html' => [
              'format'  => 'full_html',
              'editor' => 'unicorn',
              'editorSettings' => $unicorn_plugin->getJSSettings($editor),
              'editorSupportsContentFiltering' => TRUE,
              'isXssSafe' => FALSE,
            ],
          ],
        ],
      ],
<<<<<<< HEAD
    );
    $this->assertIdentical($expected, $this->editorManager->getAttachments(array('filtered_html', 'full_html')), 'Correct attachments when one text editor is enabled and retrieving attachments for multiple text formats.');
=======
    ];
    $this->assertIdentical($expected, $this->editorManager->getAttachments(['filtered_html', 'full_html']), 'Correct attachments when one text editor is enabled and retrieving attachments for multiple text formats.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Case 4: a text editor available associated, but now with its JS settings
    // being altered via hook_editor_js_settings_alter().
    \Drupal::state()->set('editor_test_js_settings_alter_enabled', TRUE);
    $expected['drupalSettings']['editor']['formats']['full_html']['editorSettings']['ponyModeEnabled'] = FALSE;
<<<<<<< HEAD
    $this->assertIdentical($expected, $this->editorManager->getAttachments(array('filtered_html', 'full_html')), 'hook_editor_js_settings_alter() works correctly.');
=======
    $this->assertIdentical($expected, $this->editorManager->getAttachments(['filtered_html', 'full_html']), 'hook_editor_js_settings_alter() works correctly.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
