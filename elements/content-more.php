<?php
if (!defined('ABSPATH'))
  exit; // Exit if accessed directly

class Element_Content_More extends \Bricks\Element
{
  /** 
   * How to create custom elements in Bricks
   * 
   * https://academy.bricksbuilder.io/article/create-your-own-elements
   */
  public $category = 'custom';
  public $name = 'content-more';
  public $icon = 'fas fa-text-height'; // FontAwesome 5 icon in builder (https://fontawesome.com/icons)
  public $css_selector = '.content-more-wrapper'; // Default CSS selector for all controls with 'css' properties
  // public $scripts      = []; // Enqueue registered scripts by their handle

  public function get_label()
  {
    return esc_html__('Content More', 'bricks');
  }

  public function set_control_groups() {
    $this->control_groups['typography'] = [
      'title' => esc_html__( 'Typography', 'bricks' ),
      'tab'   => 'content', // Accepts: 'content' or 'style'
    ];
  }

  public function set_controls()
  {
    $this->controls['content'] = [
      'tab' => 'content',
      'label' => esc_html__('Content', 'bricks'),
      'type' => 'editor',
      // 'readonly' => true, // Default: false
      'rows' => 10, // Default: 5
      'spellcheck' => true, // Default: false
      'inlineEditing' => true,
      'default' => 'Here goes your text ... Select any part of your text to access the formatting toolbar.',
    ];

    $this->controls['readMore'] = [
      'tab' => 'content',
      'label' => esc_html__('Read more', 'bricks'),
      'type' => 'text',
      'spellcheck' => true, // Default: false
      // 'trigger' => 'enter', // Default: 'enter'
      'inlineEditing' => true,
      'default' => esc_html__('Read more', 'bricks'),
    ];

    $this->controls['readLess'] = [
      'tab' => 'content',
      'label' => esc_html__('Read less', 'bricks'),
      'type' => 'text',
      'spellcheck' => true, // Default: false
      // 'trigger' => 'enter', // Default: 'enter'
      'inlineEditing' => true,
      'default' => esc_html__('Read less', 'bricks'),
    ];

    $this->controls['contentTypography'] = [
      'tab'     => 'content',
      'group'   => 'typography',
      'label'   => esc_html__( 'Content typography', 'bricks' ),
      'type'    => 'typography',
			'css'     => [
        [
          'property' => 'typography',
          'selector' => '.brxe-content-more__body',
        ],
      ],
    ];

    $this->controls['readmoreTypography'] = [
      'tab'     => 'content',
      'group'   => 'typography',
      'label'   => esc_html__( 'Read More typography', 'bricks' ),
      'type'    => 'typography',
			'css'     => [
        [
          'property' => 'typography',
          'selector' => '.brxe-content-more__btn',
        ],
      ],
    ];
  }

  /** 
   * Render element HTML on frontend
   * 
   * If no 'render_builder' function is defined then this code is used to render element HTML in builder, too.
   */
  public function render()
  {
    $settings = $this->settings;
    $content = !empty($settings['content']) ? $settings['content'] : '';
    $read_more = !empty($settings['readMore']) ? $settings['readMore'] : esc_html__('Read more', 'bricks');
    $read_less = !empty($settings['readLess']) ? $settings['readLess'] : esc_html__('Read less', 'bricks');

    /**
     * '_root' attribute contains element ID, classes, etc. 
     * 
     * @since 1.4
     */
    $output = "<div {$this->render_attributes('_root')}>";

    if ($content) {
      $this->set_attribute('content', 'class', 'brxe-content-more__body');

      $output .= "<div {$this->render_attributes('content')}>" . $content . "</div>";

      $output .= '<div class="brxe-content-more__button">
      <a href="#" class="brxe-content-more__btn">
      <span class="brxe-content-more__button--more">' . $read_more . '</span>
      <span class="brxe-content-more__button--less">' . $read_less . '</span>
      </a>
      </div>';
    }

    $output .= '</div>';

    // Output final element HTML
    echo $output;
  }

  /**
   * Render element HTML in builder (optional)
   * 
   * Adds element render scripts to wp_footer via x-template.
   * Better performance than PHP 'render' function, which requires AJAX requests for every HTML re-render. 
   * Works only with static, non-database data.
   */
  public static function render_builder()
  { ?>
    <script type="text/x-template" id="tmpl-bricks-element-content-more">
      <component 
            :is="tag"
            class="content-more-wrapper">
            <contenteditable
                v-if="settings.content" 
                :name="name"
                :settings="settings"
                controlKey="content"
                class="brxe-content-more__body"/>

                <contenteditable
                v-if="settings.readMore" 
                :name="name"
                tag="a"
                :settings="settings"
                controlKey="readMore"
                class="brxe-content-more__btn"/>
        </component>
    </script>
<?php
  }
}
