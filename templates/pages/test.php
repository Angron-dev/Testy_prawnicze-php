<?php 
    $page ='';
    switch ($params['type']) {
        case 'kk':
            $page = 'Kodeks karny';
            break;
        case 'kc':
            $page = 'Kodeks cywilny';
            break;
        case 'kpk':
            $page = 'Kodeks postępowania karnego';
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
    $points = $params['points'];
?>
<?php include_once ('pageHeader.php'); ?>
<hr class="border-danger border-3 opacity-75">
<div class="container">
    <?php if (!$params['getQuestion']): ?>
    <h1 class="text-center text-secondary"><?php echo $page ?></h1>
        <?php  if (!empty($points)): 
        $pointsScored = $points['pointsScored'];
        $limit = $points['limit'];

    ?>
        <p class="text-center mt-5 fs-3">Liczba punktów</p>
        <p class="text-center fs-1"><?php echo  $pointsScored .' / '. $limit?> </p>
    <?php endif ?>
    <form method="POST" action="?page=test&type=<?php echo $params['type'] ?>&action=startTest">
        <p class="fs-5 text-center mt-5">Wybierz ilość pytań</p>
        <select name="limit"  class="mx-auto d-block form-select" style="width: 10%;">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="70">70</option>
        </select>
        <button type="submit" class="btn btn-danger btn-lg d-block mx-auto my-3">Rozpocznij</button>
    </form>
    <?php endif ?> 

    <form action="?page=test&type=<?php echo $params['type'] ?>&action=check" method="POST" class="mt-5">
        <ol>

            <?php foreach ($params['getQuestion'] as $key => $param): $answers = $param['answers']?>
                <li><p><?php echo $param['question']; ?></p></li>

                <?php foreach ($answers as $answer) :?>
                    <input type="hidden" name="<?php echo $key?>[correct]" value='<?php echo $param['correct_answer'] ?>'>
                    <label><input type="radio" name="<?php echo $key?>[choosen]" value="<?php echo $answer?>" class="mx-2"><?php echo $answer?></label><br>
                <?php endforeach; ?>

                <hr class="border-danger border-3 opacity-50">
            <?php endforeach ?>
        </ol>
        <?php echo ($params['getQuestion']) ? "<button class='btn btn-lg d-block mx-auto my-5 btn-danger '>Sprawdź</button>" : ""?> 
    </form>
</div>