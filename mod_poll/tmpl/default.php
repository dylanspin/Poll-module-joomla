<?php
    //params
    $idVraag = $params->get('idvraag');
    $vraag = $params->get('vraag');
    $antwoord1 = $params->get('antwoord1');
    $antwoord2 = $params->get('antwoord2');
    $antwoord3 = $params->get('antwoord3');
    $antwoord4 = $params->get('antwoord4');
    $achtergrond = $params->get('module_kleur');
    $textKleur = $params->get('text_kleur');

    $helper = new ModPoll();//helper class

    if(!$helper->select($idVraag)){//maakt een nieuwe row aan in de database mocht de aangeven nummer nog niet bestaan
        $helper->insert($vraag,$idVraag);
    }

    $data = $helper->select($idVraag);
    $doc = JFactory::getDocument();
    $modulePath = JURI::base() . 'modules/mod_poll/';
    $doc->addStyleSheet($modulePath.'css/style.css');
    $doc->addScript($modulePath.'js/javascript.js');

    $css = ".PollVraag{
              background-color:".$achtergrond.";
              color: ".$textKleur.";
            }";//add extra css

    $doc->addStyleDeclaration($css);//add de css aan style.css

    $antwoorden = ["",$antwoord1,$antwoord2,$antwoord3,$antwoord4];

    $gemidelde = $data->antwoord1 + $data->antwoord2 + $data->antwoord3 + $data->antwoord4;
    $procent = 100/$gemidelde;
    $procenten = [$procent * $data->antwoord1,$procent * $data->antwoord2,$procent * $data->antwoord3,$procent * $data->antwoord4];
    $procenten = ["",round($procenten[0],2),round($procenten[1],2),round($procenten[2],2),round($procenten[3],2)];//de gemidelde procenten

    if(isset($_POST['pollAntwoord'])){//als button is aangeklikt
        if(!$_SESSION['voted'] && empty($_POST['valuePoll'])){//checkt voor session en als de anti spam bot input leeg is
            $stats = [" ",$data->antwoord1,$data->antwoord2,$data->antwoord3,$data->antwoord4];//pakt de score van alle 4 antwoorden
            $stats[$_POST['pollAntwoord']] += 1;//doet een bij de oude aantal score
            $helper->update($idVraag,$stats[$_POST['pollAntwoord']],"antwoord".$_POST['pollAntwoord']);//updates de values
            $_SESSION['voted'] = true;//set session
            $helper->refresh();//refresht
        }
    }
?>


  <form class="poll" method="post">
    <div class="PollVraag">
      <div class="VraagInner">
        <?php echo $vraag; ?>
      </div>
    </div>
    <div class="closePoll" onclick="openPoll()" id='icon'><i class="fa fa-minus" aria-hidden="true"></i></div>
    <div class="innerPoll" id='innerPoll'>
      <?php
          if(isset($_SESSION['voted'])){
              for($i=1; $i<=4; $i++){//mischien een message van bedankt voor het stemmen
                  echo "<div class='procent'><div class='overlay' style='width:$procenten[$i]%;'></div>".$procenten[$i]."%</div>";
              }
          }
          else{
              for($i=1; $i<=4; $i++){
                  echo "<button name='pollAntwoord' class='pollAntwoorden' value='$i'>$antwoorden[$i]</button>";
              }
          }
       ?>
     </div>
     <input type="text" value="" name='valuePoll' class="pollFake" id='pollfake'>
  </form>
