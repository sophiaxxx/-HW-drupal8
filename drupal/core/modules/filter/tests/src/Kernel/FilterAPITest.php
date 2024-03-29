<?php

namespace Drupal\Tests\filter\Kernel;

use Drupal\Core\Language\LanguageInterface;
use Drupal\Core\Session\AnonymousUserSession;
use Drupal\Core\TypedData\OptionsProviderInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\filter\Entity\FilterFormat;
use Drupal\filter\Plugin\DataType\FilterFormat as FilterFormatDataType;
use Drupal\filter\Plugin\FilterInterface;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Tests the behavior of the API of the Filter module.
 *
 * @group filter
 */
class FilterAPITest extends EntityKernelTestBase {

<<<<<<< HEAD
  public static $modules = array('system', 'filter', 'filter_test', 'user');
=======
  public static $modules = ['system', 'filter', 'filter_test', 'user'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();

<<<<<<< HEAD
    $this->installConfig(array('system', 'filter', 'filter_test'));
=======
    $this->installConfig(['system', 'filter', 'filter_test']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests that the filter order is respected.
   */
<<<<<<< HEAD
  function testCheckMarkupFilterOrder() {
    // Create crazy HTML format.
    $crazy_format = FilterFormat::create(array(
      'format' => 'crazy',
      'name' => 'Crazy',
      'weight' => 1,
      'filters' => array(
        'filter_html_escape' => array(
          'weight' => 10,
          'status' => 1,
        ),
        'filter_html' => array(
          'weight' => -10,
          'status' => 1,
          'settings' => array(
            'allowed_html' => '<p>',
          ),
        ),
      )
    ));
=======
  public function testCheckMarkupFilterOrder() {
    // Create crazy HTML format.
    $crazy_format = FilterFormat::create([
      'format' => 'crazy',
      'name' => 'Crazy',
      'weight' => 1,
      'filters' => [
        'filter_html_escape' => [
          'weight' => 10,
          'status' => 1,
        ],
        'filter_html' => [
          'weight' => -10,
          'status' => 1,
          'settings' => [
            'allowed_html' => '<p>',
          ],
        ],
      ]
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $crazy_format->save();

    $text = "<p>Llamas are <not> awesome!</p>";
    $expected_filtered_text = "&lt;p&gt;Llamas are  awesome!&lt;/p&gt;";

    $this->assertEqual(check_markup($text, 'crazy'), $expected_filtered_text, 'Filters applied in correct order.');
  }

  /**
   * Tests the ability to apply only a subset of filters.
   */
<<<<<<< HEAD
  function testCheckMarkupFilterSubset() {
=======
  public function testCheckMarkupFilterSubset() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $text = "Text with <marquee>evil content and</marquee> a URL: https://www.drupal.org!";
    $expected_filtered_text = "Text with evil content and a URL: <a href=\"https://www.drupal.org\">https://www.drupal.org</a>!";
    $expected_filter_text_without_html_generators = "Text with evil content and a URL: https://www.drupal.org!";

<<<<<<< HEAD
    $actual_filtered_text = check_markup($text, 'filtered_html', '', array());
=======
    $actual_filtered_text = check_markup($text, 'filtered_html', '', []);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->verbose("Actual:<pre>$actual_filtered_text</pre>Expected:<pre>$expected_filtered_text</pre>");
    $this->assertEqual(
      $actual_filtered_text,
      $expected_filtered_text,
      'Expected filter result.'
    );
<<<<<<< HEAD
    $actual_filtered_text_without_html_generators = check_markup($text, 'filtered_html', '', array(FilterInterface::TYPE_MARKUP_LANGUAGE));
=======
    $actual_filtered_text_without_html_generators = check_markup($text, 'filtered_html', '', [FilterInterface::TYPE_MARKUP_LANGUAGE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->verbose("Actual:<pre>$actual_filtered_text_without_html_generators</pre>Expected:<pre>$expected_filter_text_without_html_generators</pre>");
    $this->assertEqual(
      $actual_filtered_text_without_html_generators,
      $expected_filter_text_without_html_generators,
      'Expected filter result when skipping FilterInterface::TYPE_MARKUP_LANGUAGE filters.'
    );
    // Related to @see FilterSecurityTest.php/testSkipSecurityFilters(), but
    // this check focuses on the ability to filter multiple filter types at once.
    // Drupal core only ships with these two types of filters, so this is the
    // most extensive test possible.
<<<<<<< HEAD
    $actual_filtered_text_without_html_generators = check_markup($text, 'filtered_html', '', array(FilterInterface::TYPE_HTML_RESTRICTOR, FilterInterface::TYPE_MARKUP_LANGUAGE));
=======
    $actual_filtered_text_without_html_generators = check_markup($text, 'filtered_html', '', [FilterInterface::TYPE_HTML_RESTRICTOR, FilterInterface::TYPE_MARKUP_LANGUAGE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->verbose("Actual:<pre>$actual_filtered_text_without_html_generators</pre>Expected:<pre>$expected_filter_text_without_html_generators</pre>");
    $this->assertEqual(
      $actual_filtered_text_without_html_generators,
      $expected_filter_text_without_html_generators,
      'Expected filter result when skipping FilterInterface::TYPE_MARKUP_LANGUAGE filters, even when trying to disable filters of the FilterInterface::TYPE_HTML_RESTRICTOR type.'
    );
  }

  /**
   * Tests the following functions for a variety of formats:
   *   - \Drupal\filter\Entity\FilterFormatInterface::getHtmlRestrictions()
   *   - \Drupal\filter\Entity\FilterFormatInterface::getFilterTypes()
   */
<<<<<<< HEAD
  function testFilterFormatAPI() {
    // Test on filtered_html.
    $filtered_html_format = entity_load('filter_format', 'filtered_html');
    $this->assertIdentical(
      $filtered_html_format->getHtmlRestrictions(),
      array(
        'allowed' => array(
          'p' => FALSE,
          'br' => FALSE,
          'strong' => FALSE,
          'a' => array('href' => TRUE, 'hreflang' => TRUE),
          '*' => array('style' => FALSE, 'on*' => FALSE, 'lang' => TRUE, 'dir' => array('ltr' => TRUE, 'rtl' => TRUE)),
        ),
      ),
=======
  public function testFilterFormatAPI() {
    // Test on filtered_html.
    $filtered_html_format = FilterFormat::load('filtered_html');
    $this->assertIdentical(
      $filtered_html_format->getHtmlRestrictions(),
      [
        'allowed' => [
          'p' => FALSE,
          'br' => FALSE,
          'strong' => FALSE,
          'a' => ['href' => TRUE, 'hreflang' => TRUE],
          '*' => ['style' => FALSE, 'on*' => FALSE, 'lang' => TRUE, 'dir' => ['ltr' => TRUE, 'rtl' => TRUE]],
        ],
      ],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'FilterFormatInterface::getHtmlRestrictions() works as expected for the filtered_html format.'
    );
    $this->assertIdentical(
      $filtered_html_format->getFilterTypes(),
<<<<<<< HEAD
      array(FilterInterface::TYPE_HTML_RESTRICTOR, FilterInterface::TYPE_MARKUP_LANGUAGE),
=======
      [FilterInterface::TYPE_HTML_RESTRICTOR, FilterInterface::TYPE_MARKUP_LANGUAGE],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'FilterFormatInterface::getFilterTypes() works as expected for the filtered_html format.'
    );

    // Test on full_html.
<<<<<<< HEAD
    $full_html_format = entity_load('filter_format', 'full_html');
=======
    $full_html_format = FilterFormat::load('full_html');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertIdentical(
      $full_html_format->getHtmlRestrictions(),
      FALSE, // Every tag is allowed.
      'FilterFormatInterface::getHtmlRestrictions() works as expected for the full_html format.'
    );
    $this->assertIdentical(
      $full_html_format->getFilterTypes(),
<<<<<<< HEAD
      array(),
=======
      [],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'FilterFormatInterface::getFilterTypes() works as expected for the full_html format.'
    );

    // Test on stupid_filtered_html, where nothing is allowed.
<<<<<<< HEAD
    $stupid_filtered_html_format = FilterFormat::create(array(
      'format' => 'stupid_filtered_html',
      'name' => 'Stupid Filtered HTML',
      'filters' => array(
        'filter_html' => array(
          'status' => 1,
          'settings' => array(
            'allowed_html' => '', // Nothing is allowed.
          ),
        ),
      ),
    ));
    $stupid_filtered_html_format->save();
    $this->assertIdentical(
      $stupid_filtered_html_format->getHtmlRestrictions(),
      array('allowed' => array()), // No tag is allowed.
=======
    $stupid_filtered_html_format = FilterFormat::create([
      'format' => 'stupid_filtered_html',
      'name' => 'Stupid Filtered HTML',
      'filters' => [
        'filter_html' => [
          'status' => 1,
          'settings' => [
            'allowed_html' => '', // Nothing is allowed.
          ],
        ],
      ],
    ]);
    $stupid_filtered_html_format->save();
    $this->assertIdentical(
      $stupid_filtered_html_format->getHtmlRestrictions(),
      ['allowed' => []], // No tag is allowed.
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'FilterFormatInterface::getHtmlRestrictions() works as expected for the stupid_filtered_html format.'
    );
    $this->assertIdentical(
      $stupid_filtered_html_format->getFilterTypes(),
<<<<<<< HEAD
      array(FilterInterface::TYPE_HTML_RESTRICTOR),
=======
      [FilterInterface::TYPE_HTML_RESTRICTOR],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'FilterFormatInterface::getFilterTypes() works as expected for the stupid_filtered_html format.'
    );

    // Test on very_restricted_html, where there's two different filters of the
    // FilterInterface::TYPE_HTML_RESTRICTOR type, each restricting in different ways.
<<<<<<< HEAD
    $very_restricted_html_format = FilterFormat::create(array(
      'format' => 'very_restricted_html',
      'name' => 'Very Restricted HTML',
      'filters' => array(
        'filter_html' => array(
          'status' => 1,
          'settings' => array(
            'allowed_html' => '<p> <br> <a href> <strong>',
          ),
        ),
        'filter_test_restrict_tags_and_attributes' => array(
          'status' => 1,
          'settings' => array(
            'restrictions' => array(
              'allowed' => array(
                'p' => TRUE,
                'br' => FALSE,
                'a' => array('href' => TRUE),
                'em' => TRUE,
              ),
            )
          ),
        ),
      )
    ));
    $very_restricted_html_format->save();
    $this->assertIdentical(
      $very_restricted_html_format->getHtmlRestrictions(),
      array(
        'allowed' => array(
          'p' => FALSE,
          'br' => FALSE,
          'a' => array('href' => TRUE),
          '*' => array('style' => FALSE, 'on*' => FALSE, 'lang' => TRUE, 'dir' => array('ltr' => TRUE, 'rtl' => TRUE)),
        ),
      ),
=======
    $very_restricted_html_format = FilterFormat::create([
      'format' => 'very_restricted_html',
      'name' => 'Very Restricted HTML',
      'filters' => [
        'filter_html' => [
          'status' => 1,
          'settings' => [
            'allowed_html' => '<p> <br> <a href> <strong>',
          ],
        ],
        'filter_test_restrict_tags_and_attributes' => [
          'status' => 1,
          'settings' => [
            'restrictions' => [
              'allowed' => [
                'p' => TRUE,
                'br' => FALSE,
                'a' => ['href' => TRUE],
                'em' => TRUE,
              ],
            ]
          ],
        ],
      ]
    ]);
    $very_restricted_html_format->save();
    $this->assertIdentical(
      $very_restricted_html_format->getHtmlRestrictions(),
      [
        'allowed' => [
          'p' => FALSE,
          'br' => FALSE,
          'a' => ['href' => TRUE],
          '*' => ['style' => FALSE, 'on*' => FALSE, 'lang' => TRUE, 'dir' => ['ltr' => TRUE, 'rtl' => TRUE]],
        ],
      ],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'FilterFormatInterface::getHtmlRestrictions() works as expected for the very_restricted_html format.'
    );
    $this->assertIdentical(
      $very_restricted_html_format->getFilterTypes(),
<<<<<<< HEAD
      array(FilterInterface::TYPE_HTML_RESTRICTOR),
=======
      [FilterInterface::TYPE_HTML_RESTRICTOR],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'FilterFormatInterface::getFilterTypes() works as expected for the very_restricted_html format.'
    );

    // Test on nonsensical_restricted_html, where the allowed attribute values
    // contain asterisks, which do not have any meaning, but which we also
    // cannot prevent because configuration can be modified outside of forms.
<<<<<<< HEAD
    $nonsensical_restricted_html = FilterFormat::create(array(
      'format' => 'nonsensical_restricted_html',
      'name' => 'Nonsensical Restricted HTML',
      'filters' => array(
        'filter_html' => array(
          'status' => 1,
          'settings' => array(
            'allowed_html' => '<a> <b class> <c class="*"> <d class="foo bar-* *">',
          ),
        ),
      )
    ));
    $nonsensical_restricted_html->save();
    $this->assertIdentical(
      $nonsensical_restricted_html->getHtmlRestrictions(),
      array(
        'allowed' => array(
          'a' => FALSE,
          'b' => array('class' => TRUE),
          'c' => array('class' => TRUE),
          'd' => array('class' => array('foo' => TRUE, 'bar-*' => TRUE)),
          '*' => array('style' => FALSE, 'on*' => FALSE, 'lang' => TRUE, 'dir' => array('ltr' => TRUE, 'rtl' => TRUE)),
        ),
      ),
=======
    $nonsensical_restricted_html = FilterFormat::create([
      'format' => 'nonsensical_restricted_html',
      'name' => 'Nonsensical Restricted HTML',
      'filters' => [
        'filter_html' => [
          'status' => 1,
          'settings' => [
            'allowed_html' => '<a> <b class> <c class="*"> <d class="foo bar-* *">',
          ],
        ],
      ]
    ]);
    $nonsensical_restricted_html->save();
    $this->assertIdentical(
      $nonsensical_restricted_html->getHtmlRestrictions(),
      [
        'allowed' => [
          'a' => FALSE,
          'b' => ['class' => TRUE],
          'c' => ['class' => TRUE],
          'd' => ['class' => ['foo' => TRUE, 'bar-*' => TRUE]],
          '*' => ['style' => FALSE, 'on*' => FALSE, 'lang' => TRUE, 'dir' => ['ltr' => TRUE, 'rtl' => TRUE]],
        ],
      ],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'FilterFormatInterface::getHtmlRestrictions() works as expected for the nonsensical_restricted_html format.'
    );
    $this->assertIdentical(
      $very_restricted_html_format->getFilterTypes(),
<<<<<<< HEAD
      array(FilterInterface::TYPE_HTML_RESTRICTOR),
=======
      [FilterInterface::TYPE_HTML_RESTRICTOR],
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'FilterFormatInterface::getFilterTypes() works as expected for the very_restricted_html format.'
    );
  }

  /**
   * Tests the 'processed_text' element.
   *
   * check_markup() is a wrapper for the 'processed_text' element, for use in
   * simple scenarios; the 'processed_text' element has more advanced features:
   * it lets filters attach assets, associate cache tags and define
   * #lazy_builder callbacks.
   * This test focuses solely on those advanced features.
   */
<<<<<<< HEAD
  function testProcessedTextElement() {
    FilterFormat::create(array(
      'format' => 'element_test',
      'name' => 'processed_text element test format',
      'filters' => array(
        'filter_test_assets' => array(
          'weight' => -1,
          'status' => TRUE,
        ),
        'filter_test_cache_tags' => array(
          'weight' => 0,
          'status' => TRUE,
        ),
        'filter_test_cache_contexts' => array(
          'weight' => 0,
          'status' => TRUE,
        ),
        'filter_test_cache_merge' => array(
          'weight' => 0,
          'status' => TRUE,
        ),
        'filter_test_placeholders' => array(
          'weight' => 1,
          'status' => TRUE,
        ),
        // Run the HTML corrector filter last, because it has the potential to
        // break the placeholders added by the filter_test_placeholders filter.
        'filter_htmlcorrector' => array(
          'weight' => 10,
          'status' => TRUE,
        ),
      ),
    ))->save();

    $build = array(
      '#type' => 'processed_text',
      '#text' => '<p>Hello, world!</p>',
      '#format' => 'element_test',
    );
    drupal_render_root($build);

    // Verify the attachments and cacheability metadata.
    $expected_attachments = array(
      // The assets attached by the filter_test_assets filter.
      'library' => array(
        'filter/caption',
      ),
      // The placeholders attached that still need to be processed.
      'placeholders' => [],
    );
    $this->assertEqual($expected_attachments, $build['#attached'], 'Expected attachments present');
    $expected_cache_tags = array(
=======
  public function testProcessedTextElement() {
    FilterFormat::create([
      'format' => 'element_test',
      'name' => 'processed_text element test format',
      'filters' => [
        'filter_test_assets' => [
          'weight' => -1,
          'status' => TRUE,
        ],
        'filter_test_cache_tags' => [
          'weight' => 0,
          'status' => TRUE,
        ],
        'filter_test_cache_contexts' => [
          'weight' => 0,
          'status' => TRUE,
        ],
        'filter_test_cache_merge' => [
          'weight' => 0,
          'status' => TRUE,
        ],
        'filter_test_placeholders' => [
          'weight' => 1,
          'status' => TRUE,
        ],
        // Run the HTML corrector filter last, because it has the potential to
        // break the placeholders added by the filter_test_placeholders filter.
        'filter_htmlcorrector' => [
          'weight' => 10,
          'status' => TRUE,
        ],
      ],
    ])->save();

    $build = [
      '#type' => 'processed_text',
      '#text' => '<p>Hello, world!</p>',
      '#format' => 'element_test',
    ];
    drupal_render_root($build);

    // Verify the attachments and cacheability metadata.
    $expected_attachments = [
      // The assets attached by the filter_test_assets filter.
      'library' => [
        'filter/caption',
      ],
      // The placeholders attached that still need to be processed.
      'placeholders' => [],
    ];
    $this->assertEqual($expected_attachments, $build['#attached'], 'Expected attachments present');
    $expected_cache_tags = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      // The cache tag set by the processed_text element itself.
      'config:filter.format.element_test',
      // The cache tags set by the filter_test_cache_tags filter.
      'foo:bar',
      'foo:baz',
      // The cache tags set by the filter_test_cache_merge filter.
      'merge:tag',
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($expected_cache_tags, $build['#cache']['tags'], 'Expected cache tags present.');
    $expected_cache_contexts = [
      // The cache context set by the filter_test_cache_contexts filter.
      'languages:' . LanguageInterface::TYPE_CONTENT,
      // The default cache contexts for Renderer.
      'languages:' . LanguageInterface::TYPE_INTERFACE,
      'theme',
      // The cache tags set by the filter_test_cache_merge filter.
      'user.permissions',
    ];
    $this->assertEqual($expected_cache_contexts, $build['#cache']['contexts'], 'Expected cache contexts present.');
    $expected_markup = '<p>Hello, world!</p><p>This is a dynamic llama.</p>';
    $this->assertEqual($expected_markup, $build['#markup'], 'Expected #lazy_builder callback has been applied.');
  }

  /**
   * Tests the function of the typed data type.
   */
<<<<<<< HEAD
  function testTypedDataAPI() {
=======
  public function testTypedDataAPI() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $definition = DataDefinition::create('filter_format');
    $data = \Drupal::typedDataManager()->create($definition);

    $this->assertTrue($data instanceof OptionsProviderInterface, 'Typed data object implements \Drupal\Core\TypedData\OptionsProviderInterface');

<<<<<<< HEAD
    $filtered_html_user = $this->createUser(array('uid' => 2), array(
      entity_load('filter_format', 'filtered_html')->getPermissionName(),
    ));
=======
    $filtered_html_user = $this->createUser(['uid' => 2], [
      FilterFormat::load('filtered_html')->getPermissionName(),
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test with anonymous user.
    $user = new AnonymousUserSession();
    \Drupal::currentUser()->setAccount($user);

<<<<<<< HEAD
    $expected_available_options = array(
=======
    $expected_available_options = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'filtered_html' => 'Filtered HTML',
      'full_html' => 'Full HTML',
      'filter_test' => 'Test format',
      'plain_text' => 'Plain text',
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $available_values = $data->getPossibleValues();
    $this->assertEqual($available_values, array_keys($expected_available_options));
    $available_options = $data->getPossibleOptions();
    $this->assertEqual($available_options, $expected_available_options);

    $allowed_values = $data->getSettableValues($user);
<<<<<<< HEAD
    $this->assertEqual($allowed_values, array('plain_text'));
    $allowed_options = $data->getSettableOptions($user);
    $this->assertEqual($allowed_options, array('plain_text' => 'Plain text'));
=======
    $this->assertEqual($allowed_values, ['plain_text']);
    $allowed_options = $data->getSettableOptions($user);
    $this->assertEqual($allowed_options, ['plain_text' => 'Plain text']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $data->setValue('foo');
    $violations = $data->validate();
    $this->assertFilterFormatViolation($violations, 'foo');

    // Make sure the information provided by a violation is correct.
    $violation = $violations[0];
    $this->assertEqual($violation->getRoot(), $data, 'Violation root is filter format.');
    $this->assertEqual($violation->getPropertyPath(), '', 'Violation property path is correct.');
    $this->assertEqual($violation->getInvalidValue(), 'foo', 'Violation contains invalid value.');

    $data->setValue('plain_text');
    $violations = $data->validate();
    $this->assertEqual(count($violations), 0, "No validation violation for format 'plain_text' found");

    // Anonymous doesn't have access to the 'filtered_html' format.
    $data->setValue('filtered_html');
    $violations = $data->validate();
    $this->assertFilterFormatViolation($violations, 'filtered_html');

    // Set user with access to 'filtered_html' format.
    \Drupal::currentUser()->setAccount($filtered_html_user);
    $violations = $data->validate();
    $this->assertEqual(count($violations), 0, "No validation violation for accessible format 'filtered_html' found.");

    $allowed_values = $data->getSettableValues($filtered_html_user);
<<<<<<< HEAD
    $this->assertEqual($allowed_values, array('filtered_html', 'plain_text'));
    $allowed_options = $data->getSettableOptions($filtered_html_user);
    $expected_allowed_options = array(
      'filtered_html' => 'Filtered HTML',
      'plain_text' => 'Plain text',
    );
=======
    $this->assertEqual($allowed_values, ['filtered_html', 'plain_text']);
    $allowed_options = $data->getSettableOptions($filtered_html_user);
    $expected_allowed_options = [
      'filtered_html' => 'Filtered HTML',
      'plain_text' => 'Plain text',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($allowed_options, $expected_allowed_options);
  }

  /**
   * Tests that FilterFormat::preSave() only saves customized plugins.
   */
  public function testFilterFormatPreSave() {
    /** @var \Drupal\filter\FilterFormatInterface $crazy_format */
<<<<<<< HEAD
    $crazy_format = FilterFormat::create(array(
      'format' => 'crazy',
      'name' => 'Crazy',
      'weight' => 1,
      'filters' => array(
        'filter_html_escape' => array(
          'weight' => 10,
          'status' => 1,
        ),
        'filter_html' => array(
          'weight' => -10,
          'status' => 1,
          'settings' => array(
            'allowed_html' => '<p>',
          ),
        ),
      )
    ));
=======
    $crazy_format = FilterFormat::create([
      'format' => 'crazy',
      'name' => 'Crazy',
      'weight' => 1,
      'filters' => [
        'filter_html_escape' => [
          'weight' => 10,
          'status' => 1,
        ],
        'filter_html' => [
          'weight' => -10,
          'status' => 1,
          'settings' => [
            'allowed_html' => '<p>',
          ],
        ],
      ]
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $crazy_format->save();
    // Use config to directly load the configuration and check that only enabled
    // or customized plugins are saved to configuration.
    $filters = $this->config('filter.format.crazy')->get('filters');
<<<<<<< HEAD
    $this->assertEqual(array('filter_html_escape', 'filter_html'), array_keys($filters));

    // Disable a plugin to ensure that disabled plugins with custom settings are
    // stored in configuration.
    $crazy_format->setFilterConfig('filter_html_escape', array('status' => FALSE));
    $crazy_format->save();
    $filters = $this->config('filter.format.crazy')->get('filters');
    $this->assertEqual(array('filter_html_escape', 'filter_html'), array_keys($filters));

    // Set the settings as per default to ensure that disable plugins in this
    // state are not stored in configuration.
    $crazy_format->setFilterConfig('filter_html_escape', array('weight' => -10));
    $crazy_format->save();
    $filters = $this->config('filter.format.crazy')->get('filters');
    $this->assertEqual(array('filter_html'), array_keys($filters));
=======
    $this->assertEqual(['filter_html_escape', 'filter_html'], array_keys($filters));

    // Disable a plugin to ensure that disabled plugins with custom settings are
    // stored in configuration.
    $crazy_format->setFilterConfig('filter_html_escape', ['status' => FALSE]);
    $crazy_format->save();
    $filters = $this->config('filter.format.crazy')->get('filters');
    $this->assertEqual(['filter_html_escape', 'filter_html'], array_keys($filters));

    // Set the settings as per default to ensure that disable plugins in this
    // state are not stored in configuration.
    $crazy_format->setFilterConfig('filter_html_escape', ['weight' => -10]);
    $crazy_format->save();
    $filters = $this->config('filter.format.crazy')->get('filters');
    $this->assertEqual(['filter_html'], array_keys($filters));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Checks if an expected violation exists in the given violations.
   *
   * @param \Symfony\Component\Validator\ConstraintViolationListInterface $violations
   *   The violations to assert.
   * @param mixed $invalid_value
   *   The expected invalid value.
   */
  public function assertFilterFormatViolation(ConstraintViolationListInterface $violations, $invalid_value) {
    $filter_format_violation_found = FALSE;
    foreach ($violations as $violation) {
      if ($violation->getRoot() instanceof FilterFormatDataType && $violation->getInvalidValue() === $invalid_value) {
        $filter_format_violation_found = TRUE;
        break;
      }
    }
<<<<<<< HEAD
    $this->assertTrue($filter_format_violation_found, format_string('Validation violation for invalid value "%invalid_value" found', array('%invalid_value' => $invalid_value)));
=======
    $this->assertTrue($filter_format_violation_found, format_string('Validation violation for invalid value "%invalid_value" found', ['%invalid_value' => $invalid_value]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests that filter format dependency removal works.
   *
   * Ensure that modules providing filter plugins are required when the plugin
   * is in use, and that only disabled plugins are removed from format
   * configuration entities rather than the configuration entities being
   * deleted.
   *
   * @see \Drupal\filter\Entity\FilterFormat::onDependencyRemoval()
   * @see filter_system_info_alter()
   */
  public function testDependencyRemoval() {
<<<<<<< HEAD
    $this->installSchema('user', array('users_data'));
=======
    $this->installSchema('user', ['users_data']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $filter_format = FilterFormat::load('filtered_html');

    // Disable the filter_test_restrict_tags_and_attributes filter plugin but
    // have custom configuration so that the filter plugin is still configured
    // in filtered_html the filter format.
    $filter_config = [
      'weight' => 20,
      'status' => 0,
    ];
    $filter_format->setFilterConfig('filter_test_restrict_tags_and_attributes', $filter_config)->save();
    // Use the get method to match the assert after the module has been
    // uninstalled.
    $filters = $filter_format->get('filters');
    $this->assertTrue(isset($filters['filter_test_restrict_tags_and_attributes']), 'The filter plugin filter_test_restrict_tags_and_attributes is configured by the filtered_html filter format.');

    drupal_static_reset('filter_formats');
    \Drupal::entityManager()->getStorage('filter_format')->resetCache();
    $module_data = _system_rebuild_module_data();
    $this->assertFalse(isset($module_data['filter_test']->info['required']), 'The filter_test module is required.');

    // Verify that a dependency exists on the module that provides the filter
    // plugin since it has configuration for the disabled plugin.
    $this->assertEqual(['module' => ['filter_test']], $filter_format->getDependencies());

    // Uninstall the module.
<<<<<<< HEAD
    \Drupal::service('module_installer')->uninstall(array('filter_test'));
=======
    \Drupal::service('module_installer')->uninstall(['filter_test']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Verify the filter format still exists but the dependency and filter is
    // gone.
    \Drupal::entityManager()->getStorage('filter_format')->resetCache();
    $filter_format = FilterFormat::load('filtered_html');
    $this->assertEqual([], $filter_format->getDependencies());
    // Use the get method since the FilterFormat::filters() method only returns
    // existing plugins.
    $filters = $filter_format->get('filters');
    $this->assertFalse(isset($filters['filter_test_restrict_tags_and_attributes']), 'The filter plugin filter_test_restrict_tags_and_attributes is not configured by the filtered_html filter format.');
  }

}
