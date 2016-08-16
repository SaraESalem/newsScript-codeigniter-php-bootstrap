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
    <h3>Add Category :</h3>
                    <?php echo form_open('news/add_category'); //controller //action
                                $cat_name = array(
                                    'name'        => 'cat_name',
                                    'placeholder' => "Please Enter a category Name",
                                    'class'       => "input-lg"
                                );
                        echo form_input($cat_name); //name ,value,extra
                         echo form_error('cat_name', '<span class="error">', '</span>'); 
                        
                        $submit = array(
                        'name' => 'submit',
                        'class' => "btn-primary btn-lg",
                        'value' => 'Add'
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