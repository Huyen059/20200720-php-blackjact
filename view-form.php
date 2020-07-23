<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/** @var Blackjack $game */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Black Jack</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1 class="text-center mb-5 mt-2">Blackjack Game</h1>
<section class="stats d-flex justify-content-center align-items-start">
    <section id="player" class="mr-5 ">
        <h2>Player</h2>
        <div class="cards">
            <?php
            foreach ($game->getPlayer()->getCards() as $card) {
                echo $card->getUnicodeCharacter(true);
            }
            ?>
        </div>
        <p class="score">Score: <?php echo $game->getPlayer()->getScore() ?></p>
    </section>
    <section id="dealer" class="cards">
        <h2>Dealer</h2>
        <div class="cards">
            <?php echo $game->getDealer()->getCards()[0]->getUnicodeCharacter(true);?>
        </div>
        <p> </p>
    </section>
</section>

<?php
$displayScores = "<p>Dealer score: {$game->getDealer()->getScore()}</p><p>Player score: {$game->getPlayer()->getScore()}</p>";
$link = "<a href={$_SERVER['PHP_SELF']} class='text-white btn btn-secondary'>Play again</a>";

if($game->getDealer()->hasLost()){
    echo '<div class="text-center alert alert-success" role="alert">
    <p><strong>Well done!</strong> You successfully destroyed the dealer</p>'.$displayScores.$link.'</div>';
}

if($game->getPlayer()->hasLost()){
    echo '<div class="text-center alert alert-danger" role="alert">
    <p><strong>NOOO!</strong> You Lost :(</p>'.$displayScores.$link.'</div>';
}
?>

<form class="text-center mt-3" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <label><input type="radio" name="<?=CHOICE; ?>" value="<?=HIT; ?>" id="hit">Hit</label>
    <label><input type="radio" name="<?=CHOICE; ?>" value="<?=STAND; ?>" id="stand">Stand</label>
    <label><input type="radio" name="<?=CHOICE; ?>" value="<?=SURRENDER; ?>" id="surrender">Surrender</label>
    <button class="btn btn-info" type="submit" name="submit">Submit</button>
</form>
</body>
</html>
