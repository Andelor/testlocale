<?php

namespace OOUI;

/**
 * Layout with an HTML form.
 */
class FormLayout extends Layout {
	use GroupElement;

	/* Static Properties */

	public static $tagName = 'form';

	/**
	 * @param array $config Configuration options
	 * @param string $config['method'] HTML form `method` attribute
	 * @param string $config['action'] HTML form `action` attribute
	 * @param string $config['enctype'] HTML form `enctype` attribute
	 * @param FieldsetLayout[] $config['items'] Items to add
	 */
	public function __construct( array $config = [] ) {
		// Parent constructor
		parent::__construct( $config );

		// Traits
		$this->initializeGroupElement( array_merge( $config, [ 'group' => $this ] ) );

		// Initialization
		$attributeWhitelist = [ 'method', 'action', 'enctype' ];
		$this
			->addClasses( [ 'oo-ui-formLayout' ] )
			->setAttributes( array_intersect_key( $config, array_flip( $attributeWhitelist ) ) );
		if ( isset( $config['items'] ) ) {
			$this->addItems( $config['items'] );
		}
	}

	public function getConfig( &$config ) {
		foreach ( [ 'method', 'action', 'enctype' ] as $attr ) {
			$value = $this->getAttribute( $attr );
			if ( $value !== null ) {
				$config[$attr] = $value;
			}
		}
		return parent::getConfig( $config );
	}
}
