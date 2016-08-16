        <header> 
             <a href='<?php echo base_url()."news/allNews"  ?>' style="font-size: 200%">[ All News ]</a> 
            <h2>Welcome 
                <?php
                if($this->session->userdata('is_logged_in')){
                    echo $this->session->userdata('username');                    
                }               
                ?>
                <a href='<?php echo base_url()."login/logout"  ?>'>Logout</a>
            </h2>
        </header>

        <div class="clear"></div>
        <div class="contents">
            <h3>Edit News :</h3>

                    <?php 
                    $attributes = array('class' => 'mainsettingsform add newPage');

                    echo form_open_multipart('news/update_news/'.$res->id.'', $attributes); //controller //action
                                $title = array(
                                    'name'        => 'title',
                                    'value'       => $res->title,
                                    'class'       => "input-lg"
                                );
                        echo form_input($title); //name ,value,extra
                        echo form_error('title', '<span class="error">', '</span>'); 
                         $text = array(
                                    'name'        => 'text',
                                    'value'       => $res->text
                                );
                        echo form_textarea($text);
                        echo form_error('text', '<span class="error">', '</span>'); 
                        echo form_label('Upload Image :', 'img');
                        echo '<input type="file" name="img_file" size="20" />';
                        echo '<img src="'.base_url().'uploads/'.$res->img.'"/>';
                        echo form_error('img_file', '<span class="error">', '</span>'); 
                        echo form_label('Choose Category :', 'cats');
                        echo '<select name="cats">';
                        foreach($cat_res as $row)
                        { 
                            ?>
                            
                            <option value="<?php echo $row->id;?>"
                            <?php  if ($cat_name->name == $row->name)
                            {
                                echo 'selected';
                            }
                            ?>>
                            <?php echo $row->name;?>
                            
                           </option> 
                            
                              
                    <?php
                        }
                        echo '</select>';
                        //echo '<select name="cats">';
                        //echo '<option value="'.$res->id.'">'.$cat_name->name.'</option>';
                        //echo '</select>';//large selected;;
                        echo form_error('cats', '<span class="error">', '</span>');
                        $submit = array(
                        'name' => 'submit',
                        'class' => "btn-primary btn-lg",
                        'value' => 'Edit News'
                        );
                        
                        echo form_submit($submit);
                        echo form_close(); 
                    ?>
        </div>
        <style>
.error{
color:#FF0000;
}
</style>