<?php 
  $msg = $params['msg'] ;
    switch ($msg) {
        case 'emailError':
            $message = 'Wpisz email';
            break;
        case 'passwordError':
            $message = 'Wpisz hasło';
            break;
        case 'loginError':
            $message = 'Błędny email lub hasło';
            break;
        case 'success':
            $message = 'Udało się zarejestrować';
            $success = true;
            break;
        default:
            $message = '';
            break;
    }
?>

<div class="container login-form " >
    <form method="POST" class="container">
        <h1 class="text-center mb-4 ">Testy prawnicze</h1>
        <p class="<?php echo $success ? 'text-success': 'text-danger' ?> text-center fs-5"> <?php echo  $message ?> </p>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" value="<?php ?>">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="container d-flex justify-content-center mt-3">
            <button type="submit" name="loginBtn" class="btn btn-primary mx-2">Zaloguj się</button>
            <a href="/?page=register" class="btn btn-secondary mx-2">Zarejestruj się</a>
        </div>
    </form>
</div>