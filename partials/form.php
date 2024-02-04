<form action="register.php" method="post" enctype="multipart/form-data" class=" bg-white py-3 px-4 shadow-lg rounded zid mt-1">
    <!-- 2 column grid layout with text inputs for the first and last names -->
    <?php
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo "<p class='text-danger text-center py-1 border border-danger' onclick='this.remove()'>$value </p>";
        }
    }
    ?>
    <div class="row mb-4">
        <div class="col">
            <div data-mdb-input-init class="form-outline">
                <input type="text" id="form3Example1" class="form-control" name="name" />
                <label class="form-label" for="form3Example1"> Name</label>
            </div>
        </div>

    </div>

    <!-- Email input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="form3Example3" class="form-control" name="email" />
        <label class="form-label" for="form3Example3">Email address</label>
    </div>

    <!-- Password input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="password" id="form3Example4" class="form-control" name="password" />
        <label class="form-label" for="form3Example4">Password</label>
    </div>
    <!-- phone input  -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="number" id="form3Example4" class="form-control" name="phone" />
        <label class="form-label" for="form3Example4">Phone</label>
    </div>
    <!-- photo input  -->
    <div data-mdb-input-init class=" mb-4">
        <!-- <h2 class="form-control">Upload photo</h2> -->
        <label class="form-label " for="files">Upload Photo</label>
        <input type="file" id="files" class="form-control" name="photo" />

    </div>

    <!-- address input  -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" id="form3Example4" class="form-control" name="address" />
        <label class="form-label" for="form3Example4">Address</label>
    </div>

    <!-- Submit button -->
    <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

    <!-- Register buttons -->
    <div class="text-center">
        <p>or sign up with:</p>
        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
            <i class="fab fa-facebook-f"></i>
        </button>

        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
            <i class="fab fa-google"></i>
        </button>

        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
            <i class="fab fa-twitter"></i>
        </button>

        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
            <i class="fab fa-github"></i>
        </button>
    </div>
</form>