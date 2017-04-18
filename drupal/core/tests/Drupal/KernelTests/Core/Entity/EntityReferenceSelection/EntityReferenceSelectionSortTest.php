<?php

namespace Drupal\KernelTests\Core\Entity\EntityReferenceSelection;

use Drupal\Component\Utility\Html;
use Drupal\field\Entity\FieldConfig;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests sorting referenced items.
 *
 * @group entity_reference
 */
class EntityReferenceSelectionSortTest extends EntityKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('node');
=======
  public static $modules = ['node'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();

    // Create an Article node type.
<<<<<<< HEAD
    $article = NodeType::create(array(
      'type' => 'article',
    ));
    $article->save();

    // Test as a non-admin.
    $normal_user = $this->createUser(array(), array('access content'));
=======
    $article = NodeType::create([
      'type' => 'article',
    ]);
    $article->save();

    // Test as a non-admin.
    $normal_user = $this->createUser([], ['access content']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    \Drupal::currentUser()->setAccount($normal_user);
  }

  /**
   * Assert sorting by field and property.
   */
  public function testSort() {
    // Add text field to entity, to sort by.
<<<<<<< HEAD
    FieldStorageConfig::create(array(
      'field_name' => 'field_text',
      'entity_type' => 'node',
      'type' => 'text',
      'entity_types' => array('node'),
    ))->save();
=======
    FieldStorageConfig::create([
      'field_name' => 'field_text',
      'entity_type' => 'node',
      'type' => 'text',
      'entity_types' => ['node'],
    ])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    FieldConfig::create([
      'label' => 'Text Field',
      'field_name' => 'field_text',
      'entity_type' => 'node',
      'bundle' => 'article',
<<<<<<< HEAD
      'settings' => array(),
=======
      'settings' => [],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'required' => FALSE,
    ])->save();

    // Build a set of test data.
<<<<<<< HEAD
    $node_values = array(
      'published1' => array(
=======
    $node_values = [
      'published1' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'type' => 'article',
        'status' => 1,
        'title' => 'Node published1 (<&>)',
        'uid' => 1,
<<<<<<< HEAD
        'field_text' => array(
          array(
            'value' => 1,
          ),
        ),
      ),
      'published2' => array(
=======
        'field_text' => [
          [
            'value' => 1,
          ],
        ],
      ],
      'published2' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'type' => 'article',
        'status' => 1,
        'title' => 'Node published2 (<&>)',
        'uid' => 1,
<<<<<<< HEAD
        'field_text' => array(
          array(
            'value' => 2,
          ),
        ),
      ),
    );

    $nodes = array();
    $node_labels = array();
=======
        'field_text' => [
          [
            'value' => 2,
          ],
        ],
      ],
    ];

    $nodes = [];
    $node_labels = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($node_values as $key => $values) {
      $node = Node::create($values);
      $node->save();
      $nodes[$key] = $node;
      $node_labels[$key] = Html::escape($node->label());
    }

<<<<<<< HEAD
    $selection_options = array(
      'target_type' => 'node',
      'handler' => 'default',
      'handler_settings' => array(
        'target_bundles' => NULL,
        // Add sorting.
        'sort' => array(
          'field' => 'field_text.value',
          'direction' => 'DESC',
        ),
      ),
    );
=======
    $selection_options = [
      'target_type' => 'node',
      'handler' => 'default',
      'handler_settings' => [
        'target_bundles' => NULL,
        // Add sorting.
        'sort' => [
          'field' => 'field_text.value',
          'direction' => 'DESC',
        ],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $handler = $this->container->get('plugin.manager.entity_reference_selection')->getInstance($selection_options);

    // Not only assert the result, but make sure the keys are sorted as
    // expected.
    $result = $handler->getReferenceableEntities();
<<<<<<< HEAD
    $expected_result = array(
      $nodes['published2']->id() => $node_labels['published2'],
      $nodes['published1']->id() => $node_labels['published1'],
    );
    $this->assertIdentical($result['article'], $expected_result, 'Query sorted by field returned expected values.');

    // Assert sort by base field.
    $selection_options['handler_settings']['sort'] = array(
      'field' => 'nid',
      'direction' => 'ASC',
    );
    $handler = $this->container->get('plugin.manager.entity_reference_selection')->getInstance($selection_options);
    $result = $handler->getReferenceableEntities();
    $expected_result = array(
      $nodes['published1']->id() => $node_labels['published1'],
      $nodes['published2']->id() => $node_labels['published2'],
    );
=======
    $expected_result = [
      $nodes['published2']->id() => $node_labels['published2'],
      $nodes['published1']->id() => $node_labels['published1'],
    ];
    $this->assertIdentical($result['article'], $expected_result, 'Query sorted by field returned expected values.');

    // Assert sort by base field.
    $selection_options['handler_settings']['sort'] = [
      'field' => 'nid',
      'direction' => 'ASC',
    ];
    $handler = $this->container->get('plugin.manager.entity_reference_selection')->getInstance($selection_options);
    $result = $handler->getReferenceableEntities();
    $expected_result = [
      $nodes['published1']->id() => $node_labels['published1'],
      $nodes['published2']->id() => $node_labels['published2'],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical($result['article'], $expected_result, 'Query sorted by property returned expected values.');
  }

}
