<div class="login-container-overlay login">
  <div class="login-container">
    <div class="login-form">
      <i class="fa fa-times material-icons" id="close-overlay">cancel</i>
      <h1>Anmelden</h1>

      <div class="login-form-processing">
        <div class="progress">
          <div class="indeterminate"></div>
        </div>
      </div>
       
      <div class="login-form-content">
        <p class="state-message" id="state-login"></p>
        <form id="login-form" action="" method='post' class="col s12">
          <div class="row">            
            <div class="row">
              <div class="input-field col s12">
                <input name="email" id="email" type="email" class="validate login-input" required>
                <label for="email">E-Mail</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input name="password" id="password" type="password" class="validate login-input" required>
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="submit-container">
              <button class="btn waves-effect waves-light" type="submit" value="Submit" name="action" id="login-submit">Login
                <i class="material-icons right">send</i>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="register-link col s12">
              <a href="register">Noch kein Account? - <u>Registrieren</u></a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>