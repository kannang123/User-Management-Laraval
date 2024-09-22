<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body>

  <div class="container">
    <div class="card register">
      <?php if($errors->any()): ?>
      <div class="alert alert-danger error-message">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
      <?php endif; ?>

      <?php if(session('error')): ?>
      <div  class="alert alert-danger error-message">
        <?php echo e(session('error')); ?>

      </div>
      <?php endif; ?>
      <h2>Register</h2>
      <form method="POST" action="<?php echo e(route('register')); ?>" id="registrationForm">
        <?php echo csrf_field(); ?>
        <input type="text" name="name" id="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" name="mobile" id="mobile_no" placeholder="Mobile" maxlength="10"  pattern="^[1-4][0-9]{9}$" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
      </form>
    <p style="text-align: center;">Already Register  <a href="login"> Login</a> </p>
    </div>
    <div class="separator"></div>

  </div>
</body>

<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #ffffff;
    font-family: 'Arial', sans-serif;
    margin: 0;
  }

  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    max-width: 800px;
  }

  .card {
    width: 45%;
    margin: 0 10px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    box-sizing: border-box;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .separator {
    width: 5px;
    background: linear-gradient(to bottom, #ffcc00, #ffcc00);
  }

  h2 {
    margin-bottom: 20px;
    color: #333;
  }

  form {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
  }

  input {
    margin-bottom: 12px;
    padding: 10px;
    border: none;
    border-bottom: 2px solid #ffcc00;
    font-size: 16px;
    background: none;
  }

  input:focus {
    outline: none;
    border-bottom-color: #ff9900;
  }

  button {
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #ffcc00;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top:18px;
  }

  button:hover {
    background-color: #ff9900;
  }

  .alert-danger {
    --tblr-alert-color: #d63939;
  }

  .alert {
    background: #ffffff;
    border: 1px solid rgba(98, 105, 118, 0.16);
    border-left: 0.25rem solid var(--tblr-alert-color);
    box-shadow: rgba(30, 41, 59, 0.04) 0 2px 4px 0;
  }
  label.error{
    display: block;
    color: #ff0000;
    font-size: 12px;
    margin-top: 5px;
    line-height: 18px;
    margin-bottom: 0;
  }
</style>

<script>
  console.log(1)
  $(document).ready(function(){


    if ($(".error-message").length) {
      setTimeout(function() {
        $(".error-message").fadeOut();
      }, 3000);
    }

    $("#name").on("input", function () {
    var regexp = /[^a-zA-Z]/g;
    if ($(this).val().match(regexp)) {
      $(this).val($(this).val().replace(regexp, ''));
    } 
  });

    //Only Mobile Numbers
  $("#mobile_no").on("input", function () {
    var regexp = /[^0-9]/g;
    if ($(this).val().match(regexp)) {
      $(this).val($(this).val().replace(regexp, ''));
    } 
  });

    $.validator.addMethod("phonenumbers", function (value, element) {
      return this.optional(element) || /^[6-9][0-9]+$/i.test(value);
    });

    $.validator.addMethod("validateEmail", function (value, element) {
      return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.(co\.in|co|com|net|in)$/i.test(value);
    });

    $.validator.addMethod("strongPassword", function(value, element) {
        return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()])[A-Za-z\d!@#$%^&*()]{8,}$/.test(value);
    });
    // Password must be at least 8 characters long and include uppercase letters, lowercase letters, numbers, and special characters

    $('#registrationForm').validate({
    ignore: [],
    rules: {
      name: {
        required: true,
      },
      email: {
        required: true,
        validateEmail: true,
      },
      mobile: {
        required: true,
        phonenumbers: true,
        minlength: 10
      },
      address: {
        required: true,
      },
      password: {
        required: true,
        strongPassword: true
      },
      password_confirmation: {
        equalTo: "#password"
      },
    },
    messages: {
      name: {required : "Please Enter Name" },
      address: {required : "Please Enter Name" },
      email: {
        required : "Please Enter Email",
        validateEmail: "Please Enter Valid Email Ex:abc@gmail.com",
         },
      mobile: {
        required : "Please Enter mobile Number" ,
        phonenumbers : "Please Enter Valid Mobile No"
      },
      password: {
        required : "Please Enter Password" ,
        strongPassword : "Please Enter Strong Password Ex:Admin@1234"
      },
      password_confirmation: {
        required : "Please Enter Confirm Password",
        equalTo: "Password Does Not Match"

      },
    }
});
  })
</script><?php /**PATH /var/www/html/user-registration/resources/views/user/register.blade.php ENDPATH**/ ?>