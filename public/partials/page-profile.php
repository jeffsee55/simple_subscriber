<?php

while (have_posts()) : the_post();
  get_template_part('templates/page', 'header');
  get_template_part('templates/content', 'page');
endwhile; ?>

<div class="entry-content">
  <div class="form-group row">
    <label for="example-email-input" class="col-xs-2 col-form-label">Email</label>
    <div class="col-xs-10">
      <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
    </div>
  </div>
  <div class="form-group row">
    <label for="example-tel-input" class="col-xs-2 col-form-label">Telephone</label>
    <div class="col-xs-10">
      <input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input">
    </div>
  </div>
  <div class="form-group row">
    <label for="example-password-input" class="col-xs-2 col-form-label">Password</label>
    <div class="col-xs-10">
      <input class="form-control" type="password" value="hunter2" id="example-password-input">
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
  <div class="form-group row">
    <button type="submit" class="m-x-auto btn btn-primary">Update</button>
  </div>
</div>
