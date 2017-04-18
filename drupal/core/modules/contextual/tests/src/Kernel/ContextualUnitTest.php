<?php

namespace Drupal\Tests\contextual\Kernel;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests all edge cases of converting from #contextual_links to ids and vice
 * versa.
 *
 * @group contextual
 */
class ContextualUnitTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('contextual');
=======
  public static $modules = ['contextual'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Provides testcases for testContextualLinksToId() and
   */
<<<<<<< HEAD
  function _contextual_links_id_testcases() {
=======
  public function _contextual_links_id_testcases() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Test branch conditions:
    // - one group.
    // - one dynamic path argument.
    // - no metadata.
<<<<<<< HEAD
    $tests[] = array(
      'links' => array(
        'node' => array(
          'route_parameters' => array(
            'node' => '14031991',
          ),
          'metadata' => array('langcode' => 'en'),
        ),
      ),
      'id' => 'node:node=14031991:langcode=en',
    );
=======
    $tests[] = [
      'links' => [
        'node' => [
          'route_parameters' => [
            'node' => '14031991',
          ],
          'metadata' => ['langcode' => 'en'],
        ],
      ],
      'id' => 'node:node=14031991:langcode=en',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test branch conditions:
    // - one group.
    // - multiple dynamic path arguments.
    // - no metadata.
<<<<<<< HEAD
    $tests[] = array(
      'links' => array(
        'foo' => array(
          'route_parameters' => array(
            'bar',
            'key' => 'baz',
            'qux',
          ),
          'metadata' => array('langcode' => 'en'),
        ),
      ),
      'id' => 'foo:0=bar&key=baz&1=qux:langcode=en',
    );
=======
    $tests[] = [
      'links' => [
        'foo' => [
          'route_parameters' => [
            'bar',
            'key' => 'baz',
            'qux',
          ],
          'metadata' => ['langcode' => 'en'],
        ],
      ],
      'id' => 'foo:0=bar&key=baz&1=qux:langcode=en',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test branch conditions:
    // - one group.
    // - one dynamic path argument.
    // - metadata.
<<<<<<< HEAD
    $tests[] = array(
      'links' => array(
        'views_ui_edit' => array(
          'route_parameters' => array(
            'view' => 'frontpage'
          ),
          'metadata' => array(
            'location' => 'page',
            'display' => 'page_1',
            'langcode' => 'en',
          ),
        ),
      ),
      'id' => 'views_ui_edit:view=frontpage:location=page&display=page_1&langcode=en',
    );
=======
    $tests[] = [
      'links' => [
        'views_ui_edit' => [
          'route_parameters' => [
            'view' => 'frontpage'
          ],
          'metadata' => [
            'location' => 'page',
            'display' => 'page_1',
            'langcode' => 'en',
          ],
        ],
      ],
      'id' => 'views_ui_edit:view=frontpage:location=page&display=page_1&langcode=en',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test branch conditions:
    // - multiple groups.
    // - multiple dynamic path arguments.
<<<<<<< HEAD
    $tests[] = array(
      'links' => array(
        'node' => array(
          'route_parameters' => array(
            'node' => '14031991',
          ),
          'metadata' => array('langcode' => 'en'),
        ),
        'foo' => array(
          'route_parameters' => array(
            'bar',
            'key' => 'baz',
            'qux',
          ),
          'metadata' => array('langcode' => 'en'),
        ),
        'edge' => array(
          'route_parameters' => array('20011988'),
          'metadata' => array('langcode' => 'en'),
        ),
      ),
      'id' => 'node:node=14031991:langcode=en|foo:0=bar&key=baz&1=qux:langcode=en|edge:0=20011988:langcode=en',
    );
=======
    $tests[] = [
      'links' => [
        'node' => [
          'route_parameters' => [
            'node' => '14031991',
          ],
          'metadata' => ['langcode' => 'en'],
        ],
        'foo' => [
          'route_parameters' => [
            'bar',
            'key' => 'baz',
            'qux',
          ],
          'metadata' => ['langcode' => 'en'],
        ],
        'edge' => [
          'route_parameters' => ['20011988'],
          'metadata' => ['langcode' => 'en'],
        ],
      ],
      'id' => 'node:node=14031991:langcode=en|foo:0=bar&key=baz&1=qux:langcode=en|edge:0=20011988:langcode=en',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    return $tests;
  }

  /**
   * Tests _contextual_links_to_id().
   */
<<<<<<< HEAD
  function testContextualLinksToId() {
=======
  public function testContextualLinksToId() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $tests = $this->_contextual_links_id_testcases();
    foreach ($tests as $test) {
      $this->assertIdentical(_contextual_links_to_id($test['links']), $test['id']);
    }
  }

  /**
   * Tests _contextual_id_to_links().
   */
<<<<<<< HEAD
  function testContextualIdToLinks() {
=======
  public function testContextualIdToLinks() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $tests = $this->_contextual_links_id_testcases();
    foreach ($tests as $test) {
      $this->assertIdentical(_contextual_id_to_links($test['id']), $test['links']);
    }
  }

}
