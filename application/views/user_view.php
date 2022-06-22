<!doctype html>
<html>
    <head>
        <title>How to Send AJAX request with CSRF token in CodeIgniter</title>
    </head>
    <body>
    
        <!-- CSRF token (Here, name is 'csrf_hash_name' which is specified in $config['csrf_token_name'] in config.php file ) -->  
        <input type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>                                                                                                                     
        Select Username : <select id='sel_user'>
            <option value='yssyogesh'>yssyogesh</option>
            <option value='sonarika'>sonarika</option>
            <option value='vishal'>vishal</option>
            <option value='sunil'>sunil</option>
        </select>
        

        <!-- User details -->
        <div >
            Username : <span id='suname'></span><br/>
            Name : <span id='sname'></span><br/>
            Email : <span id='semail'></span><br/>
        </div>

        <!-- Script -->
        <script src="<?php echo base_url(); ?>script/jquery-3.4.1.min.js"></script>
        <script type='text/javascript'>
            // baseURL variable
            var baseURL= "<?php echo base_url();?>";

            $(document).ready(function(){
                
                $('#sel_user').change(function(){
                    //debugger;
                    var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                    var username = $(this).val();
                   
                    $.ajax({
                        url:'<?=base_url()?>index.php/User/userDetails',
                        method: 'post',
                        data: {username:username,[csrfName]:csrfHash },
                        dataType: 'json',
                        success: function(response){
                            //debugger;
                            // Update CSRF hash
                            $('.txt_csrfname').val(response.token);

                            // Empty the elements
                            $('#suname,#sname,#semail').text('');

                            // Loop on response
                            $(response[0]).each(function(key,value){
                               
                                var uname = value.username;
                                var name = value.name;
                                var email = value.email;
                                
                                $('#suname').text(uname);
                                $('#sname').text(name);
                                $('#semail').text(email);
                            });
                            
                        },
                        error: function(response){
                            if(response.status==403){
                                alert("Invalid CSRF Token");
                            }
                            else{
                                alert("Some error");
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>