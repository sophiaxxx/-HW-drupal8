<?php

namespace Drupal\KernelTests\Core\Database;

/**
 * Tests the Update query builder with LOB fields.
 *
 * @group Database
 */
class UpdateLobTest extends DatabaseTestBase {

  /**
   * Confirms that we can update a blob column.
   */
<<<<<<< HEAD
  function testUpdateOneBlob() {
    $data = "This is\000a test.";
    $this->assertTrue(strlen($data) === 15, 'Test data contains a NULL.');
    $id = db_insert('test_one_blob')
      ->fields(array('blob1' => $data))
=======
  public function testUpdateOneBlob() {
    $data = "This is\000a test.";
    $this->assertTrue(strlen($data) === 15, 'Test data contains a NULL.');
    $id = db_insert('test_one_blob')
      ->fields(['blob1' => $data])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    $data .= $data;
    db_update('test_one_blob')
      ->condition('id', $id)
<<<<<<< HEAD
      ->fields(array('blob1' => $data))
      ->execute();

    $r = db_query('SELECT * FROM {test_one_blob} WHERE id = :id', array(':id' => $id))->fetchAssoc();
    $this->assertTrue($r['blob1'] === $data, format_string('Can update a blob: id @id, @data.', array('@id' => $id, '@data' => serialize($r))));
=======
      ->fields(['blob1' => $data])
      ->execute();

    $r = db_query('SELECT * FROM {test_one_blob} WHERE id = :id', [':id' => $id])->fetchAssoc();
    $this->assertTrue($r['blob1'] === $data, format_string('Can update a blob: id @id, @data.', ['@id' => $id, '@data' => serialize($r)]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Confirms that we can update two blob columns in the same table.
   */
<<<<<<< HEAD
  function testUpdateMultipleBlob() {
    $id = db_insert('test_two_blobs')
      ->fields(array(
        'blob1' => 'This is',
        'blob2' => 'a test',
      ))
=======
  public function testUpdateMultipleBlob() {
    $id = db_insert('test_two_blobs')
      ->fields([
        'blob1' => 'This is',
        'blob2' => 'a test',
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    db_update('test_two_blobs')
      ->condition('id', $id)
<<<<<<< HEAD
      ->fields(array('blob1' => 'and so', 'blob2' => 'is this'))
      ->execute();

    $r = db_query('SELECT * FROM {test_two_blobs} WHERE id = :id', array(':id' => $id))->fetchAssoc();
=======
      ->fields(['blob1' => 'and so', 'blob2' => 'is this'])
      ->execute();

    $r = db_query('SELECT * FROM {test_two_blobs} WHERE id = :id', [':id' => $id])->fetchAssoc();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($r['blob1'] === 'and so' && $r['blob2'] === 'is this', 'Can update multiple blobs per row.');
  }

}
