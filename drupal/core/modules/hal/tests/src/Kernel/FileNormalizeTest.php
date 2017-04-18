<?php

namespace Drupal\Tests\hal\Kernel;

<<<<<<< HEAD
use Drupal\Core\Cache\MemoryBackend;
use Drupal\file\Entity\File;
use Drupal\hal\Encoder\JsonEncoder;
use Drupal\hal\Normalizer\FieldItemNormalizer;
use Drupal\hal\Normalizer\FileEntityNormalizer;
use Drupal\rest\LinkManager\LinkManager;
use Drupal\rest\LinkManager\RelationLinkManager;
use Drupal\rest\LinkManager\TypeLinkManager;
use Symfony\Component\Serializer\Serializer;

=======
use Drupal\file\Entity\File;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

/**
 * Tests that file entities can be normalized in HAL.
 *
 * @group hal
 */
class FileNormalizeTest extends NormalizerTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('file');
=======
  public static $modules = ['file'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('file');
<<<<<<< HEAD

    $entity_manager = \Drupal::entityManager();
    $link_manager = new LinkManager(new TypeLinkManager(new MemoryBackend('default'), \Drupal::moduleHandler(), \Drupal::service('config.factory'), \Drupal::service('request_stack')), new RelationLinkManager(new MemoryBackend('default'), $entity_manager, \Drupal::moduleHandler(), \Drupal::service('config.factory'), \Drupal::service('request_stack')));

    // Set up the mock serializer.
    $normalizers = array(
      new FieldItemNormalizer(),
      new FileEntityNormalizer($entity_manager, \Drupal::httpClient(), $link_manager, \Drupal::moduleHandler()),
    );

    $encoders = array(
      new JsonEncoder(),
    );
    $this->serializer = new Serializer($normalizers, $encoders);
=======
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }


  /**
   * Tests the normalize function.
   */
  public function testNormalize() {
<<<<<<< HEAD
    $file_params = array(
=======
    $file_params = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'filename' => 'test_1.txt',
      'uri' => 'public://test_1.txt',
      'filemime' => 'text/plain',
      'status' => FILE_STATUS_PERMANENT,
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Create a new file entity.
    $file = File::create($file_params);
    file_put_contents($file->getFileUri(), 'hello world');
    $file->save();

<<<<<<< HEAD
    $expected_array = array(
      'uri' => array(
        array(
          'value' => file_create_url($file->getFileUri())),
      ),
    );
=======
    $expected_array = [
      'uri' => [
        [
          'value' => file_create_url($file->getFileUri())],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $normalized = $this->serializer->normalize($file, $this->format);
    $this->assertEqual($normalized['uri'], $expected_array['uri'], 'URI is normalized.');

  }

}
