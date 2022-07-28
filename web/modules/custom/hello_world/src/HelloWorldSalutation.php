<?php

namespace Drupal\hello_world;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Prepares the salutation to the world.
 */
class HelloWorldSalutation {
	use StringTranslationTrait;

	/**
	 * @var ConfigFactoryInterface
	 */
	protected $configFactory;

	/**
	 * HelloWorldSalutation constructor.
	 *
	 * @param ConfigFactoryInterface $configFactory
	 */
	public function __construct(ConfigFactoryInterface $configFactory) {
		$this->configFactory = $configFactory;
	}

	/**
	 * Returns the salutation
	 */
	public function getSalutation() {
		$config = $this->configFactory->get('hello_world.custom_salutation');
		$salutation = $config->get('salutation');

		if($salutation !== '' && $salutation) {
			return $salutation;
		}

		$time = new \DateTime();
		if((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
			return $this->t('Good morning world');
		}

		if((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
			return $this->t('Good afternoon world');
		}

		if((int) $time->format('G') >= 18 && (int) $time->format('G') < 24) {
			return $this->t('Good evening world');
		}
	}
}
