
<div id="logiModal" class="modal fade" role="dialog" style="overflow-x: hidden;overflow-y: auto;">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body" style="padding: 0rem;">
        <div class="row"> 
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form" style="max-width: 300px; margin: 0px auto;padding:20px 0px 5px 0px;">
               <span style="font-size: 19px;font-weight: bold;">MAKE MY NOTICE</span>
               <span style="font-size: 17px;display: block;margin-top: 10px;margin-bottom: 10px;">Welcome Back, Please Login to your account</span>
               <br />
               <center>
                <div class="alert alert-danger text-center error-msg" style="display: none;"></div>
                <div class="text-center loader" style="display: none;">
                  <h3>
                     Loading...
                  </h3>
                </div>
                
               </center>
                <form>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" id="loginEmail">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" id="loginPass">
                  </div>
                  <input type="button" id="loginUser" name="" value="Login" class="btn btn-primary">
                  <a href="#" style="text-decoration: none"><span id="newSignUp" style="font-size: 11px;font-weight: bold;">New Here ? Sign Up</span></a>
                </form>
                </div>
            </div>

             <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs desktopVisible" style="background: #2f516c;padding-left:0px;">
                <img src="../../public/assets/img/modal_rt.png" class="desktopVisible img-responsive" style="width: 100%;">
                <button type="button" class="close" data-dismiss="modal" style="position:absolute; top: 20px; right: 20px;color: white;font">X</button>
               
            </div>
        </div>
      </div>
    </div>
  </div>
</div>