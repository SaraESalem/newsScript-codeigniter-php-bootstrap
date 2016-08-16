<div class="contents logincont">
                <h4>Welcome To Sara Salem News Script :</h4>
                <div class="register">
                    <h1>New Writer ? Register Now :</h1>
                    <?php
                        echo form_open('login/registration'); //controller //action
                        $username = array(
                                    'name'        => 'username',
                                    'placeholder' => "Please write your Name",
                                    'class'       => "input-lg"
                                );
                        echo form_input($username); //name ,value,extra
                        echo form_error('username', '<span class="error">', '</span>'); 
                        $email = array(
                                    'name'        => 'email',
                                    'placeholder' => "Please Write Your Email",
                                    'class'       => "input-lg"
                                );
                        echo form_input($email); //name ,value,extra
                        echo form_error('email', '<span class="error">', '</span>'); 
                        $password = array(
                                    'name'        => 'password',
                                    'placeholder' => "Please Write Your password",
                                    'class'       => "input-lg"
                                );
                        echo form_password($password);
                        echo form_error('password', '<span class="error">', '</span>'); 
                        $cpassword = array(
                                    'name'        => 'cpassword',
                                    'placeholder' => "Please Confirm Password",
                                    'class'       => "input-lg"
                                );
                        echo form_password($cpassword);
                        echo form_error('cpassword', '<span class="error">', '</span>'); 
                        $submit = array(
                        'name' => 'submit',
                        'class' => "btn-primary btn-lg",
                        'value' => 'Register'
                        );
                        echo form_submit($submit);
                        echo form_close(); 

                     ?>  
                     <label id="regstatues"></label>
                </div>

                <div class="login">
                    <h1>Login :</h1>
                    <?php echo form_open('login/writer_login'); //controller //action
                                $username = array(
                                    'name'        => 'username2',
                                    'placeholder' => "Please Enter a Name",
                                    'class'       => "input-lg"
                                );
                        echo form_input($username); //name ,value,extra
                        echo form_error('username2', '<span class="error">', '</span>'); 
                        $password = array(
                                    'name'        => 'password2',
                                    'placeholder' => "Please Enter a Password",
                                    'class'       => "input-lg"
                                );
                        echo form_password($password);
                        echo form_error('password2', '<span class="error">', '</span>');
                        $submit = array(
                        'name' => 'submit',
                        'class' => "btn-primary btn-lg",
                        'value' => 'Login'
                        );
                        
                        echo form_submit($submit);
                          echo form_close(); 
                    ?>
                      
                </div>
</div>
<style>
.error{
color:#FF0000;
}
</style>