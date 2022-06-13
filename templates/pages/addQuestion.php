<<<<<<< HEAD
<?php 
    $page = '';
    switch ($params['type']) {
        case 'kk':
            $page = 'Kodeks karny';
            break;
        case 'kpk':
            $page = 'Kodeks postępowania karnego';
            break;
        case 'kc':
            $page = 'Kodeks cywilny';
            break;
        case 'kpc':
            $page = 'Kodeks postępowania cywilnego';
            break;
        case 'kro':
            $page = 'Kodeks rodzinny i opiekuńczy';
            break;
        case 'kpa':
            $page = 'Kodeks postępowania administracyjnego';
            break;
        default:
            $page = '';
            break;
    }

    $message = '';
    $class = '';

    switch ($params['msg']) {
        case 'success':
            $message = 'Pytanie zostało dodane';
            $class = "text-success";
            break;
        case 'successEdit':
            $message = 'Pytanie zostało zedytowane';
            $class = "text-success";
            break;
        case 'error':
            $message = 'Wszystkie pola tekstowe muszą być uzupełnione';
            $class = "text-danger";
            break;
        case 'errorEdit':
            $message = 'Nie udało się zmodyfikować notatki';
            $class = "text-danger";
            break;
        case 'delete':
            $message = 'Pytanie zostało usunięte';
            $class = "text-danger";
            break;
    }

     $getQuestion = $params['getQuestion'];
?>
<div class="container mt-5">
    <h1 class="text-center text-secondary"><?php echo $page ?></h1>
    <form class="form-floating my-5 mx-auto" method="post" action="/?page=add&type=<?php echo $params['type']?>&action=<?php echo ($getQuestion) ? 'edited' : 'create' ?>" style="max-width: 40rem;">
        <p class="mb-3 text-center fs-3 <?php echo $class ?>"><?php echo $message?> </p>
        <input type="hidden" name="id" value="<?php echo ($getQuestion) ? $getQuestion['id'] : ""?>">
        <div class="form-floating mb-3">
            <input type="text" name="question" class="form-control" id="questionInput" placeholder="Podaj pytanie" value="<?php echo ($getQuestion) ? $getQuestion['question'] : ""  ?>">
            <label for="questionInput">Pytanie</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="correct_answer" class="form-control" id="correctAnswer" placeholder="Poprawna odpowiedź" value="<?php echo ($getQuestion) ? $getQuestion['correct_answer'] : ""  ?>">
            <label for="correctAnswer">Poprawna odpowiedź</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="answer_1" class="form-control" id="answer1" placeholder="Odpowiedź 1" value="<?php echo ($getQuestion) ? $getQuestion['answer_1'] : ""  ?>">
            <label for="answer1">Odpowiedź 1</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="answer_2" class="form-control" id="answer2" placeholder="Odpowiedź 2" value="<?php echo ($getQuestion) ? $getQuestion['answer_2'] : ""  ?>">
            <label for="answer2">Odpowiedź 2</label>
        </div>
        <button type="submit" class="btn btn-primary btn-lg d-block mx-auto"><?php echo ($getQuestion) ?'Edytuj pytanie' : 'Dodaj pytanie'?></button>
    </form>
</div>
<div class="container mt-5 pb-5">
<table class="table align-middle">
  <thead>
    <tr class="container table-dark">
      <th scope="col" class="col-1 text-center">#</th>
      <th scope="col" class="col">Pytanie</th>
      <th scope="col" class="col-2">Odpowiedź 1</th>
      <th scope="col" class="col-2">Odpowiedź 2</th>
      <th scope="col" class="col-2">Poprawna odpowiedź</th>
      <th scope="col" class="col-1"></th>
      <th scope="col" class="col-1"></th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($params['get'] as $param):?> 
        <tr class="py-2">
            <td class="fw-bold text-center"></td>
            <td><?php echo $param['question'] ?></td>
            <td class="table-danger"><?php echo $param['answer_1'] ?></td>
            <td class="table-danger"><?php echo $param['answer_2'] ?></td>
            <td class="table-success"><?php echo $param['correct_answer'] ?></td>    
            <td>    
                <form action="/?page=add&type=<?php echo $params['type']?>&action=edit" method="post">
                    <input type="hidden" name="id" value="<?php echo $param['id'] ?>" >
                    <input type="submit" value="Edytuj" class="btn btn-sm btn-success d-block mx-auto">
                </form>
            </td>
            <td>    
                <form action="/?page=add&type=<?php echo $params['type']?>&action=delete" method="post">
                    <input type="hidden" name="id" value="<?php echo $param['id'] ?>" >
                    <input type="submit" value="Usuń" class="btn btn-sm btn-danger d-block mx-auto">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
=======
<?php 
    $page = '';
    switch ($params['type']) {
        case 'kk':
            $page = 'Kodeks karny';
            break;
        case 'kpk':
            $page = 'Kodeks postępowania karnego';
            break;
        case 'kc':
            $page = 'Kodeks cywilny';
            break;
        case 'kpc':
            $page = 'Kodeks postępowania cywilnego';
            break;
        case 'kro':
            $page = 'Kodeks rodzinny i opiekuńczy';
            break;
        case 'kpa':
            $page = 'Kodeks postępowania administracyjnego';
            break;
        default:
            $page = '';
            break;
    }

    $message = '';
    $class = '';

    switch ($params['msg']) {
        case 'success':
            $message = 'Pytanie zostało dodane';
            $class = "text-success";
            break;
        case 'successEdit':
            $message = 'Pytanie zostało zedytowane';
            $class = "text-success";
            break;
        case 'error':
            $message = 'Wszystkie pola tekstowe muszą być uzupełnione';
            $class = "text-danger";
            break;
        case 'errorEdit':
            $message = 'Nie udało się zmodyfikować notatki';
            $class = "text-danger";
            break;
        case 'delete':
            $message = 'Pytanie zostało usunięte';
            $class = "text-danger";
            break;
    }

     $getQuestion = $params['getQuestion'];
?>
<hr class="border-success border-3 opacity-75">
<div class="container mt-5">
    <h1 class="text-center text-secondary"><?php echo $page ?></h1>
    <form class="form-floating my-5 mx-auto" method="post" action="/?page=add&type=<?php echo $params['type']?>&action=<?php echo ($getQuestion) ? 'edited' : 'create' ?>" style="max-width: 40rem;">
        <p class="mb-3 text-center fs-3 <?php echo $class ?>"><?php echo $message?> </p>
        <input type="hidden" name="id" value="<?php echo ($getQuestion) ? $getQuestion['id'] : ""?>">
        <div class="form-floating mb-3">
            <input type="text" name="question" class="form-control" id="questionInput" placeholder="Podaj pytanie" value="<?php echo ($getQuestion) ? $getQuestion['question'] : ""  ?>">
            <label for="questionInput">Pytanie</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="correct_answer" class="form-control" id="correctAnswer" placeholder="Poprawna odpowiedź" value="<?php echo ($getQuestion) ? $getQuestion['correct_answer'] : ""  ?>">
            <label for="correctAnswer">Poprawna odpowiedź</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="answer_1" class="form-control" id="answer1" placeholder="Odpowiedź 1" value="<?php echo ($getQuestion) ? $getQuestion['answer_1'] : ""  ?>">
            <label for="answer1">Odpowiedź 1</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="answer_2" class="form-control" id="answer2" placeholder="Odpowiedź 2" value="<?php echo ($getQuestion) ? $getQuestion['answer_2'] : ""  ?>">
            <label for="answer2">Odpowiedź 2</label>
        </div>
        <button type="submit" class="btn btn-primary btn-lg d-block mx-auto"><?php echo ($getQuestion) ?'Edytuj pytanie' : 'Dodaj pytanie'?></button>
    </form>
</div>
<div class="container mt-5 pb-5">
<table class="table align-middle">
  <thead>
    <tr class="container table-dark">
      <th scope="col" class="col-1 text-center">#</th>
      <th scope="col" class="col">Pytanie</th>
      <th scope="col" class="col-2">Odpowiedź 1</th>
      <th scope="col" class="col-2">Odpowiedź 2</th>
      <th scope="col" class="col-2">Poprawna odpowiedź</th>
      <th scope="col" class="col-1"></th>
      <th scope="col" class="col-1"></th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($params['get'] as $param):?> 
        <tr class="py-2">
            <td class="fw-bold text-center"></td>
            <td><?php echo $param['question'] ?></td>
            <td class="table-danger"><?php echo $param['answer_1'] ?></td>
            <td class="table-danger"><?php echo $param['answer_2'] ?></td>
            <td class="table-success"><?php echo $param['correct_answer'] ?></td>    
            <td>    
                <form action="/?page=add&type=<?php echo $params['type']?>&action=edit" method="post">
                    <input type="hidden" name="id" value="<?php echo $param['id'] ?>" >
                    <input type="submit" value="Edytuj" class="btn btn-sm btn-success d-block mx-auto">
                </form>
            </td>
            <td>    
                <form action="/?page=add&type=<?php echo $params['type']?>&action=delete" method="post">
                    <input type="hidden" name="id" value="<?php echo $param['id'] ?>" >
                    <input type="submit" value="Usuń" class="btn btn-sm btn-danger d-block mx-auto">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
>>>>>>> a1b8dcf (Możliwość dodawania, usuwania i przeglądania pytań oraz możliwość rozwiązywania testów.)
</div>