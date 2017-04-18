<?php

namespace Drupal\Tests\tour\Kernel;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests the functionality of tour plugins.
 *
 * @group tour
 */
class TourPluginTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('tour');
=======
  public static $modules = ['tour'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Stores the tour plugin manager.
   *
   * @var \Drupal\tour\TipPluginManager
   */
  protected $pluginManager;

  protected function setUp() {
    parent::setUp();

<<<<<<< HEAD
    $this->installConfig(array('tour'));
=======
    $this->installConfig(['tour']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->pluginManager = $this->container->get('plugin.manager.tour.tip');
  }

  /**
   * Test tour plugins.
   */
  public function testTourPlugins() {
    $this->assertIdentical(count($this->pluginManager->getDefinitions()), 1, 'Only tour plugins for the enabled modules were returned.');
  }

}
