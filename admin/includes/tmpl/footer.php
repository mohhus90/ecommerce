
        <div class="footer">
           
        </div>
        <script src="layout/js/jquery-3.7.0.min.js"></script>
        <script src="layout/js/bootstrap.min.js"></script> 
        <!-- <script src="layout/js/bootstrap.js"></script> -->
        <script src="layout/js/bootstrap.bundle.min.js"></script>
        
        <script>
            const togglePassword = document.querySelector('.togglePassword');
            const password = document.querySelector('#pass_log_id');

            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                // this.classList.toggle('fa-eye-slash');
                if (!this.classList.contains('tog')){
                    this.classList.remove('fa-eye-slash');
                    this.className +=' tog fa-eye';
                }
                else if( this.classList.contains('tog') ){
                    this.className +=' fa-solid fa-eye-slash';
                    this.classList.remove('fa-eye');
                    this.classList.remove('tog');
                }
            });
        </script>
        <script src="layout/js/backend.js"></script>
    </body>
</html>