<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for the salutation message.
 */
class HelloWorldController extends controllerBase {

	/**
	 * Hello World.
	 *
	 * @return array
	 * 	Our message.
	 */
		public function helloWorld() {
				return array(
					'#markup' => $this->t('Hello World!'),
				);
		}
}
