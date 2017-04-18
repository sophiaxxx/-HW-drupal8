<?php

namespace Drupal\KernelTests\Core\Config;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests configuration entity status functionality.
 *
 * @group config
 */
class ConfigEntityStatusTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('config_test');
=======
  public static $modules = ['config_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests the enabling/disabling of entities.
   */
<<<<<<< HEAD
  function testCRUD() {
    $entity = entity_create('config_test', array(
      'id' => strtolower($this->randomMachineName()),
    ));
=======
  public function testCRUD() {
    $entity = entity_create('config_test', [
      'id' => strtolower($this->randomMachineName()),
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($entity->status(), 'Default status is enabled.');
    $entity->save();
    $this->assertTrue($entity->status(), 'Status is enabled after saving.');

    $entity->disable()->save();
    $this->assertFalse($entity->status(), 'Entity is disabled after disabling.');

    $entity->enable()->save();
    $this->assertTrue($entity->status(), 'Entity is enabled after enabling.');

    $entity = entity_load('config_test', $entity->id());
    $this->assertTrue($entity->status(), 'Status is enabled after reload.');
  }

}
