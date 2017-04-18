<?php

namespace Drupal\Tests\views\Kernel\Handler;

<<<<<<< HEAD
use Drupal\block\Entity\Block;
=======
use Drupal\simpletest\BlockCreationTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Tests\views\Kernel\ViewsKernelTestBase;
use Drupal\views\Views;

/**
 * Tests the view area handler.
 *
 * @group views
 * @see \Drupal\views\Plugin\views\area\View
 */
class AreaOrderTest extends ViewsKernelTestBase {

<<<<<<< HEAD
=======
  use BlockCreationTrait;

>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('user', 'block');
=======
  public static $modules = ['user', 'block'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Views used by this test.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $testViews = array('test_area_order');
=======
  public static $testViews = ['test_area_order'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUpFixtures() {
<<<<<<< HEAD
    Block::create(
      [
        'id' => 'bartik_branding',
        'theme' => 'bartik',
        'plugin' => 'system_branding_block',
        'weight' => 1,
      ]
    )->save();

    Block::create(
      [
        'id' => 'bartik_powered',
        'theme' => 'bartik',
        'plugin' => 'system_powered_by_block',
        'weight' => 2,
      ]
    )->save();
=======
    // Install the themes used for this test.
    $this->container->get('theme_installer')->install(['bartik']);

    $this->placeBlock('system_branding_block', [
      'id' => 'bartik_branding',
      'theme' => 'bartik',
      'plugin' => 'system_branding_block',
      'weight' => 1,
    ]);

    $this->placeBlock('system_powered_by_block', [
      'id' => 'bartik_powered',
      'theme' => 'bartik',
      'weight' => 2,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    parent::setUpFixtures();
  }

  /**
   * Tests the order of the handlers.
   */
  public function testAreaOrder() {
    $renderer = $this->container->get('renderer');
    $view = Views::getView('test_area_order');
    $renderable = $view->buildRenderable();
    $output = $this->render($renderable);

    $position_powered = strpos($output, 'block-bartik-powered');
    $position_branding = strpos($output, 'block-bartik-branding');

    $this->assertNotEquals(0, $position_powered, 'ID bartik-powered found.');
    $this->assertNotEquals(0, $position_branding, 'ID bartik-branding found');

    // Make sure "powered" is before "branding", so it reflects the position
    // in the configuration, and not the weight of the blocks.
    $this->assertTrue($position_powered < $position_branding, 'Block bartik-powered is positioned before block bartik-branding');
  }

}
