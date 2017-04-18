<?php

namespace Drupal\Tests\block\Kernel;

use Drupal\block\Entity\Block;
<<<<<<< HEAD
use Drupal\config\Tests\SchemaCheckTestTrait;
=======
use Drupal\Tests\SchemaCheckTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests the block config schema.
 *
 * @group block
 */
class BlockConfigSchemaTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array(
=======
  public static $modules = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    'block',
    'aggregator',
    'book',
    'block_content',
    'comment',
    'forum',
    'node',
    'statistics',
    // BlockManager->getModuleName() calls system_get_info().
    'system',
    'taxonomy',
    'user',
    'text',
<<<<<<< HEAD
  );
=======
  ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * The block manager.
   *
   * @var \Drupal\Core\Block\BlockManagerInterface
   */
  protected $blockManager;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->typedConfig = \Drupal::service('config.typed');
    $this->blockManager = \Drupal::service('plugin.manager.block');
    $this->installEntitySchema('block_content');
    $this->installEntitySchema('taxonomy_term');
    $this->installEntitySchema('node');
<<<<<<< HEAD
    $this->installSchema('book', array('book'));
=======
    $this->installSchema('book', ['book']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests the block config schema for block plugins.
   */
  public function testBlockConfigSchema() {
    foreach ($this->blockManager->getDefinitions() as $block_id => $definition) {
      $id = strtolower($this->randomMachineName());
<<<<<<< HEAD
      $block = Block::create(array(
=======
      $block = Block::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'id' => $id,
        'theme' => 'classy',
        'weight' => 00,
        'status' => TRUE,
        'region' => 'content',
        'plugin' => $block_id,
<<<<<<< HEAD
        'settings' => array(
          'label' => $this->randomMachineName(),
          'provider' => 'system',
          'label_display' => FALSE,
        ),
        'visibility' => array(),
      ));
=======
        'settings' => [
          'label' => $this->randomMachineName(),
          'provider' => 'system',
          'label_display' => FALSE,
        ],
        'visibility' => [],
      ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $block->save();

      $config = $this->config("block.block.$id");
      $this->assertEqual($config->get('id'), $id);
      $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
    }
  }

}
