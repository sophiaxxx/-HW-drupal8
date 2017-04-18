<?php

namespace Drupal\KernelTests\Core\Database;

/**
 * Tests serializing and unserializing a query.
 *
 * @group Database
 */
class SerializeQueryTest extends DatabaseTestBase {
  /**
   * Confirms that a query can be serialized and unserialized.
   */
<<<<<<< HEAD
  function testSerializeQuery() {
=======
  public function testSerializeQuery() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test');
    $query->addField('test', 'age');
    $query->condition('name', 'Ringo');
    // If this doesn't work, it will throw an exception, so no need for an
    // assertion.
    $query = unserialize(serialize($query));
    $results = $query->execute()->fetchCol();
    $this->assertEqual($results[0], 28, 'Query properly executed after unserialization.');
  }

}
