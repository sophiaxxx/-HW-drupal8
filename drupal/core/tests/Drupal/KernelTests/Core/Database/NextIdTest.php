<?php

namespace Drupal\KernelTests\Core\Database;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests the sequences API.
 *
 * @group Database
 */
class NextIdTest extends KernelTestBase {

  /**
   * The modules to enable.
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('system');
=======
  public static $modules = ['system'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();
    $this->installSchema('system', 'sequences');
  }

  /**
   * Tests that the sequences API works.
   */
<<<<<<< HEAD
  function testDbNextId() {
=======
  public function testDbNextId() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $first = db_next_id();
    $second = db_next_id();
    // We can test for exact increase in here because we know there is no
    // other process operating on these tables -- normally we could only
    // expect $second > $first.
    $this->assertEqual($first + 1, $second, 'The second call from a sequence provides a number increased by one.');
    $result = db_next_id(1000);
    $this->assertEqual($result, 1001, 'Sequence provides a larger number than the existing ID.');
  }

}
