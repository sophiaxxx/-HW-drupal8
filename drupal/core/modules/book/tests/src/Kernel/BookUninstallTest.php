<?php

namespace Drupal\Tests\book\Kernel;

use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests that the Book module cannot be uninstalled if books exist.
 *
 * @group book
 */
class BookUninstallTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['system', 'user', 'field', 'filter', 'text', 'node', 'book'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('user');
    $this->installEntitySchema('node');
<<<<<<< HEAD
    $this->installSchema('book', array('book'));
    $this->installSchema('node', array('node_access'));
    $this->installConfig(array('node', 'book', 'field'));
    // For uninstall to work.
    $this->installSchema('user', array('users_data'));
=======
    $this->installSchema('book', ['book']);
    $this->installSchema('node', ['node_access']);
    $this->installConfig(['node', 'book', 'field']);
    // For uninstall to work.
    $this->installSchema('user', ['users_data']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests the book_system_info_alter() method.
   */
  public function testBookUninstall() {
    // No nodes exist.
    $validation_reasons = \Drupal::service('module_installer')->validateUninstall(['book']);
    $this->assertEqual([], $validation_reasons, 'The book module is not required.');

<<<<<<< HEAD
    $content_type = NodeType::create(array(
      'type' => $this->randomMachineName(),
      'name' => $this->randomString(),
    ));
=======
    $content_type = NodeType::create([
      'type' => $this->randomMachineName(),
      'name' => $this->randomString(),
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $content_type->save();
    $book_config = $this->config('book.settings');
    $allowed_types = $book_config->get('allowed_types');
    $allowed_types[] = $content_type->id();
    $book_config->set('allowed_types', $allowed_types)->save();

<<<<<<< HEAD
    $node = Node::create(array('title' => $this->randomString(), 'type' => $content_type->id()));
=======
    $node = Node::create(['title' => $this->randomString(), 'type' => $content_type->id()]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $node->book['bid'] = 'new';
    $node->save();

    // One node in a book but not of type book.
    $validation_reasons = \Drupal::service('module_installer')->validateUninstall(['book']);
    $this->assertEqual(['To uninstall Book, delete all content that is part of a book'], $validation_reasons['book']);

<<<<<<< HEAD
    $book_node = Node::create(array('title' => $this->randomString(), 'type' => 'book'));
=======
    $book_node = Node::create(['title' => $this->randomString(), 'type' => 'book']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $book_node->book['bid'] = FALSE;
    $book_node->save();

    // Two nodes, one in a book but not of type book and one book node (which is
    // not in a book).
    $validation_reasons = \Drupal::service('module_installer')->validateUninstall(['book']);
    $this->assertEqual(['To uninstall Book, delete all content that is part of a book'], $validation_reasons['book']);

    $node->delete();
    // One node of type book but not actually part of a book.
    $validation_reasons = \Drupal::service('module_installer')->validateUninstall(['book']);
    $this->assertEqual(['To uninstall Book, delete all content that has the Book content type'], $validation_reasons['book']);

    $book_node->delete();
    // No nodes exist therefore the book module is not required.
    $module_data = _system_rebuild_module_data();
    $this->assertFalse(isset($module_data['book']->info['required']), 'The book module is not required.');

<<<<<<< HEAD
    $node = Node::create(array('title' => $this->randomString(), 'type' => $content_type->id()));
=======
    $node = Node::create(['title' => $this->randomString(), 'type' => $content_type->id()]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $node->save();
    // One node exists but is not part of a book therefore the book module is
    // not required.
    $validation_reasons = \Drupal::service('module_installer')->validateUninstall(['book']);
    $this->assertEqual([], $validation_reasons, 'The book module is not required.');

    // Uninstall the Book module and check the node type is deleted.
<<<<<<< HEAD
    \Drupal::service('module_installer')->uninstall(array('book'));
=======
    \Drupal::service('module_installer')->uninstall(['book']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertNull(NodeType::load('book'), "The book node type does not exist.");
  }

}
