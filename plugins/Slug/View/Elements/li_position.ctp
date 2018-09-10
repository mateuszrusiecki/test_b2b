            <div class="child clearfix">
                <div class="action">
                <?php 
                    $optionsFull = array('update'=>'#tree', 'class'=>'button','before'=>'blockAll();', 'complete'=>'unblockAll();');  
                 ?>
            
                    <?php echo $this->Js->link(__('Usuń'), 
                                    array('plugin' => 'tree', 'controller'=>'tree', 'action'=>'delete', $modelAlias, $value[$modelAlias]['id'],1, 'admin'=>false, 'user' => false), 
                                    array_merge($optionsFull, 
                                            array('confirm'=>__('Usunąć pozycję, oraz wszystkie pozycje podrzędne?'),
                                                  'title'=>'Usuń wszystkie pozycje'  
                                                ))); ?>
                    <?php //echo $this->Js->link('edit', 
                            //        array('controller'=>'categories', 'action'=>'edit_name', $value[$modelAlias]['id'], 'admin'=>false), 
                              //      $options); 
                            ?>
                </div>
                <span><?php echo $value[$modelAlias]['name']; ?></span>
            </div>