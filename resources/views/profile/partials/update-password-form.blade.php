<section class=" mt-2">
    <header class="mb-2">
        <h2 class="h4 fw-bold text-dark">Update Password</h2>
        <p class="text-muted large">Ensure your account is using a long, random password to stay secure.</p>
    </header>
    @include('layouts.messages')

    <form method="post" action="{{ route('password.update') }}" class="needs-validation" novalidate>
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="mb-2">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
            <div class="invalid-feedback">Please enter your current password.</div>
        </div>

        <!-- New Password -->
        <div class="mb-2">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="invalid-feedback">Please enter a new password.</div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-2">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            <div class="invalid-feedback">Please confirm your new password.</div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary ms-5 my-2 text-center">Save</button>

            @if (session('status') === 'password-updated')
                <p id="savedMessage" class="text-success small">Saved Successfully...</p>
            @endif
        </div>
    </form>
</section>

<script>
    // Bootstrap Form Validation
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    // Auto-hide the "Saved" message after 2 seconds
    setTimeout(() => {
        let msg = document.getElementById("savedMessage");
        if (msg) msg.style.display = "none";
    }, 4000);
</script>
