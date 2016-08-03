<?php

while (have_posts()) : the_post();
  get_template_part('templates/page', 'header');
  get_template_part('templates/content', 'page');
endwhile;

$user = wp_get_current_user();

?>

<form class="entry-content" id="ss_profile_form" method="post">
  <div class="form-group row">
    <input type="hidden" name="action" value="simple_subscriber_profile">
    <label for="first-name-input" class="col-xs-4 col-form-label">First Name</label>
    <div class="col-xs-8">
      <input name="first_name" class="form-control" type="text" value="<?php echo $user->first_name; ?>" id="first-name-input">
    </div>
  </div>
  <div class="form-group row">
    <label for="last-name-input" class="col-xs-4 col-form-label">Last Name</label>
    <div class="col-xs-8">
      <input name="last_name" class="form-control" type="text" value="<?php echo $user->last_name; ?>" id="last-name-input">
    </div>
  </div>
  <div class="form-group row">
    <input type="hidden" name="action" value="simple_subscriber_profile">
    <label for="example-email-input" class="col-xs-4 col-form-label">Email</label>
    <div class="col-xs-8">
      <input name="email" class="form-control" type="email" value="<?php echo $user->user_email; ?>" id="email-input">
    </div>
  </div>
  <div class="form-group row">
    <label for="example-tel-input" class="col-xs-4 col-form-label">Telephone</label>
    <div class="col-xs-8">
      <input name="phone" class="form-control" type="tel" value="<?php echo get_user_meta( $user->ID, 'phone', true ); ?>" id="tel-input">
    </div>
  </div>
  <div class="form-group row">
    <label for="password-input" class="col-xs-4 col-form-label">Change Password</label>
    <div class="col-xs-8">
      <input name="password" class="form-control" type="password" value="" id="password-input">
    </div>
  </div>
  <div class="form-group row">
    <label for="password-confirm-input" class="col-xs-4 col-form-label">Password Confirmation</label>
    <div class="col-xs-8">
      <input name="password_confirm" class="form-control" type="password" value="" id="password-confirm-input">
    </div>
  </div>
  <fieldset class="form-group">
    <legend>Email Preferences</legend>
    <div class="radio">
      <label>
        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
        Option one is this and that&mdash;be sure to include why it's great
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
        Option two can be something else and selecting it will deselect option one
      </label>
    </div>
  </fieldset>
  <div class="form-group row profile-submit">
    <button type="submit" class="m-x-auto btn btn-primary">Update</button>
    <div id="feedback"></div>
  </div>
</form>
