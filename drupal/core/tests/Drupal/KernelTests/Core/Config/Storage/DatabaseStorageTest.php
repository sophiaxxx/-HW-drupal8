<?php

namespace Drupal\KernelTests\Core\Config\Storage;

use Drupal\Core\Config\DatabaseStorage;

/**
 * Tests DatabaseStorage operations.
 *
 * @group config
 */
class DatabaseStorageTest extends ConfigStorageTestBase {

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->storage = new DatabaseStorage($this->container->get('database'), 'config');
    $this->invalidStorage = new DatabaseStorage($this->container->get('database'), 'invalid');

    // ::listAll() verifications require other configuration data to exist.
<<<<<<< HEAD
    $this->storage->write('system.performance', array());
  }

  protected function read($name) {
    $data = db_query('SELECT data FROM {config} WHERE name = :name', array(':name' => $name))->fetchField();
=======
    $this->storage->write('system.performance', []);
  }

  protected function read($name) {
    $data = db_query('SELECT data FROM {config} WHERE name = :name', [':name' => $name])->fetchField();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return unserialize($data);
  }

  protected function insert($name, $data) {
<<<<<<< HEAD
    db_insert('config')->fields(array('name' => $name, 'data' => $data))->execute();
  }

  protected function update($name, $data) {
    db_update('config')->fields(array('data' => $data))->condition('name', $name)->execute();
=======
    db_insert('config')->fields(['name' => $name, 'data' => $data])->execute();
  }

  protected function update($name, $data) {
    db_update('config')->fields(['data' => $data])->condition('name', $name)->execute();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  protected function delete($name) {
    db_delete('config')->condition('name', $name)->execute();
  }

}
