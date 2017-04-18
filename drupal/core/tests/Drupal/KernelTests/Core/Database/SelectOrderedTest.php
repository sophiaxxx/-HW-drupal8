<?php

namespace Drupal\KernelTests\Core\Database;

/**
 * Tests the Select query builder.
 *
 * @group Database
 */
class SelectOrderedTest extends DatabaseTestBase {

  /**
   * Tests basic ORDER BY.
   */
<<<<<<< HEAD
  function testSimpleSelectOrdered() {
=======
  public function testSimpleSelectOrdered() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test');
    $query->addField('test', 'name');
    $age_field = $query->addField('test', 'age', 'age');
    $query->orderBy($age_field);
    $result = $query->execute();

    $num_records = 0;
    $last_age = 0;
    foreach ($result as $record) {
      $num_records++;
      $this->assertTrue($record->age >= $last_age, 'Results returned in correct order.');
      $last_age = $record->age;
    }

    $this->assertEqual($num_records, 4, 'Returned the correct number of rows.');
  }

  /**
   * Tests multiple ORDER BY.
   */
<<<<<<< HEAD
  function testSimpleSelectMultiOrdered() {
=======
  public function testSimpleSelectMultiOrdered() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test');
    $query->addField('test', 'name');
    $age_field = $query->addField('test', 'age', 'age');
    $job_field = $query->addField('test', 'job');
    $query->orderBy($job_field);
    $query->orderBy($age_field);
    $result = $query->execute();

    $num_records = 0;
<<<<<<< HEAD
    $expected = array(
      array('Ringo', 28, 'Drummer'),
      array('John', 25, 'Singer'),
      array('George', 27, 'Singer'),
      array('Paul', 26, 'Songwriter'),
    );
=======
    $expected = [
      ['Ringo', 28, 'Drummer'],
      ['John', 25, 'Singer'],
      ['George', 27, 'Singer'],
      ['Paul', 26, 'Songwriter'],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $results = $result->fetchAll(\PDO::FETCH_NUM);
    foreach ($expected as $k => $record) {
      $num_records++;
      foreach ($record as $kk => $col) {
        if ($expected[$k][$kk] != $results[$k][$kk]) {
          $this->assertTrue(FALSE, 'Results returned in correct order.');
        }
      }
    }
    $this->assertEqual($num_records, 4, 'Returned the correct number of rows.');
  }

  /**
   * Tests ORDER BY descending.
   */
<<<<<<< HEAD
  function testSimpleSelectOrderedDesc() {
=======
  public function testSimpleSelectOrderedDesc() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query = db_select('test');
    $query->addField('test', 'name');
    $age_field = $query->addField('test', 'age', 'age');
    $query->orderBy($age_field, 'DESC');
    $result = $query->execute();

    $num_records = 0;
    $last_age = 100000000;
    foreach ($result as $record) {
      $num_records++;
      $this->assertTrue($record->age <= $last_age, 'Results returned in correct order.');
      $last_age = $record->age;
    }

    $this->assertEqual($num_records, 4, 'Returned the correct number of rows.');
  }

}
