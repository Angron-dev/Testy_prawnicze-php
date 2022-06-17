<?php  
    $message = $params['msg'] ;

    switch ($message) {
        case 'passwordError':
            $msg = 'Podane hasło różni się';
            break;
        case 'emailError':
            $msg = 'Podany email jest już w użyciu';
            break;
        case 'passwordLength':
            $msg = 'Hasło powinno zawierać co najmniej 6 znaków';
            break;
        default:
            $msg = '';
            break;
    }
?>
<div class="container login-form " >
    <div class="container">
        <h1 class="text-center mb-4 ">Testy prawnicze</h1>
        <p class="text-center text-danger fs-5"><?php echo $msg ?></p>
        <form method="post" action="?page=register" >
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="user_name" placeholder="user_name">
                <label for="floatingInput">Nazwa użytkownika</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                <label for="floatingPassword">Hasło</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="password-repeat" placeholder="Password">
                <label for="floatingPassword">Powtórz hasło</label>
            </div>
            <div class="container ">
            <button type="submit" name="registerBtn" class="btn btn-primary mx-auto d-block mb-3">Zarejestruj</button>
        </form>
            <p class="text-center">Posiadasz już konto? <a href="/?page=login">Zaloguj się</a></p>
        </div>
    </div>
</div>