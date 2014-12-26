		<td class="article_line">
			<?php 
				
				$option = array(
						'target'	=> '_blank',
						'escape'	=> false,
// 						'?'	=> "article_url=".$a['url']
// 						'article_url'	=> $a['url']
				);
				
				$param = array(
					
						'article_url'	=> $a['url'],
						'article_line'	=> $a['line'],
						'article_vendor'	=> $a['vendor'],
						'article_news_time'	=> $a['news_time'],
						'article_category_id'	=> $k,
				);
			
				echo $this->Html->link(
								$a['line'],
								array(
									'action'	=> 'open_article',
									//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html "'?' => array('height' => 400, 'width' => 500))"
									'?'			=> $param
// 									'?'	=> "article_url=".$a['url']
// 									'article_url'	=> $a['url']
								),
// 								$a['url'],
								$option
					);
			?>
			
			<?php //echo $a['line']; ?>
		</td>
