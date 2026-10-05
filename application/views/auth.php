<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
?>
<style>
  header {
    background: var(--paper);
    border-bottom: 1px solid var(--line);
    padding: 18px 32px;
  }

  .nav-header {
    max-width: 1180px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .logo {
    font-family: 'Manrope', sans-serif;
    font-weight: 600;
    font-size: 21px;
  }

  .logo em {
    font-style: italic;
    color: var(--primary-red);
    font-weight: 500;
  }

  .back-home {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text-soft);
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .back-home:hover {
    color: var(--primary-red);
  }

  /* ---------- MAIN AUTH CONTAINER ---------- */
  .auth-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
  }

  .auth-card {
    background: var(--card);
    border: 1px solid var(--line);
    border-top: 3px solid var(--primary-red);
    width: 100%;
    max-width: 460px;
    padding: 40px;
    box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.04);
    position: relative;
    overflow: hidden;
  }

  .auth-head {
    text-align: center;
    margin-bottom: 24px;
  }

  .auth-head h2 {
    font-size: 28px;
    margin-bottom: 8px;
  }

  .auth-head p {
    font-size: 14px;
    color: var(--text-soft);
  }

  .auth-toggle-link {
    color: var(--primary-red);
    font-weight: 700;
    cursor: pointer;
  }

  .auth-toggle-link:hover {
    color: var(--primary-red-deep);
    text-decoration: underline;
  }

  /* ALERT MESSAGE MESSAGES */
  .auth-alert {
    background: #fff1f2;
    border: 1px solid #ffe4e6;
    color: #b91c1c;
    padding: 12px 16px;
    font-size: 13.5px;
    font-weight: 600;
    margin-bottom: 24px;
    border-radius: var(--radius);
    text-align: center;
  }

  /* ---------- FORM ELEMENTS ---------- */
  .form-group {
    margin-bottom: 20px;
    position: relative;
  }

  .form-group label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 7px;
    color: var(--text);
  }

  .input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
  }

  .input-wrapper i {
    position: absolute;
    left: 14px;
    color: var(--mist);
    font-size: 14px;
    pointer-events: none;
  }

  .input-wrapper input {
    width: 100%;
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 12px 14px 12px 40px;
    font-family: 'Manrope', sans-serif;
    font-size: 14px;
    color: var(--text);
    background: var(--card);
    transition: border-color 0.2s ease;
  }

  .input-wrapper input:focus {
    outline: none;
    border-color: var(--primary-red);
  }

  .input-wrapper input::placeholder {
    color: var(--mist);
    opacity: 0.8;
  }

  /* Form Helper (Remember/Forgot) */
  .form-helper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 13px;
    margin-bottom: 24px;
    color: var(--text-soft);
  }

  .remember-me {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
  }

  .remember-me input {
    accent-color: var(--primary-red);
    cursor: pointer;
  }

  .forgot-pass {
    font-weight: 500;
  }

  .forgot-pass:hover {
    color: var(--primary-red);
  }

  /* Action Buttons */
  .btn-submit {
    width: 100%;
    background: var(--primary-red);
    color: #ffffff;
    border: none;
    padding: 14px;
    font-weight: 700;
    font-size: 14.5px;
    border-radius: var(--radius);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.15s ease, transform 0.15s ease;
  }

  .btn-submit:hover {
    background: var(--primary-red-deep);
    transform: translateY(-1px);
  }

  .btn-submit:active {
    transform: translateY(0);
  }

  /* Term note */
  .term-text {
    font-size: 12px;
    color: var(--text-soft);
    line-height: 1.5;
    text-align: center;
    margin-top: 20px;
  }

  .term-text a {
    color: var(--text);
    text-decoration: underline;
  }

  /* ---------- TOGGLE LOGIC STYLE ---------- */
  .auth-form {
    display: none;
  }

  .auth-form.active {
    display: block;
    animation: fadeIn 0.4s ease;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @media (max-width: 480px) {
    .auth-card {
      padding: 30px 20px;
      border-left: none;
      border-right: none;
    }
  }
</style>   

<header>
  <div class="nav-header">
    <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'upload/fb/'.get_logo(); ?>" /></a></div>
    <a href="<?php echo base_url(); ?>" class="back-home"><i class="fa-solid fa-arrow-left"></i> Quay lại trang chủ</a>
  </div>
</header>

<main class="auth-container">
  <div class="auth-card">
    
    <div id="js-alert-box" class="auth-alert" style="display: <?php echo !empty($m_message) ? 'block' : 'none'; ?>;">
      <i class="fa-solid fa-circle-exclamation"></i> <span id="js-alert-text"><?php echo $m_message; ?></span>
    </div>
    
    <div id="form-login" class="auth-form active">
      <div class="auth-head">
        <h2>Đăng nhập</h2>
      </div>

      <form name="frm_login" method="POST" action="<?php echo base_url(); ?>index.php/auth" onsubmit="return validateLogin();">
        <div class="form-group">
          <label for="login-username">Tài khoản</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-user"></i>
            <input type="text" id="login-username" name="txt_username" value="<?php echo $txt_username; ?>" placeholder="Tên đăng nhập hoặc email">
          </div>
        </div>

        <div class="form-group">
          <label for="login-password">Mật khẩu</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="login-password" name="txt_password" placeholder="••••••••">
          </div>
        </div>

		<?php /*
        <div class="form-helper">
          <label class="remember-me">
            <input type="checkbox" name="chk_remember" value="1">
            <span>Ghi nhớ đăng nhập</span>
          </label>
          <a href="#" class="forgot-pass">Quên mật khẩu?</a>
        </div>
		*/ ?>
		
        <button type="submit" class="btn-submit">
          Đăng Nhập <i class="fa-solid fa-right-to-bracket"></i>
        </button>
        
        <input type="hidden" name="hidden_action" value="login">
      </form>
    </div>

  </div>
</main>

<script>
  const alertBox = document.getElementById('js-alert-box');
  const alertText = document.getElementById('js-alert-text');

  function showAlert(msg) {
    alertText.textContent = msg;
    alertBox.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  function hideAlert() {
    alertBox.style.display = 'none';
  }

  // 1. KIỂM TRA ĐĂNG NHẬP
  function validateLogin() {
    hideAlert();
    const user = document.getElementById('login-username').value.trim();
    const pass = document.getElementById('login-password').value;

    if (user === '') {
      showAlert('Vui lòng nhập Tên đăng nhập hoặc địa chỉ Email!');
      return false;
    }
    if (pass === '') {
      showAlert('Vui lòng nhập mật khẩu tài khoản!');
      return false;
    }
    return true;
  }

</script>

<?php 
	$this->load->view('footer');
?>