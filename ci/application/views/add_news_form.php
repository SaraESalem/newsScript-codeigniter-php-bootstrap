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
            <h3>Add News :</h3>

                    <?php 
                    $attributes = array('class' => 'mainsettingsform add newPage');

                    echo form_open_multipart('news/add_news', $attributes); //controller //action
                                $title = array(
                                    'name'        => 'title',
                                    'placeholder' => "Please Enter News Title",
                                    'class'       => "input-lg"
                                );
                        echo form_input($title); //name ,value,extra
                        echo form_error('title', '<span class="error">', '</span>'); 
                         $text = array(
                                    'name'        => 'text',
                                    'placeholder' => "Please Enter Text Here"
                                );
                        echo form_textarea($text);
                        echo form_error('text', '<span class="error">', '</span>'); 
                        echo form_label('Upload Image :', 'img');
                        echo '<input type="file" name="img_file" size="20" />';
                        
                        echo form_error('img_file', '<span class="error">', '</span>'); 
                        echo form_label('Choose Category :', 'cats');
                        echo '<select name="cats">';

                        foreach($cat_res as $row)
                        { 
                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        }
                        echo '</select>',"  OR <a href='".base_url()."news' style='font-weight:bold'> Add Category</a>";//large selected;;
                        echo form_error('cats', '<span class="error">', '</span>');
                        $submit = array(
                        'name' => 'submit',
                        'class' => "btn-primary btn-lg",
                        'value' => 'Add News'
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