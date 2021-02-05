<?php require_once '../config.php'; ?>
<?php

try {
  //throw new Exception("Not yet implemented");
  $rules = [
    "email" => "present|email|minlength:7|maxlength:64",
    "password" => "present|minlength:8|maxlength:64",
    "name" => "present|minlength:4|maxlength:64"
  ];
  $request->validate($rules);

  if ($request->is_valid()) {
    $email = $request->input("email");
    $password = $request->input("password");
    $name = $request->input("name");
    $user = User::findByEmail($email);
    if ($user !== null) {
      $request->set_error("email", "Email address is already registered");
    }
    else {
      $user = new User();
      $user->email = $email;
      $user->password = password_hash($password, PASSWORD_DEFAULT);
      $user->name = $name;
      $user->save();
    }
  } 
}
catch(Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");
  $request->session()->set("flash_data", $request->all());
  $request->session()->set("flash_errors", $request->errors());

  $request->redirect("/views/auth/register-form.php"); //added /views/auth/to the register-form.php script  
}

if ($request->is_valid()) {
  $request->session()->set('email', $user->email);
  $request->session()->set('name', $user->name);
  $request->session()->forget("flash_data");
  $request->session()->forget("flash_errors");

  $request->redirect("/customer/home.php"); // added /customer to /home.php
}
else {
  $request->session()->set("flash_data", $request->all());
  $request->session()->set("flash_errors", $request->errors());

  $request->redirect("/views/auth/register-form.php");//added /views/auth/to the register-form.php script
}
//}
// catch(Exception $ex) {
//   $request->session()->set("flash_message", $ex->getMessage());
//   $request->session()->set("flash_message_class", "alert-warning");

//   $request->redirect("/views/auth/register-form.php");   
//}
?>