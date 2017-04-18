<?php

namespace Drupal\Tests\node\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;

/**
 * Tests that conditions, provided by the node module, are working properly.
 *
 * @group node
 */
class NodeConditionTest extends EntityKernelTestBase {

<<<<<<< HEAD
  public static $modules = array('node');
=======
  public static $modules = ['node'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();

    // Create the node bundles required for testing.
    $type = NodeType::create(['type' => 'page', 'name' => 'page']);
    $type->save();
    $type = NodeType::create(['type' => 'article', 'name' => 'article']);
    $type->save();
    $type = NodeType::create(['type' => 'test', 'name' => 'test']);
    $type->save();
  }

  /**
   * Tests conditions.
   */
<<<<<<< HEAD
  function testConditions() {
=======
  public function testConditions() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $manager = $this->container->get('plugin.manager.condition', $this->container->get('container.namespaces'));
    $this->createUser();

    // Get some nodes of various types to check against.
    $page = Node::create(['type' => 'page', 'title' => $this->randomMachineName(), 'uid' => 1]);
    $page->save();
    $article = Node::create(['type' => 'article', 'title' => $this->randomMachineName(), 'uid' => 1]);
    $article->save();
    $test = Node::create(['type' => 'test', 'title' => $this->randomMachineName(), 'uid' => 1]);
    $test->save();

    // Grab the node type condition and configure it to check against node type
    // of 'article' and set the context to the page type node.
    $condition = $manager->createInstance('node_type')
<<<<<<< HEAD
      ->setConfig('bundles', array('article' => 'article'))
=======
      ->setConfig('bundles', ['article' => 'article'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->setContextValue('node', $page);
    $this->assertFalse($condition->execute(), 'Page type nodes fail node type checks for articles.');
    // Check for the proper summary.
    $this->assertEqual('The node bundle is article', $condition->summary());

    // Set the node type check to page.
<<<<<<< HEAD
    $condition->setConfig('bundles', array('page' => 'page'));
=======
    $condition->setConfig('bundles', ['page' => 'page']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($condition->execute(), 'Page type nodes pass node type checks for pages');
    // Check for the proper summary.
    $this->assertEqual('The node bundle is page', $condition->summary());

    // Set the node type check to page or article.
<<<<<<< HEAD
    $condition->setConfig('bundles', array('page' => 'page', 'article' => 'article'));
=======
    $condition->setConfig('bundles', ['page' => 'page', 'article' => 'article']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($condition->execute(), 'Page type nodes pass node type checks for pages or articles');
    // Check for the proper summary.
    $this->assertEqual('The node bundle is page or article', $condition->summary());

    // Set the context to the article node.
    $condition->setContextValue('node', $article);
    $this->assertTrue($condition->execute(), 'Article type nodes pass node type checks for pages or articles');

    // Set the context to the test node.
    $condition->setContextValue('node', $test);
    $this->assertFalse($condition->execute(), 'Test type nodes pass node type checks for pages or articles');

    // Check a greater than 2 bundles summary scenario.
<<<<<<< HEAD
    $condition->setConfig('bundles', array('page' => 'page', 'article' => 'article', 'test' => 'test'));
    $this->assertEqual('The node bundle is page, article or test', $condition->summary());

    // Test Constructor injection.
    $condition = $manager->createInstance('node_type', array('bundles' => array('article' => 'article'), 'context' => array('node' => $article)));
=======
    $condition->setConfig('bundles', ['page' => 'page', 'article' => 'article', 'test' => 'test']);
    $this->assertEqual('The node bundle is page, article or test', $condition->summary());

    // Test Constructor injection.
    $condition = $manager->createInstance('node_type', ['bundles' => ['article' => 'article'], 'context' => ['node' => $article]]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($condition->execute(), 'Constructor injection of context and configuration working as anticipated.');
  }

}
