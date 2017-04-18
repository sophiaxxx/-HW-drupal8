<?php

namespace Drupal\Tests\block\Kernel;

<<<<<<< HEAD
=======
use Drupal\Core\Block\BlockPluginInterface;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Core\Config\Entity\ConfigEntityStorage;
use Drupal\KernelTests\KernelTestBase;
use Drupal\block_test\Plugin\Block\TestHtmlBlock;
use Drupal\Component\Plugin\Exception\PluginException;
use Drupal\block\Entity\Block;
<<<<<<< HEAD
use Drupal\block\BlockInterface;
=======
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

/**
 * Tests the storage of blocks.
 *
 * @group block
 */
class BlockStorageUnitTest extends KernelTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('block', 'block_test', 'system');
=======
  public static $modules = ['block', 'block_test', 'system'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The block storage.
   *
   * @var \Drupal\Core\Config\Entity\ConfigEntityStorageInterface.
   */
  protected $controller;

  protected function setUp() {
    parent::setUp();

    $this->controller = $this->container->get('entity_type.manager')->getStorage('block');
<<<<<<< HEAD
=======

    $this->container->get('theme_installer')->install(['stark']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests CRUD operations.
   */
  public function testBlockCRUD() {
    $this->assertTrue($this->controller instanceof ConfigEntityStorage, 'The block storage is loaded.');

    // Run each test method in the same installation.
    $this->createTests();
    $this->loadTests();
    $this->deleteTests();
  }

  /**
   * Tests the creation of blocks.
   */
  protected function createTests() {
    // Attempt to create a block without a plugin.
    try {
<<<<<<< HEAD
      $entity = $this->controller->create(array());
=======
      $entity = $this->controller->create([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $entity->getPlugin();
      $this->fail('A block without a plugin was created with no exception thrown.');
    }
    catch (PluginException $e) {
      $this->assertEqual('The block \'\' did not specify a plugin.', $e->getMessage(), 'An exception was thrown when a block was created without a plugin.');
    }

    // Create a block with only required values.
<<<<<<< HEAD
    $entity = $this->controller->create(array(
      'id' => 'test_block',
      'theme' => 'stark',
      'plugin' => 'test_html',
    ));
=======
    $entity = $this->controller->create([
      'id' => 'test_block',
      'theme' => 'stark',
      'region' => 'content',
      'plugin' => 'test_html',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity->save();

    $this->assertTrue($entity instanceof Block, 'The newly created entity is a Block.');

    // Verify all of the block properties.
    $actual_properties = $this->config('block.block.test_block')->get();
    $this->assertTrue(!empty($actual_properties['uuid']), 'The block UUID is set.');
    unset($actual_properties['uuid']);

    // Ensure that default values are filled in.
<<<<<<< HEAD
    $expected_properties = array(
      'langcode' => \Drupal::languageManager()->getDefaultLanguage()->getId(),
      'status' => TRUE,
      'dependencies' => array('module' => array('block_test'), 'theme' => array('stark')),
      'id' => 'test_block',
      'theme' => 'stark',
      'region' => '-1',
      'weight' => NULL,
      'provider' => NULL,
      'plugin' => 'test_html',
      'settings' => array(
        'id' => 'test_html',
        'label' => '',
        'provider' => 'block_test',
        'label_display' => BlockInterface::BLOCK_LABEL_VISIBLE,
      ),
      'visibility' => array(),
    );
=======
    $expected_properties = [
      'langcode' => \Drupal::languageManager()->getDefaultLanguage()->getId(),
      'status' => TRUE,
      'dependencies' => ['module' => ['block_test'], 'theme' => ['stark']],
      'id' => 'test_block',
      'theme' => 'stark',
      'region' => 'content',
      'weight' => NULL,
      'provider' => NULL,
      'plugin' => 'test_html',
      'settings' => [
        'id' => 'test_html',
        'label' => '',
        'provider' => 'block_test',
        'label_display' => BlockPluginInterface::BLOCK_LABEL_VISIBLE,
      ],
      'visibility' => [],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->assertIdentical($actual_properties, $expected_properties);

    $this->assertTrue($entity->getPlugin() instanceof TestHtmlBlock, 'The entity has an instance of the correct block plugin.');
  }

  /**
   * Tests the loading of blocks.
   */
  protected function loadTests() {
    $entity = $this->controller->load('test_block');

    $this->assertTrue($entity instanceof Block, 'The loaded entity is a Block.');

    // Verify several properties of the block.
<<<<<<< HEAD
    $this->assertEqual($entity->getRegion(), '-1');
=======
    $this->assertSame('content', $entity->getRegion());
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($entity->status());
    $this->assertEqual($entity->getTheme(), 'stark');
    $this->assertTrue($entity->uuid());
  }

  /**
   * Tests the deleting of blocks.
   */
  protected function deleteTests() {
    $entity = $this->controller->load('test_block');

    // Ensure that the storage isn't currently empty.
    $config_storage = $this->container->get('config.storage');
    $config = $config_storage->listAll('block.block.');
    $this->assertFalse(empty($config), 'There are blocks in config storage.');

    // Delete the block.
    $entity->delete();

    // Ensure that the storage is now empty.
    $config = $config_storage->listAll('block.block.');
    $this->assertTrue(empty($config), 'There are no blocks in config storage.');
  }

  /**
   * Tests the installation of default blocks.
   */
  public function testDefaultBlocks() {
    \Drupal::service('theme_handler')->install(['classy']);
    $entities = $this->controller->loadMultiple();
    $this->assertTrue(empty($entities), 'There are no blocks initially.');

    // Install the block_test.module, so that its default config is installed.
<<<<<<< HEAD
    $this->installConfig(array('block_test'));
=======
    $this->installConfig(['block_test']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $entities = $this->controller->loadMultiple();
    $entity = reset($entities);
    $this->assertEqual($entity->id(), 'test_block', 'The default test block was loaded.');
  }

}
