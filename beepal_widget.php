<?php
class beepal_widget extends WP_Widget {
	function __construct() {
		parent::__construct(false,$name = "Beepal Widget");
	}
	
	function form($instance) {
		?>
		<p>
			<label for='<?=$this->get_field_id('beepal_size')?>'>Widget Width:
				<select class='widefat' id='<?=$this->get_field_id('beepal_size')?>' name='<?=$this->get_field_name('beepal_size')?>'>
					<option value='200' <?=($instance['beepal_width'] == 200) ? "selected='true'" : ""?>>Small (200px)</option>
					<option value='300' <?=($instance['beepal_width'] == 300) ? "selected='true'" : ""?>>Medium (300px)</option>
					<option value='400' <?=($instance['beepal_width'] == 400) ? "selected='true'" : ""?>>Large (400px)</option>
					<option value='custom' <?=($instance['beepal_width'] > 400) ? "selected='true'" : ""?>>Custom</option>
				</select>
			</label>		
		</p>
		
		<p id="p_<?=$this->get_field_id('beepal_width')?>" <?=($instance['beepal_width'] <= 400) ? 'style="display:none;"' : ""?>>
			<label for='<?=$this->get_field_id('beepal_width')?>'>Custom Width(in px):
				<input type='text' class='widefat' id='<?=$this->get_field_id('beepal_width')?>' name='<?=$this->get_field_name('beepal_width')?>' value="<?=$instance['beepal_width']?>"/>
			</label>		
		</p>
			
		<p>
			<input type="checkbox" class="checkbox" id="<?=$this->get_field_id('beepal_items')?>" name="<?=$this->get_field_name('beepal_items')?>" value="yes">
			<label for="<?=$this->get_field_id('beepal_items')?>">Show products</label>
		</p>
		<script>
			jQuery(function() {
				jQuery('#<?=$this->get_field_id('beepal_size')?>').on('change',function() {
					if(jQuery(this).val() == 'custom') {
						jQuery('#p_<?=$this->get_field_id('beepal_width')?>').show();
						jQuery('#<?=$this->get_field_id('beepal_width')?>').val("");		
					}
					else {
						jQuery('#p_<?=$this->get_field_id('beepal_width')?>').hide();
						jQuery('#<?=$this->get_field_id('beepal_width')?>').val(jQuery(this).val());			
					}
					items_check();
				});
								
				jQuery('#<?=$this->get_field_id('beepal_width')?>').on('keyup',function() {
					items_check();
				});
				items_check();				
				<?php if(!isset($instance['beepal_items']) || (isset($instance['beepal_items']) && !$instance['beepal_items'])) { ?>jQuery('#<?=$this->get_field_id('beepal_items')?>').prop('checked',false);<?php } ?>
				function items_check() {
					if(jQuery('#<?=$this->get_field_id('beepal_width')?>').val() < '400') jQuery('#<?=$this->get_field_id('beepal_items')?>').prop('disabled',true).prop('checked',false);
					else jQuery('#<?=$this->get_field_id('beepal_items')?>').prop('disabled',false).prop('checked',true);
				}
			});
		</script>
		<?php
	}
	
	function update($new_instance,$old_instance) {
		$instance['beepal_width'] = trim(strip_tags($new_instance['beepal_width']));
		$instance['beepal_items'] = (isset($new_instance['beepal_items']) && $new_instance['beepal_items']) == 'yes' ? true : false;
		return $instance;
	}
	
	function widget($args,$instance) {
		?>
		<div class='beepal_widget_box'>
		<?php
			$height=0;
			$productsHeight = ($instance['beepal_items']) ? 220 : 0;		
			if($instance['beepal_width'] >= 300) {
				$height = $instance['beepal_width'] + 50 + 2 + 1 + $productsHeight;
			}else {
				$height = $instance['beepal_width'] + 46 + 2 + 1;
			}
			$widthSizes = array('200'=>230,'300'=>335,'400'=>640);
			if(isset($widthSizes[$instance['beepal_width']])) $height = $widthSizes[$instance['beepal_width']];
		?>
		<iframe src="http://backend.beepal.co.uk/influence_widget/<?=get_option("beepal_username")?>?width=<?=$instance['beepal_width']?><?=$instance['beepal_items'] ? "&products=true" : ""?>" style="border:0" width="<?=$instance['beepal_width']?>" height="<?=$height?>"></iframe>
		</div>
		<?php
	}
}

add_action('widgets_init',function() {
	if(get_option("beepal_username") != "") register_widget('beepal_widget');
});