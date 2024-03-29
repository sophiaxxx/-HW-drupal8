<?php

namespace Drupal\KernelTests\Core\Database;

/**
 * Tests SQL syntax interpretation.
 *
 * In order to ensure consistent SQL handling throughout Drupal
 * across multiple kinds of database systems, we test that the
 * database system interprets SQL syntax in an expected fashion.
 *
 * @group Database
 */
class BasicSyntaxTest extends DatabaseTestBase {
  /**
   * Tests string concatenation.
   */
<<<<<<< HEAD
  function testConcatLiterals() {
    $result = db_query('SELECT CONCAT(:a1, CONCAT(:a2, CONCAT(:a3, CONCAT(:a4, :a5))))', array(
=======
  public function testConcatLiterals() {
    $result = db_query('SELECT CONCAT(:a1, CONCAT(:a2, CONCAT(:a3, CONCAT(:a4, :a5))))', [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ':a1' => 'This',
      ':a2' => ' ',
      ':a3' => 'is',
      ':a4' => ' a ',
      ':a5' => 'test.',
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($result->fetchField(), 'This is a test.', 'Basic CONCAT works.');
  }

  /**
   * Tests string concatenation with field values.
   */
<<<<<<< HEAD
  function testConcatFields() {
    $result = db_query('SELECT CONCAT(:a1, CONCAT(name, CONCAT(:a2, CONCAT(age, :a3)))) FROM {test} WHERE age = :age', array(
=======
  public function testConcatFields() {
    $result = db_query('SELECT CONCAT(:a1, CONCAT(name, CONCAT(:a2, CONCAT(age, :a3)))) FROM {test} WHERE age = :age', [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ':a1' => 'The age of ',
      ':a2' => ' is ',
      ':a3' => '.',
      ':age' => 25,
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($result->fetchField(), 'The age of John is 25.', 'Field CONCAT works.');
  }

  /**
   * Tests string concatenation with separator.
   */
<<<<<<< HEAD
  function testConcatWsLiterals() {
    $result = db_query("SELECT CONCAT_WS(', ', :a1, NULL, :a2, :a3, :a4)", array(
=======
  public function testConcatWsLiterals() {
    $result = db_query("SELECT CONCAT_WS(', ', :a1, NULL, :a2, :a3, :a4)", [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ':a1' => 'Hello',
      ':a2' => NULL,
      ':a3' => '',
      ':a4' => 'world.',
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($result->fetchField(), 'Hello, , world.');
  }

  /**
   * Tests string concatenation with separator, with field values.
   */
<<<<<<< HEAD
  function testConcatWsFields() {
    $result = db_query("SELECT CONCAT_WS('-', :a1, name, :a2, age) FROM {test} WHERE age = :age", array(
      ':a1' => 'name',
      ':a2' => 'age',
      ':age' => 25,
    ));
=======
  public function testConcatWsFields() {
    $result = db_query("SELECT CONCAT_WS('-', :a1, name, :a2, age) FROM {test} WHERE age = :age", [
      ':a1' => 'name',
      ':a2' => 'age',
      ':age' => 25,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($result->fetchField(), 'name-John-age-25');
  }

  /**
   * Tests escaping of LIKE wildcards.
   */
<<<<<<< HEAD
  function testLikeEscape() {
    db_insert('test')
      ->fields(array(
        'name' => 'Ring_',
      ))
=======
  public function testLikeEscape() {
    db_insert('test')
      ->fields([
        'name' => 'Ring_',
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    // Match both "Ringo" and "Ring_".
    $num_matches = db_select('test', 't')
      ->condition('name', 'Ring_', 'LIKE')
      ->countQuery()
      ->execute()
      ->fetchField();
    $this->assertIdentical($num_matches, '2', 'Found 2 records.');
    // Match only "Ring_" using a LIKE expression with no wildcards.
    $num_matches = db_select('test', 't')
      ->condition('name', db_like('Ring_'), 'LIKE')
      ->countQuery()
      ->execute()
      ->fetchField();
    $this->assertIdentical($num_matches, '1', 'Found 1 record.');
  }

  /**
   * Tests a LIKE query containing a backslash.
   */
<<<<<<< HEAD
  function testLikeBackslash() {
    db_insert('test')
      ->fields(array('name'))
      ->values(array(
        'name' => 'abcde\f',
      ))
      ->values(array(
        'name' => 'abc%\_',
      ))
=======
  public function testLikeBackslash() {
    db_insert('test')
      ->fields(['name'])
      ->values([
        'name' => 'abcde\f',
      ])
      ->values([
        'name' => 'abc%\_',
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->execute();

    // Match both rows using a LIKE expression with two wildcards and a verbatim
    // backslash.
    $num_matches = db_select('test', 't')
      ->condition('name', 'abc%\\\\_', 'LIKE')
      ->countQuery()
      ->execute()
      ->fetchField();
    $this->assertIdentical($num_matches, '2', 'Found 2 records.');
    // Match only the former using a LIKE expression with no wildcards.
    $num_matches = db_select('test', 't')
      ->condition('name', db_like('abc%\_'), 'LIKE')
      ->countQuery()
      ->execute()
      ->fetchField();
    $this->assertIdentical($num_matches, '1', 'Found 1 record.');
  }

  /**
   * Tests \Drupal\Core\Database\Connection::getFullQualifiedTableName().
   */
  public function testGetFullQualifiedTableName() {
    $database = \Drupal::database();
    $num_matches = $database->select($database->getFullQualifiedTableName('test'), 't')
      ->countQuery()
      ->execute()
      ->fetchField();
    $this->assertIdentical($num_matches, '4', 'Found 4 records.');
  }

}
