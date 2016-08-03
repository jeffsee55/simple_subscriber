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
  <div class="form-group row">
    <label for="email-preference-radio" class="col-xs-4 col-form-label">Email Preferences</label>
    <?php
    $option = get_user_meta( $user->ID, 'email_alerts', true );
    if( ! is_null( $option ) ) {
      $option = $option;
    } else {
      $option = '1';
    }
    ?>
    <div class="col-xs-8">
      <div class="radio">
        <label>
          <input type="radio" name="email_alerts" id="optionsRadios1" value="1"
            <?php echo ( ( $option === '1' ) ? 'checked' : '' ); ?> >
          I would like receive newsletter emails.
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="email_alerts" id="optionsRadios2" value="0"
            <?php echo ( ( $option === '0' ) ? 'checked' : '' ); ?> >
          I would not like receive newsletter emails.
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row profile-submit">
    <button type="submit" class="m-x-auto btn btn-primary">Update</button>
    <div id="feedback"></div>
  </div>
</form>
