<?php

namespace Drupal\Tests\taxonomy\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;

/**
 * Tests term validation constraints.
 *
 * @group taxonomy
 */
class TermValidationTest extends EntityKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('taxonomy');
=======
  public static $modules = ['taxonomy'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('taxonomy_term');
  }

  /**
   * Tests the term validation constraints.
   */
  public function testValidation() {
<<<<<<< HEAD
    $this->entityManager->getStorage('taxonomy_vocabulary')->create(array(
      'vid' => 'tags',
      'name' => 'Tags',
    ))->save();
    $term = $this->entityManager->getStorage('taxonomy_term')->create(array(
      'name' => 'test',
      'vid' => 'tags',
    ));
=======
    $this->entityManager->getStorage('taxonomy_vocabulary')->create([
      'vid' => 'tags',
      'name' => 'Tags',
    ])->save();
    $term = $this->entityManager->getStorage('taxonomy_term')->create([
      'name' => 'test',
      'vid' => 'tags',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $violations = $term->validate();
    $this->assertEqual(count($violations), 0, 'No violations when validating a default term.');

    $term->set('name', $this->randomString(256));
    $violations = $term->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when name is too long.');
    $this->assertEqual($violations[0]->getPropertyPath(), 'name.0.value');
    $field_label = $term->get('name')->getFieldDefinition()->getLabel();
<<<<<<< HEAD
    $this->assertEqual($violations[0]->getMessage(), t('%name: may not be longer than @max characters.', array('%name' => $field_label, '@max' => 255)));
=======
    $this->assertEqual($violations[0]->getMessage(), t('%name: may not be longer than @max characters.', ['%name' => $field_label, '@max' => 255]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $term->set('name', NULL);
    $violations = $term->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when name is NULL.');
    $this->assertEqual($violations[0]->getPropertyPath(), 'name');
    $this->assertEqual($violations[0]->getMessage(), t('This value should not be null.'));
    $term->set('name', 'test');

    $term->set('parent', 9999);
    $violations = $term->validate();
    $this->assertEqual(count($violations), 1, 'Violation found when term parent is invalid.');
<<<<<<< HEAD
    $this->assertEqual($violations[0]->getMessage(), format_string('The referenced entity (%type: %id) does not exist.', array('%type' => 'taxonomy_term', '%id' => 9999)));
=======
    $this->assertEqual($violations[0]->getMessage(), format_string('The referenced entity (%type: %id) does not exist.', ['%type' => 'taxonomy_term', '%id' => 9999]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $term->set('parent', 0);
    $violations = $term->validate();
    $this->assertEqual(count($violations), 0, 'No violations for parent id 0.');
  }

}
