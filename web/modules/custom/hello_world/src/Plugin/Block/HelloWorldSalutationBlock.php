<?php

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\hello_world\HelloWorldSalutation;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
	 * Hello World salutation block.
	 *
	 * @Block(
	 *     id = "hello_world_salutation_block",
	 *     admin_label = @Translation("Hello World salutation"),
	 *  )
	 */
class HelloWorldSalutationBlock extends BlockBase implements ContainerFactoryPluginInterface {

	/**
	 * The salutation service.
	 */
	protected HelloWorldSalutation $salutation;

	/**
	 * Construct a  HelloWorldSalutationBlock.
	 */
	public function __construct(array $configuration, $plugin_id, $plugin_definition, HelloWorldSalutation $salutation) {
		parent::__construct($configuration, $plugin_id, $plugin_definition);
		$this->salutation = $salutation;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): HelloWorldSalutationBlock|ContainerFactoryPluginInterface|static
	{
		return new static(
			$configuration,
			$plugin_id,
			$plugin_definition,
			$container->get('hello_world.salutation')
		);
	}

	/**
	 * {@inheritdoc}
	 */
	#[ArrayShape(['#markup' => "mixed"])] public function build(): array {
		return [
			'#markup' => $this->salutation->getSalutation()
		];
	}
}

