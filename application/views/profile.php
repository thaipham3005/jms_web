  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Main content -->
      <div class=" profile">

          <div class="row">
              <div class="col-md-12 col-xs-12">

                  <div class="box">
                      <div class="box-header">
                          <h3 class="box-title">User Profile</h3>
                      </div>
                      <form role="form" action="<?php base_url('users/profile') ?>" method="post"
                          enctype="multipart/form-data">
                          <div class="box-body">
                              <div class="row">
                                  <div class="row col-xl-4 col-lg-4 col-12">
                                      <div class="col-md-12">

                                          <div class="file-field">
                                              <div class="z-depth-1-half mb-4 profile-upload-pic">
                                                  <img src="" class="img-responsive" id="profile-upload-pic"
                                                      alt="Your profile picture">
                                              </div>
                                              <div class="input-group form-group">
                                                  <label class="input-group-btn">
                                                      <span class="btn btn-primary">
                                                          <i class="fa fa-folder-open"></i><span>Choose File</span>
                                                          <input type="file" id="img-file" name="img-file"
                                                              style="display: none; "
                                                              accept="image/png, image/jpeg, image/gif">
                                                      </span>
                                                  </label>
                                                  <input type="text" class="form-control" id="img-name"
                                                      placeholder="Select the Image File" readonly>
                                              </div>
                                          </div>

                                      </div>

                                  </div>
                                  <div class="row col-xl-8 col-lg-8 col-12">
                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="groups">Groups</label>
                                          <select class="form-control" id="groups" name="groups">
                                              <option value="" disabled>Select Groups</option>

                                          </select>
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="active">Active</label>
                                          <select class="form-control" id="active" name="active">
                                              <option value="">Active</option>
                                              <option value="">Inactive</option>
                                          </select>
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="login_id">Username</label>
                                          <input type="text" class="form-control" id="login_id" name="login_id" value=""
                                              placeholder="Username" autocomplete="off">
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="fullname">Full name</label>
                                          <input type="text" class="form-control" id="fullname" name="fullname" value=""
                                              placeholder="Full name" autocomplete="off">
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="email">Email</label>
                                          <input type="email" class="form-control" id="email" name="email"
                                              placeholder="Email" value="" autocomplete="off">
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="phone">Phone No</label>
                                          <input type="text" class="form-control" id="phone" name="phone"
                                              placeholder="Phone" value="" autocomplete="off">
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="birthday">Birthday</label>
                                          <input type="date" class="form-control" id="birthday" name="birthday" value=""
                                              placeholder="dd/MM/yyyy" autocomplete="off">
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="gender">Gender</label>
                                          <select class="form-control" id="gender" name="gender">
                                              <option value="Male">Male</option>
                                              <option value="Female">Female</option>
                                          </select>
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="department">Department</label>
                                          <input type="text" class="form-control" id="department" name="department"
                                              value="" placeholder="Department" autocomplete="off">
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="position">Position</label>
                                          <input type="text" class="form-control" id="position" name="position"
                                              placeholder="Position" value="" autocomplete="off">
                                      </div>

                                      <div class="form-group col-md-12">
                                          <label for="address">Address</label>
                                          <input type="text" class="form-control" id="address" name="address"
                                              placeholder="Address" value="" autocomplete="off">
                                      </div>

                                      <div class="form-group col-md-12">
                                          <div class="alert alert-info alert-dismissible" role="alert">
                                              <button type="button" class="close" data-dismiss="alert"
                                                  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              Leave the password field empty if you don't want to change.
                                          </div>
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="password">Password</label>
                                          <input type="password" class="form-control" id="password" name="password"
                                              placeholder="Password" autocomplete="off">
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-6 col-12">
                                          <label for="cpassword">Confirm password</label>
                                          <input type="password" class="form-control" id="cpassword" name="cpassword"
                                              placeholder="Confirm Password" autocomplete="off">
                                      </div>
                                  </div>
                              </div>

                              <!-- /.col-md-8 -->



                          </div>
                          <!-- /.box-body -->

                          <div class="box-footer">
                              <button type="submit" class="btn btn-primary">Save Changes</button>
                              <a href="<?php echo base_url('profile')?>" class="btn btn-warning">Back</a>
                          </div>
                      </form>
                  </div>
                  <!-- /.box -->
              </div>
              <!-- col-md-12 -->
          </div>

          <!-- col-md-12 -->
      </div>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
$(document).ready(function() {

});
  </script>