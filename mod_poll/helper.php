
<?php

class ModPoll {

  public function select($id){

      $db = JFactory::getDbo();
      $query = $db->getQuery(true);
      $query->select('*');
      $query->from($db->quoteName('#__pollAntwoorden'));
      $query->where($db->quoteName('id')." = ".$db->quote($id));

      $db->setQuery($query);
      $result = $db->loadRow();

      if ($result) {
          return new mod_pollData($result[0],$result[1],$result[2],$result[3],$result[4],$result[5]);
      } else {
        return false;
      }
  }

  public function update($id, $value,$edit){

      $db = JFactory::getDbo();

      $query = $db->getQuery(true);

      $fields = array(
          $db->quoteName($edit) . ' = ' . $db->quote($value),
          $db->quoteName('id') . ' = ' . $id
      );

      $conditions = array(
          $db->quoteName('id') . ' = ' . $id
      );

      $query->update($db->quoteName('#__pollAntwoorden'))->set($fields)->where($conditions);

      $db->setQuery($query);

      $result = $db->execute();
  }

  function insert($vraag,$id){
    $db = JFactory::getDbo();

    // Create a new query object.
    $query = $db->getQuery(true);

    // Insert columns.
    $columns = array('id', 'vraag', 'antwoord1', 'antwoord2', 'antwoord3', 'antwoord4');

    // Insert values.
    $values = array($id, $db->quote($vraag), 0,0,0,0);

    // Prepare the insert query.
    $query
        ->insert($db->quoteName('#__pollAntwoorden'))
        ->columns($db->quoteName($columns))
        ->values(implode(',', $values));

    // Set the query using our newly populated query object and execute it.
    $db->setQuery($query);
    $db->execute();
  }

  function refresh(){
      echo "<script>
                if ( window.history.replaceState ) {
                  window.history.replaceState( null, null, window.location.href );
                  location.reload(true);
                }
              </script>";
  }

}

class mod_pollData {
   public $id;
   public $vraag;
   public $antwoord1;
   public $antwoord2;
   public $antwoord3;
   public $antwoord4;

   public function __construct($id,$vraag = "",$antwoord1 = "",$antwoord2 = "",$antwoord3 = "",$antwoord4 = "",$succes = false) {
      $this->id = $id;
      $this->vraag = $vraag;
      $this->antwoord1 = $antwoord1;
      $this->antwoord2 = $antwoord2;
      $this->antwoord3 = $antwoord3;
      $this->antwoord4 = $antwoord4;
      $this->succes = $succes;
   }
}
 ?>
