<?php
    namespace Drupal\custom_form\Plugin\Block;

	use Drupal\Core\Block\BlockBase;
	use Symfony\Component\DependencyInjection\ContainerInterface;
	use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
	use Drupal\Core\Form\FormBuilderInterface;
	/**
     *
     * @Block(
     *   id = "custom_block",
     *   admin_label = @Translation("Custom form Block"),
     *   category = @Translation("Custom Form Block")
     * )
	 *
    */
    class customBlock extends BlockBase implements ContainerFactoryPluginInterface{
	/**
	* The form builder.
	*
	* @var \Drupal\Core\Form\FormBuilderInterface
	*/
	protected $formBuilder;

	/**
	*{@inheritdoc}
	*/
	public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    // Instantiate this block class.
		return new static(
		$configuration,
		$plugin_id,
		$plugin_definition,
		// Load the service required to construct this class.
		$container->get('form_builder')
		);
	}
	
	/**
	* Class constructor
	*/
	public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder) {
		$this->formBuilder = $form_builder;
	}
 
	/**
	* {@inheritdoc}
	*/
     public function build() {
	   $form = $this->formBuilder->getForm('Drupal\custom_form\Form\customForm');
       return $form;
     }

   }