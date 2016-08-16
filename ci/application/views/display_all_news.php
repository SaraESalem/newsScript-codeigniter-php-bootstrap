<header> 
       <a href='<?php echo base_url()."newsadd"  ?>' style="font-size: 200%">[ Add News ]</a>      
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
      <aside>
      	<h3>All Categories</h3>
            <nav>
            	<?php 
            	foreach($cat_res as $row)
                        { 
                          echo '<a class="btn-danger" href="'.base_url().'news/display_cat_details/'.$row->id.'">'.$row->name.'</a>';
                        }
                ?>

       </aside>
       
       <?php 
            foreach($news_res as $row)
                { 
        ?>
        <div class="center_content">
        <div class="center_title_bar"><?php echo $row->title ?></div>
        <div class="prod_box_big">
          <div class="center_prod_box_big">
            <div class="product_img_big"><img src="<?php echo base_url().'uploads/'.$row->img ?>"> </div>
            <div class="details_big_box">
         	  <span class="blue"><?php echo $row->text ?> </span><br />
         	  <a href="<?php echo base_url().'news/edit_news/'.$row->id ?> " class="prod_buy">Edit</a>
         	  <a href="<?php echo base_url().'news/delete_news/'.$row->id ?> " class="prod_buy">Delete</a>
            </div>
          </div>
        </div>
        </div>
        
        <?php            
               }
                ?>
                    
</div>
