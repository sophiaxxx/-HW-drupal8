<?php

namespace Drupal\Tests\search\Kernel;

use Drupal\Core\Language\LanguageInterface;
use Drupal\KernelTests\KernelTestBase;

/**
 * Indexes content and queries it.
 *
 * @group search
 */
class SearchMatchTest extends KernelTestBase {

  // The search index can contain different types of content. Typically the type
  // is 'node'. Here we test with _test_ and _test2_ as the type.
  const SEARCH_TYPE = '_test_';
  const SEARCH_TYPE_2 = '_test2_';
  const SEARCH_TYPE_JPN = '_test3_';

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['search'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->installSchema('search', ['search_index', 'search_dataset', 'search_total']);
    $this->installConfig(['search']);
  }

  /**
   * Test search indexing.
   */
<<<<<<< HEAD
  function testMatching() {
=======
  public function testMatching() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->_setup();
    $this->_testQueries();
  }

  /**
   * Set up a small index of items to test against.
   */
<<<<<<< HEAD
  function _setup() {
=======
  public function _setup() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->config('search.settings')->set('index.minimum_word_size', 3)->save();

    for ($i = 1; $i <= 7; ++$i) {
      search_index(static::SEARCH_TYPE, $i, LanguageInterface::LANGCODE_NOT_SPECIFIED, $this->getText($i));
    }
    for ($i = 1; $i <= 5; ++$i) {
      search_index(static::SEARCH_TYPE_2, $i + 7, LanguageInterface::LANGCODE_NOT_SPECIFIED, $this->getText2($i));
    }
    // No getText builder function for Japanese text; just a simple array.
<<<<<<< HEAD
    foreach (array(
      13 => '以呂波耳・ほへとち。リヌルヲ。',
      14 => 'ドルーパルが大好きよ！',
      15 => 'コーヒーとケーキ',
    ) as $i => $jpn) {
=======
    foreach ([
      13 => '以呂波耳・ほへとち。リヌルヲ。',
      14 => 'ドルーパルが大好きよ！',
      15 => 'コーヒーとケーキ',
    ] as $i => $jpn) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      search_index(static::SEARCH_TYPE_JPN, $i, LanguageInterface::LANGCODE_NOT_SPECIFIED, $jpn);
    }
    search_update_totals();
  }

  /**
   * _test_: Helper method for generating snippets of content.
   *
   * Generated items to test against:
   *   1  ipsum
   *   2  dolore sit
   *   3  sit am ut
   *   4  am ut enim am
   *   5  ut enim am minim veniam
   *   6  enim am minim veniam es cillum
   *   7  am minim veniam es cillum dolore eu
   */
<<<<<<< HEAD
  function getText($n) {
=======
  public function getText($n) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $words = explode(' ', "Ipsum dolore sit am. Ut enim am minim veniam. Es cillum dolore eu.");
    return implode(' ', array_slice($words, $n - 1, $n));
  }

  /**
   * _test2_: Helper method for generating snippets of content.
   *
   * Generated items to test against:
   *   8  dear
   *   9  king philip
   *   10 philip came over
   *   11 came over from germany
   *   12 over from germany swimming
   */
<<<<<<< HEAD
  function getText2($n) {
=======
  public function getText2($n) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $words = explode(' ', "Dear King Philip came over from Germany swimming.");
    return implode(' ', array_slice($words, $n - 1, $n));
  }

  /**
   * Run predefine queries looking for indexed terms.
   */
<<<<<<< HEAD
  function _testQueries() {
=======
  public function _testQueries() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Note: OR queries that include short words in OR groups are only accepted
    // if the ORed terms are ANDed with at least one long word in the rest of
    // the query. Examples:
    //   enim dolore OR ut = enim (dolore OR ut) = (enim dolor) OR (enim ut)
    // is good, and
    //   dolore OR ut = (dolore) OR (ut)
    // is bad. This is a design limitation to avoid full table scans.
<<<<<<< HEAD
    $queries = array(
      // Simple AND queries.
      'ipsum' => array(1),
      'enim' => array(4, 5, 6),
      'xxxxx' => array(),
      'enim minim' => array(5, 6),
      'enim xxxxx' => array(),
      'dolore eu' => array(7),
      'dolore xx' => array(),
      'ut minim' => array(5),
      'xx minim' => array(),
      'enim veniam am minim ut' => array(5),
      // Simple OR and AND/OR queries.
      'dolore OR ipsum' => array(1, 2, 7),
      'dolore OR xxxxx' => array(2, 7),
      'dolore OR ipsum OR enim' => array(1, 2, 4, 5, 6, 7),
      'ipsum OR dolore sit OR cillum' => array(2, 7),
      'minim dolore OR ipsum' => array(7),
      'dolore OR ipsum veniam' => array(7),
      'minim dolore OR ipsum OR enim' => array(5, 6, 7),
      'dolore xx OR yy' => array(),
      'xxxxx dolore OR ipsum' => array(),
      // Sequence of OR queries.
      'minim' => array(5, 6, 7),
      'minim OR xxxx' => array(5, 6, 7),
      'minim OR xxxx OR minim' => array(5, 6, 7),
      'minim OR xxxx minim' => array(5, 6, 7),
      'minim OR xxxx minim OR yyyy' => array(5, 6, 7),
      'minim OR xxxx minim OR cillum' => array(6, 7, 5),
      'minim OR xxxx minim OR xxxx' => array(5, 6, 7),
      // Negative queries.
      'dolore -sit' => array(7),
      'dolore -eu' => array(2),
      'dolore -xxxxx' => array(2, 7),
      'dolore -xx' => array(2, 7),
      // Phrase queries.
      '"dolore sit"' => array(2),
      '"sit dolore"' => array(),
      '"am minim veniam es"' => array(6, 7),
      '"minim am veniam es"' => array(),
      // Mixed queries.
      '"am minim veniam es" OR dolore' => array(2, 6, 7),
      '"minim am veniam es" OR "dolore sit"' => array(2),
      '"minim am veniam es" OR "sit dolore"' => array(),
      '"am minim veniam es" -eu' => array(6),
      '"am minim veniam" -"cillum dolore"' => array(5, 6),
      '"am minim veniam" -"dolore cillum"' => array(5, 6, 7),
      'xxxxx "minim am veniam es" OR dolore' => array(),
      'xx "minim am veniam es" OR dolore' => array()
    );
=======
    $queries = [
      // Simple AND queries.
      'ipsum' => [1],
      'enim' => [4, 5, 6],
      'xxxxx' => [],
      'enim minim' => [5, 6],
      'enim xxxxx' => [],
      'dolore eu' => [7],
      'dolore xx' => [],
      'ut minim' => [5],
      'xx minim' => [],
      'enim veniam am minim ut' => [5],
      // Simple OR and AND/OR queries.
      'dolore OR ipsum' => [1, 2, 7],
      'dolore OR xxxxx' => [2, 7],
      'dolore OR ipsum OR enim' => [1, 2, 4, 5, 6, 7],
      'ipsum OR dolore sit OR cillum' => [2, 7],
      'minim dolore OR ipsum' => [7],
      'dolore OR ipsum veniam' => [7],
      'minim dolore OR ipsum OR enim' => [5, 6, 7],
      'dolore xx OR yy' => [],
      'xxxxx dolore OR ipsum' => [],
      // Sequence of OR queries.
      'minim' => [5, 6, 7],
      'minim OR xxxx' => [5, 6, 7],
      'minim OR xxxx OR minim' => [5, 6, 7],
      'minim OR xxxx minim' => [5, 6, 7],
      'minim OR xxxx minim OR yyyy' => [5, 6, 7],
      'minim OR xxxx minim OR cillum' => [6, 7, 5],
      'minim OR xxxx minim OR xxxx' => [5, 6, 7],
      // Negative queries.
      'dolore -sit' => [7],
      'dolore -eu' => [2],
      'dolore -xxxxx' => [2, 7],
      'dolore -xx' => [2, 7],
      // Phrase queries.
      '"dolore sit"' => [2],
      '"sit dolore"' => [],
      '"am minim veniam es"' => [6, 7],
      '"minim am veniam es"' => [],
      // Mixed queries.
      '"am minim veniam es" OR dolore' => [2, 6, 7],
      '"minim am veniam es" OR "dolore sit"' => [2],
      '"minim am veniam es" OR "sit dolore"' => [],
      '"am minim veniam es" -eu' => [6],
      '"am minim veniam" -"cillum dolore"' => [5, 6],
      '"am minim veniam" -"dolore cillum"' => [5, 6, 7],
      'xxxxx "minim am veniam es" OR dolore' => [],
      'xx "minim am veniam es" OR dolore' => []
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($queries as $query => $results) {
      $result = db_select('search_index', 'i')
        ->extend('Drupal\search\SearchQuery')
        ->searchExpression($query, static::SEARCH_TYPE)
        ->execute();

<<<<<<< HEAD
      $set = $result ? $result->fetchAll() : array();
=======
      $set = $result ? $result->fetchAll() : [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $this->_testQueryMatching($query, $set, $results);
      $this->_testQueryScores($query, $set, $results);
    }

    // These queries are run against the second index type, SEARCH_TYPE_2.
<<<<<<< HEAD
    $queries = array(
      // Simple AND queries.
      'ipsum' => array(),
      'enim' => array(),
      'enim minim' => array(),
      'dear' => array(8),
      'germany' => array(11, 12),
    );
=======
    $queries = [
      // Simple AND queries.
      'ipsum' => [],
      'enim' => [],
      'enim minim' => [],
      'dear' => [8],
      'germany' => [11, 12],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($queries as $query => $results) {
      $result = db_select('search_index', 'i')
        ->extend('Drupal\search\SearchQuery')
        ->searchExpression($query, static::SEARCH_TYPE_2)
        ->execute();

<<<<<<< HEAD
      $set = $result ? $result->fetchAll() : array();
=======
      $set = $result ? $result->fetchAll() : [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $this->_testQueryMatching($query, $set, $results);
      $this->_testQueryScores($query, $set, $results);
    }

    // These queries are run against the third index type, SEARCH_TYPE_JPN.
<<<<<<< HEAD
    $queries = array(
      // Simple AND queries.
      '呂波耳' => array(13),
      '以呂波耳' => array(13),
      'ほへと　ヌルヲ' => array(13),
      'とちリ' => array(),
      'ドルーパル' => array(14),
      'パルが大' => array(14),
      'コーヒー' => array(15),
      'ヒーキ' => array(),
    );
=======
    $queries = [
      // Simple AND queries.
      '呂波耳' => [13],
      '以呂波耳' => [13],
      'ほへと　ヌルヲ' => [13],
      'とちリ' => [],
      'ドルーパル' => [14],
      'パルが大' => [14],
      'コーヒー' => [15],
      'ヒーキ' => [],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($queries as $query => $results) {
      $result = db_select('search_index', 'i')
        ->extend('Drupal\search\SearchQuery')
        ->searchExpression($query, static::SEARCH_TYPE_JPN)
        ->execute();

<<<<<<< HEAD
      $set = $result ? $result->fetchAll() : array();
=======
      $set = $result ? $result->fetchAll() : [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $this->_testQueryMatching($query, $set, $results);
      $this->_testQueryScores($query, $set, $results);
    }
  }

  /**
   * Test the matching abilities of the engine.
   *
   * Verify if a query produces the correct results.
   */
<<<<<<< HEAD
  function _testQueryMatching($query, $set, $results) {
    // Get result IDs.
    $found = array();
=======
  public function _testQueryMatching($query, $set, $results) {
    // Get result IDs.
    $found = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($set as $item) {
      $found[] = $item->sid;
    }

    // Compare $results and $found.
    sort($found);
    sort($results);
    $this->assertEqual($found, $results, "Query matching '$query'");
  }

  /**
   * Test the scoring abilities of the engine.
   *
   * Verify if a query produces normalized, monotonous scores.
   */
<<<<<<< HEAD
  function _testQueryScores($query, $set, $results) {
    // Get result scores.
    $scores = array();
=======
  public function _testQueryScores($query, $set, $results) {
    // Get result scores.
    $scores = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($set as $item) {
      $scores[] = $item->calculated_score;
    }

    // Check order.
    $sorted = $scores;
    sort($sorted);
    $this->assertEqual($scores, array_reverse($sorted), "Query order '$query'");

    // Check range.
    $this->assertEqual(!count($scores) || (min($scores) > 0.0 && max($scores) <= 1.0001), TRUE, "Query scoring '$query'");
  }

}
