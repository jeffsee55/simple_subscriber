<?php

while (have_posts()) : the_post();
  get_template_part('templates/page', 'header');
  get_template_part('templates/content', 'page');
endwhile;

?>

<form class="entry-content" id="ss_signin_form" method="post">
  <div class="form-group row">
    <input type="hidden" name="action" value="simple_subscriber_signin">
    <label for="example-email-input" class="col-xs-4 col-form-label">Email</label>
    <div class="col-xs-8">
      <input name="email" class="form-control" type="email" value="" id="email-input">
    </div>
  </div>
  <div class="form-group row">
    <label for="password-input" class="col-xs-4 col-form-label">Password</label>
    <div class="col-xs-8">
      <input name="password" class="form-control" type="password" value="" id="password-input">
    </div>
  </div>
  <div class="form-group row signin-submit">
    <button type="submit" class="m-x-auto btn btn-primary">Sign In</button>
  </div>
</form>
