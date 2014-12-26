<tr>

		<th class="table_header">
		
			<?php echo $this->Html->link(
								'ID',
								array('controller' => 'keywords', 
										'action' => 'index',
										'?' => "sort=id"),
								array('class'	=> 'has_link'));
			?>
				
				
		</th>
		
		<th class="table_header">
		
			<?php echo $this->Html->link(
								'Name',
								array('controller' => 'keywords', 
										'action' => 'index',
										'?' => "sort=name"),
								array('class'	=> 'has_link'));
			?>
			
			<?php 
			
				$opt_create = array(
						'div' => false,
						//REF http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#options-for-create
						'type' => 'get');
				
				$opt_input = array(
						'type'	=> 'input',
// 						'type'	=> 'textarea',
						'cols'	=> 5,
						'rows'	=> 1,
// 						'options'	=> $select_Genres,
// 						//REF http://satussy.blogspot.jp/2011/07/cakephp-select.html "見つけた方法は"
// 						'selected'	=> $genre_id,
							
						'label'		=> false,
						'name'		=> "search",
						'div'		=> false
							
// 						'class'		=> 'select_genre'
				);
				
				$opt_end = array(
						'div' => false,
							
						'class'	=> 'submit_go'
				
				);
				
				echo $this->Form->create('Search', $opt_create);
// 				echo $this->Form->create('Search', $opt_create);
				echo $this->Form->input('', $opt_input
				
				);

				//REF http://stackoverflow.com/questions/6360767/form-end-without-a-div-in-cakephp answered Jun 15 '11 at 17:06
				echo $this->Form->submit("Search", $opt_end);
					
			
			?>
				
		</th>
		
		<th class="table_header">
		
			<?php echo $this->Html->link(
								'Category',
								array('controller' => 'keywords', 
										'action' => 'index',
										'?' => "sort=category_id"),
								array('class'	=> 'has_link'));
			?>
				
		</th>
		<th class="table_header">Genre</th>
		<th class="table_header">Created at</th>
		<th class="table_header">updated at</th>
		
</tr>
