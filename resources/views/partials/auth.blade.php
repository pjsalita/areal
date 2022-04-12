<!-- Markup for Sign in / Sign up -->
<section class="sign-in">
    <div class="modal" data-role="sign-in">
        <div class="title">
            <div class="close" data-role="close-login-modal">
                <img src="{{ asset("assets/images/close-white.png") }}" alt="Close Icon">
            </div>
        </div>

        <section class="forms-section">
            <div class="forms">
                <div class="form-wrapper is-active">
                    <button type="button" class="switcher switcher-login">
                        LOGIN
                        <span class="underline"></span>
                    </button>
                    <form class="form form-login" onsubmit="return login(event)">
                        <div>
                            <fieldset>
                                <legend>Please, enter your email and password for login.</legend>
                                <div class="input-block">
                                    <label for="login-email">EMAIL</label>
                                    <input id="login-email" name="email" type="email" required>
                                </div>
                                <div class="input-block">
                                    <label for="login-password">PASSWORD</label>
                                    <input id="login-password" name="password" type="password" required>
                                </div>
                                <div class="input-block text-center">
                                    <label id="login-error" class="text-danger"></label>
                                </div>
                            </fieldset>
                            <button type="submit" class="action primary btn-login">LOGIN</button>
                        </div>
                    </form>
                </div>

                <div class="form-wrapper">
                    <button type="button" class="switcher switcher-signup">
                        SIGN UP
                        <span class="underline"></span>
                    </button>
                    <form class="form form-signup" onsubmit="return register(event)">
                        <fieldset>
                            <legend>Please, enter your first name, last name, mobile, birthday, gender, account
                                type, email, password and password confirmation for sign up.
                            </legend>
                            <div class="row">
                                <div class="column -first">
                                    <div class="input-block">
                                        <label for="signup-first-name">FIRST NAME</label>
                                        <input id="signup-first-name" name="first_name" type="text" required>
                                    </div>
                                    <div class="input-block">
                                        <label for="signup-birthday">BIRTHDAY</label>
                                        <input id="signup-birthday" name="birthdate" type="date" required>
                                    </div>
                                    <div class="input-block">
                                        <label for="signup-email">EMAIL</label>
                                        <input id="signup-email" name="email" type="email" required>
                                    </div>
                                    <div class="input-block">
                                        <label for="signup-password">PASSWORD</label>
                                        <input id="signup-password" name="password" type="password" required>
                                    </div>
                                    <div class="input-block">
                                        <label for="signup-type">ACCOUNT TYPE</label>
                                        <select id="signup-type" name="account_type">
                                            <option value="" disabled selected>SELECT ACCOUNT TYPE</option>
                                            <option value="client">CLIENT</option>
                                            <option value="architect">ARCHITECT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="column -second">
                                    <div class="input-block">
                                        <label for="signup-last-name">LAST NAME</label>
                                        <input id="signup-last-name" name="last_name" type="text" required>
                                    </div>
                                    <div class="input-block">
                                        <label for="signup-gender">GENDER</label>
                                        <select id="signup-gender" name="gender" placeholder="SELECT GENDER">
                                            <option value="" disabled selected>SELECT GENDER</option>
                                            <option value="male">MALE</option>
                                            <option value="female">FEMALE</option>
                                        </select>
                                    </div>
                                    <div class="input-block">
                                        <label for="signup-number">PHONE NUMBER</label>
                                        <input id="signup-number" name="phone_number" type="text" required>
                                    </div>
                                    <div class="input-block">
                                        <label for="signup-password-confirm">CONFIRM PASSWORD</label>
                                        <input id="signup-password-confirm" name="password_confirmation" type="password" required>
                                    </div>
                                    <div class="input-block">
                                        <label for="signup-position">POSITION</label>
                                        <input id="signup-position" name="position" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="input-block text-center">
                                <label id="register-error" class="text-danger"></label>
                            </div>
                        </fieldset>
                        <button type="submit" class="action secondary">SIGN UP</button>
                    </form>
                </div>
            </div>
        </section>
        <div class="modal-overlay" data-role="modal-overlay"></div>
    </div>
</section>

@push('scripts')
    @guest
        <script>
            async function login(e) {
                e.preventDefault();
                const formData = new FormData(e.target);
                const formValues = Object.fromEntries(formData);
                const loginError = document.getElementById("login-error");

                try {
                    loginError.innerText = "";
                    const { data } = await axios.post("/login", formValues);

                    if (data.success) {
                        window.location.href = "/dashboard";
                    }
                } catch (error) {
                    const errorData = error?.response?.data;
                    const errorMessage = errorData?.errors ? Object.values(errorData?.errors).flat().join('\n') : error?.response?.data?.message || error.message;
                    loginError.innerText = errorMessage;
                }
            }

            async function register(e) {
                e.preventDefault();
                const formData = new FormData(e.target);
                const formValues = Object.fromEntries(formData);
                const registerError = document.getElementById("register-error");

                try {
                    registerError.innerText = "";
                    const { data } = await axios.post("/register", formValues);

                    if (data.success) {
                        window.location.href = "/dashboard";
                    }
                } catch (error) {
                    const errorData = error?.response?.data;
                    const errorMessage = errorData?.errors ? Object.values(errorData?.errors).flat().join('\n') : error?.response?.data?.message || error.message;
                    registerError.innerText = errorMessage;
                }
            }
        </script>
    @endguest
@endpush
