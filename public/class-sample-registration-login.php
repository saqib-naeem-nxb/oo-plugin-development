<?php

/**
 * Custom script for customer registration and login from front-end
 * 
 */

class Sample_Registration_ligin{

    public $first_name;
    public $last_name;
    public $user_name;
    public $email;
    public $password;
    public $errors;

    public function __cunstruct(){
        // $this->errors = array();
    }
    public function registration_form ( $first_name, $last_name, $user_name, $email, $password ){
?>
<h3>Register with us now</h3>
<form action=<?= $_SERVER['REQUEST_URI']; ?> method="POST">
<label for="<?php esc_attr_e( "first_name", "sample-plugin" ) ?>"><?php esc_html_e( "First Name", "sample-plugin" ); ?></label>
<input 
    type="text" 
    name="<?php esc_attr_e( "first_name", "sample-plugin" ) ?>" 
    id="<?php esc_attr_e( "first_name", "sample-plugin" ) ?>"
    class=""
    value="<?= isset($first_name) ? $first_name : ""; ?>">
<label for="<?php esc_attr_e( "last_name", "sample-plugin" ) ?>"><?php esc_html_e( "Last Name", "sample-plugin" ); ?></label>
<input 
    type="text" 
    name="<?php esc_attr_e( "last_name", "sample-plugin" ) ?>" 
    id="<?php esc_attr_e( "last_name", "sample-plugin" ) ?>"
    class=""
    value="<?= isset($last_name) ? $last_name : ""; ?>">

<label for="<?php esc_attr_e( "user_name", "sample-plugin" ) ?>"><?php esc_html_e( "User Name", "sample-plugin" ); ?></label>
<input 
    type="text" 
    name="<?php esc_attr_e( "user_name", "sample-plugin" ) ?>" 
    id="<?php esc_attr_e( "user_name", "sample-plugin" ) ?>"
    class=""
    value="<?= isset($user_name) ? $user_name : ""; ?>">
<label for="<?php esc_attr_e( "email", "sample-plugin" ) ?>"><?php esc_html_e( "Email Address", "sample-plugin" ); ?></label>
<input 
    type="email" 
    name="<?php esc_attr_e( "email", "sample-plugin" ) ?>" 
    id="<?php esc_attr_e( "email", "sample-plugin" ) ?>"
    class=""
    value="<?= isset($email) ? $email : ""; ?>">
<label for="<?php esc_attr_e( "password", "sample-plugin" ) ?>"><?php esc_html_e( "Password", "sample-plugin" ); ?></label>
<input 
    type="password" 
    name="<?php esc_attr_e( "password", "sample-plugin" ) ?>" 
    id="<?php esc_attr_e( "password", "sample-plugin" ) ?>"
    class=""
    value="">
    <div style="height: 30px"></div>
<input 
    type="submit" 
    name="<?php esc_attr_e( "register", "sample-plugin" ) ?>" 
    id="<?php esc_attr_e( "register", "sample-plugin" ) ?>"
    class=""
    value="Register Now">
</form>
<?php
    }

    public function form_validation ( $first_name, $last_name, $user_name, $email, $password ){
       $this->errors = $errors = new WP_Error;

        if( empty($first_name) || empty($last_name) || empty($user_name) || empty($email) || empty($password) ){
            $errors->add("required", "All fields are required");
        }

        if( strlen($first_name) <3 || strlen($last_name) < 3 || strlen($user_name) < 3 ){
            $errors->add("input_length", "Input value is too Short");
        }

        if( !username_exists( $user_name ) ){
            if( !validate_username( $user_name ) ){
                $errors->add("username_error", "Username invalid or  already exist");
            }
        }
        if(!is_email( $email )){
           if(email_exists( $email )){
            $errors->add("email_error", "Email invalid or  already exist");
           } 
        }

        if(strlen($password) <=6 ){
            $errors->add("password_length", "Invalid Password. Password Length atleast 7 charactors");
        }

        if(is_wp_error( $errors )){
            echo "<div class='danger'>";
            foreach($errors as $err_mess){
               foreach($err_mess as $key=>$msg){
                echo $msg[0]."<br/>";
               }
            }
            echo "</div>";

        }

    }
    public function complete_registration (){
        if(1 > count( $this->errors->get_error_messages() ) ){
            $user_data = array(
                'first_name'        => $this->first_name,
                'last_name'         => $this->last_name,
                'user_login'        => $this->user_name,
                'user_email'        => $this->email,
                'user_pass'         => $this->password,
            );
            
            if($this->insert_user($user_data) == true){
                $this->login_user($this->first_name, $this->password);
            }else{
                // $err = $this->insert_user($user_data);
                echo "<p>Errr</p>";
            }


        }
    }

    public function init(){

        if( !is_user_logged_in(  ) ){
            $this->registration_form( $first_name, $last_name, $user_name, $email, $password );
        }
        if(isset($_POST['register'])){
            $this->first_name   = $first_name = sanitize_text_field( $_POST['first_name'] );
            $this->last_name    = $last_name  = sanitize_text_field( $_POST['last_name'] );
            $this->user_name    = $user_name  = sanitize_user( $_POST['user_name'] );
            $this->email        = $email      = sanitize_email( $_POST['email'] );
            $this->password     = $password   = esc_attr( $_POST['password'] );
    
            $this->form_validation( $first_name, $last_name, $user_name, $email, $password );   
            
            $this->complete_registration();
        }
    }

    public function insert_user($user_data){
        
        $status = wp_insert_user( $user_data );

        if(!empty($status->errors)){
            $err = "";
            foreach($status->errors as $err_mess){ 
                $err = $err_mess[0];
            }
            return false;
    
        }
        return true;

    }

    public function login_user($user_name, $password){
        wp_signon( array(
            'user_login' => $this->user_name, 
            'user_password'=> $this->password,
            'remember'  => false
        ));
        // wp_safe_redirect( "http://localhost/web/wordpress/dashboard/", 200 );
    }
}

?>