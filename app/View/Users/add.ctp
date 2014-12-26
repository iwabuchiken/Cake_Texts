<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php 
        	
	        $opt_input = array(
	        
	        		'onmouseover' => 'this.select();',
	        		
	        		'rows' => '1',
	        			
// 	        		'class'	=> 'add_name'
	        		// 			'cols'	=> '10'
	        // 			'width'	=> '100px'
	        // 			'columns'	=> '5'
	        			
	        );
	        
        	
        	echo $this->Form->input('username', $opt_input);
	        echo $this->Form->input('password', $opt_input);
	        echo $this->Form->input('role', array(
	            'options' => array('admin' => 'Admin', 'author' => 'Author')
        	));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>