<tr>
		<th>
		
			<?php

				echo $this->Html->link(
						'ID',
						$this->Mytest->build_Path_ContActionParam(
								'positions', 'index', 'sort=id')
				);
					
			?>
			
		</th>
		
		<th>
		
			<?php

				echo $this->Html->link(
						'video_id',
						$this->Mytest->build_Path_ContActionParam(
								'positions', 'index', 'sort=video_id')
				);
				
			?>
			
		</th>
		
		<th>
		
			<?php

				echo $this->Html->link(
						'Point',
						$this->Mytest->build_Path_ContActionParam(
								'positions', 'index', 'sort=point')
				);
					
			?>
			
		</th>
		
		<th>
		
			<?php 
				echo $this->Html->link(
				    'Memo',
				    $this->Mytest->build_Path_ContActionParam(
										'positions', 'index', 'sort=memo')
				);
			
			?>
			
		</th>
		
		<th>
		
			<?php

				echo $this->Html->link(
						'Created at',
						$this->Mytest->build_Path_ContActionParam(
								'positions', 'index', 'sort=created_at')
				);
					
			?>
			
		</th>
		
		<th>
		
			<?php

				echo $this->Html->link(
						'Updated at',
						$this->Mytest->build_Path_ContActionParam(
								'positions', 'index', 'sort=updated_at')
				);
					
			?>
			
		</th>
		
</tr>
