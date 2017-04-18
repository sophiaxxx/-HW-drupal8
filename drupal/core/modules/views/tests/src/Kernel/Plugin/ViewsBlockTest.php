<?php

namespace Drupal\Tests\views\Kernel\Plugin;

use Drupal\views\Plugin\Block\ViewsBlock;
use Drupal\views\Tests\ViewTestData;
use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
<<<<<<< HEAD
=======
use Drupal\views\Views;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

/**
 * Tests native behaviors of the block views plugin.
 *
 * @group views
 */
class ViewsBlockTest extends ViewsKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('block', 'block_test_views');
=======
  public static $modules = ['block', 'block_test_views'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_view_block');
=======
  public static $testViews = ['test_view_block'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp($import_test_views = TRUE) {
    parent::setUp();

<<<<<<< HEAD
    ViewTestData::createTestViews(get_class($this), array('block_test_views'));
=======
    ViewTestData::createTestViews(get_class($this), ['block_test_views']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests that ViewsBlock::getMachineNameSuggestion() produces the right value.
   *
   * @see \Drupal\views\Plugin\Block::getmachineNameSuggestion()
   */
  public function testMachineNameSuggestion() {
<<<<<<< HEAD
    $plugin_definition = array(
      'provider' => 'views',
    );
    $plugin_id = 'views_block:test_view_block-block_1';
    $views_block = ViewsBlock::create($this->container, array(), $plugin_id, $plugin_definition);
=======
    $plugin_definition = [
      'provider' => 'views',
    ];
    $plugin_id = 'views_block:test_view_block-block_1';
    $views_block = ViewsBlock::create($this->container, [], $plugin_id, $plugin_definition);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertEqual($views_block->getMachineNameSuggestion(), 'views_block__test_view_block_block_1');
  }

<<<<<<< HEAD
=======
  /**
   * Tests that ViewsBlock::build() produces the right output with title tokens.
   *
   * @see \Drupal\views\Plugin\Block::build()
   */
  public function testBuildWithTitleToken() {
    $view = Views::getView('test_view_block');
    $view->setDisplay();

    $sorts = [
      'name' => [
        'id' => 'name',
        'field' => 'name',
        'table' => 'views_test_data',
        'plugin_id' => 'standard',
        'order' => 'asc',
      ],
    ];
    // Set the title to the 'name' field in the first row and add a sort order
    // for consistent results on different databases.
    $view->display_handler->setOption('title', '{{ name }}');
    $view->display_handler->setOption('sorts', $sorts);
    $view->save();

    $plugin_definition = [
      'provider' => 'views',
    ];
    $plugin_id = 'views_block:test_view_block-block_1';
    $views_block = ViewsBlock::create($this->container, [], $plugin_id, $plugin_definition);

    $build = $views_block->build();
    $this->assertEquals('George', $build['#title']['#markup']);
  }

  /**
   * Tests ViewsBlock::build() with a title override.
   *
   * @see \Drupal\views\Plugin\Block::build()
   */
  public function testBuildWithTitleOverride() {
    $view = Views::getView('test_view_block');
    $view->setDisplay();

    // Add a fixed argument that sets a title and save the view.
    $view->displayHandlers->get('default')->overrideOption('arguments', [
      'name' => [
        'default_action' => 'default',
        'title_enable' => TRUE,
        'title' => 'Overridden title',
        'default_argument_type' => 'fixed',
        'default_argument_options' => [
          'argument' => 'fixed'
        ],
        'validate' => [
          'type' => 'none',
          'fail' => 'not found',
        ],
        'id' => 'name',
        'table' => 'views_test_data',
        'field' => 'name',
        'plugin_id' => 'string',
      ]
    ]);
    $view->save();

    $plugin_definition = [
      'provider' => 'views',
    ];
    $plugin_id = 'views_block:test_view_block-block_1';
    $views_block = ViewsBlock::create($this->container, [], $plugin_id, $plugin_definition);

    $build = $views_block->build();
    $this->assertEquals('Overridden title', $build['#title']['#markup']);
  }

>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
}
