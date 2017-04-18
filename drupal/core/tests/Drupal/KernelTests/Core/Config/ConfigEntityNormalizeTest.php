<?php

namespace Drupal\KernelTests\Core\Config;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests the listing of configuration entities.
 *
 * @group config
 */
class ConfigEntityNormalizeTest extends KernelTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('config_test');
=======
  public static $modules = ['config_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();
    $this->installConfig(static::$modules);
  }

  public function testNormalize() {
<<<<<<< HEAD
    $config_entity = entity_create('config_test', array('id' => 'system', 'label' => 'foobar', 'weight' => 1));
=======
    $config_entity = entity_create('config_test', ['id' => 'system', 'label' => 'foobar', 'weight' => 1]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $config_entity->save();

    // Modify stored config entity, this is comparable with a schema change.
    $config = $this->config('config_test.dynamic.system');
<<<<<<< HEAD
    $data = array(
      'label' => 'foobar',
      'additional_key' => TRUE
    ) + $config->getRawData();
=======
    $data = [
      'label' => 'foobar',
      'additional_key' => TRUE
    ] + $config->getRawData();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $config->setData($data)->save();
    $this->assertNotIdentical($config_entity->toArray(), $config->getRawData(), 'Stored config entity is not is equivalent to config schema.');

    $config_entity = entity_load('config_test', 'system', TRUE);
    $config_entity->save();

    $config = $this->config('config_test.dynamic.system');
    $this->assertIdentical($config_entity->toArray(), $config->getRawData(), 'Stored config entity is equivalent to config schema.');
  }

}
