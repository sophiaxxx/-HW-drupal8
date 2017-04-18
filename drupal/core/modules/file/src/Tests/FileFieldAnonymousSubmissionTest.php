<?php

namespace Drupal\file\Tests;

use Drupal\node\Entity\Node;
use Drupal\user\RoleInterface;
use Drupal\file\Entity\File;

/**
 * Confirm that file field submissions work correctly for anonymous visitors.
 *
 * @group file
 */
class FileFieldAnonymousSubmissionTest extends FileFieldTestBase {

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    // Set up permissions for anonymous attacker user.
<<<<<<< HEAD
    user_role_change_permissions(RoleInterface::ANONYMOUS_ID, array(
      'create article content' => TRUE,
      'access content' => TRUE,
    ));
=======
    user_role_change_permissions(RoleInterface::ANONYMOUS_ID, [
      'create article content' => TRUE,
      'access content' => TRUE,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests the basic node submission for an anonymous visitor.
   */
  public function testAnonymousNode() {
    $bundle_label = 'Article';
    $node_title = 'test page';

    // Load the node form.
    $this->drupalLogout();
    $this->drupalGet('node/add/article');
    $this->assertResponse(200, 'Loaded the article node form.');
<<<<<<< HEAD
    $this->assertText(strip_tags(t('Create @name', array('@name' => $bundle_label))));

    $edit = array(
      'title[0][value]' => $node_title,
      'body[0][value]' => 'Test article',
    );
    $this->drupalPostForm(NULL, $edit, 'Save');
    $this->assertResponse(200);
    $t_args = array('@type' => $bundle_label, '%title' => $node_title);
    $this->assertText(strip_tags(t('@type %title has been created.', $t_args)), 'The node was created.');
    $matches = array();
=======
    $this->assertText(strip_tags(t('Create @name', ['@name' => $bundle_label])));

    $edit = [
      'title[0][value]' => $node_title,
      'body[0][value]' => 'Test article',
    ];
    $this->drupalPostForm(NULL, $edit, 'Save');
    $this->assertResponse(200);
    $t_args = ['@type' => $bundle_label, '%title' => $node_title];
    $this->assertText(strip_tags(t('@type %title has been created.', $t_args)), 'The node was created.');
    $matches = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    if (preg_match('@node/(\d+)$@', $this->getUrl(), $matches)) {
      $nid = end($matches);
      $this->assertNotEqual($nid, 0, 'The node ID was extracted from the URL.');
      $node = Node::load($nid);
      $this->assertNotEqual($node, NULL, 'The node was loaded successfully.');
    }
  }

  /**
   * Tests file submission for an anonymous visitor.
   */
  public function testAnonymousNodeWithFile() {
    $bundle_label = 'Article';
    $node_title = 'Test page';
<<<<<<< HEAD
    $this->createFileField('field_image', 'node', 'article', array(), array('file_extensions' => 'txt png'));
=======
    $this->createFileField('field_image', 'node', 'article', [], ['file_extensions' => 'txt png']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Load the node form.
    $this->drupalLogout();
    $this->drupalGet('node/add/article');
    $this->assertResponse(200, 'Loaded the article node form.');
<<<<<<< HEAD
    $this->assertText(strip_tags(t('Create @name', array('@name' => $bundle_label))));
=======
    $this->assertText(strip_tags(t('Create @name', ['@name' => $bundle_label])));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Generate an image file.
    $image = $this->getTestFile('image');

    // Submit the form.
<<<<<<< HEAD
    $edit = array(
      'title[0][value]' => $node_title,
      'body[0][value]' => 'Test article',
      'files[field_image_0]' => $this->container->get('file_system')->realpath($image->getFileUri()),
    );
    $this->drupalPostForm(NULL, $edit, 'Save');
    $this->assertResponse(200);
    $t_args = array('@type' => $bundle_label, '%title' => $node_title);
    $this->assertText(strip_tags(t('@type %title has been created.', $t_args)), 'The node was created.');
    $matches = array();
=======
    $edit = [
      'title[0][value]' => $node_title,
      'body[0][value]' => 'Test article',
      'files[field_image_0]' => $this->container->get('file_system')->realpath($image->getFileUri()),
    ];
    $this->drupalPostForm(NULL, $edit, 'Save');
    $this->assertResponse(200);
    $t_args = ['@type' => $bundle_label, '%title' => $node_title];
    $this->assertText(strip_tags(t('@type %title has been created.', $t_args)), 'The node was created.');
    $matches = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    if (preg_match('@node/(\d+)$@', $this->getUrl(), $matches)) {
      $nid = end($matches);
      $this->assertNotEqual($nid, 0, 'The node ID was extracted from the URL.');
      $node = Node::load($nid);
      $this->assertNotEqual($node, NULL, 'The node was loaded successfully.');
      $this->assertFileExists(File::load($node->field_image->target_id), 'The image was uploaded successfully.');
    }
  }

  /**
   * Tests file submission for an anonymous visitor with a missing node title.
   */
  public function testAnonymousNodeWithFileWithoutTitle() {
    $this->drupalLogout();
    $this->doTestNodeWithFileWithoutTitle();
  }

  /**
   * Tests file submission for an authenticated user with a missing node title.
   */
  public function testAuthenticatedNodeWithFileWithoutTitle() {
<<<<<<< HEAD
    $admin_user = $this->drupalCreateUser(array(
      'bypass node access',
      'access content overview',
      'administer nodes',
    ));
=======
    $admin_user = $this->drupalCreateUser([
      'bypass node access',
      'access content overview',
      'administer nodes',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->drupalLogin($admin_user);
    $this->doTestNodeWithFileWithoutTitle();
  }

  /**
   * Helper method to test file submissions with missing node titles.
   */
  protected function doTestNodeWithFileWithoutTitle() {
    $bundle_label = 'Article';
    $node_title = 'Test page';
<<<<<<< HEAD
    $this->createFileField('field_image', 'node', 'article', array(), array('file_extensions' => 'txt png'));
=======
    $this->createFileField('field_image', 'node', 'article', [], ['file_extensions' => 'txt png']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Load the node form.
    $this->drupalGet('node/add/article');
    $this->assertResponse(200, 'Loaded the article node form.');
<<<<<<< HEAD
    $this->assertText(strip_tags(t('Create @name', array('@name' => $bundle_label))));
=======
    $this->assertText(strip_tags(t('Create @name', ['@name' => $bundle_label])));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Generate an image file.
    $image = $this->getTestFile('image');

    // Submit the form but exclude the title field.
<<<<<<< HEAD
    $edit = array(
      'body[0][value]' => 'Test article',
      'files[field_image_0]' => $this->container->get('file_system')->realpath($image->getFileUri()),
    );
=======
    $edit = [
      'body[0][value]' => 'Test article',
      'files[field_image_0]' => $this->container->get('file_system')->realpath($image->getFileUri()),
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    if (!$this->loggedInUser) {
      $label = 'Save';
    }
    else {
      $label = 'Save and publish';
    }
    $this->drupalPostForm(NULL, $edit, $label);
    $this->assertResponse(200);
<<<<<<< HEAD
    $t_args = array('@type' => $bundle_label, '%title' => $node_title);
=======
    $t_args = ['@type' => $bundle_label, '%title' => $node_title];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertNoText(strip_tags(t('@type %title has been created.', $t_args)), 'The node was created.');
    $this->assertText('Title field is required.');

    // Submit the form again but this time with the missing title field. This
    // should still work.
<<<<<<< HEAD
    $edit = array(
      'title[0][value]' => $node_title,
    );
    $this->drupalPostForm(NULL, $edit, $label);

    // Confirm the final submission actually worked.
    $t_args = array('@type' => $bundle_label, '%title' => $node_title);
    $this->assertText(strip_tags(t('@type %title has been created.', $t_args)), 'The node was created.');
    $matches = array();
=======
    $edit = [
      'title[0][value]' => $node_title,
    ];
    $this->drupalPostForm(NULL, $edit, $label);

    // Confirm the final submission actually worked.
    $t_args = ['@type' => $bundle_label, '%title' => $node_title];
    $this->assertText(strip_tags(t('@type %title has been created.', $t_args)), 'The node was created.');
    $matches = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    if (preg_match('@node/(\d+)$@', $this->getUrl(), $matches)) {
      $nid = end($matches);
      $this->assertNotEqual($nid, 0, 'The node ID was extracted from the URL.');
      $node = Node::load($nid);
      $this->assertNotEqual($node, NULL, 'The node was loaded successfully.');
      $this->assertFileExists(File::load($node->field_image->target_id), 'The image was uploaded successfully.');
    }
  }

}
