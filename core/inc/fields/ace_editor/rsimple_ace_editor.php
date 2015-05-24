<?php
/**
 * RSimple Field Ace Editor
 */

class rsimple_ace_editor{
	public $args;
	public $fieldArgs;

	public function __construct( $args = array(), $value=''){		
		$this->fieldArgs = wp_parse_args( $args, $this->args_default() );
		$this->value = $value;	}

	public function display(){
		?>		
		<div class="rsimple-ace_editor">
			<div class="ace-wrapper">
				<textarea name="<?php echo $this->fieldArgs['name']; ?>"
						id="<?php echo $this->fieldArgs['id']; ?>"
						class="ace-editor hidden"
						data-editor="editor-<?php echo $this->fieldArgs['id']; ?>"
						data-theme="<?php echo $this->fieldArgs['theme']; ?>"
						data-mode="<?php echo $this->fieldArgs['mode']; ?>"
						>
						<?php echo $this->value; ?>
				</textarea>
				<pre id="editor-<?php echo $this->fieldArgs['id']; ?>"><?php echo htmlspecialchars( $this->value ); ?></pre>			
			</div>
		</div>
		<?php
	}

	public function enqueue(){
		wp_enqueue_script('rsimple-ace', rsimple_framework::$__url .'inc/fields/ace_editor/js/ace.js');
		wp_enqueue_script('rsimple-ace_editor', rsimple_framework::$__url .'inc/fields/ace_editor/rsimple_ace_editor.js');
		wp_enqueue_style('rsimple-ace_editor', rsimple_framework::$__url .'inc/fields/ace_editor/rsimple_ace_editor.css');
	}

	private function args_default(){
		$args = array(
			'theme' => 'monokai',
			'mode' => 'javascript'
		);

		return $args;
	}

}