<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class CalteauPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class CalteauPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        
        // Finding Abusive style
        
        $ennemyStats= $this->result->getStatsFor($this->opponentSide);
        $nbTurn = $this->result->getNbRound();
        $repetitivness = null; 
        if ($nbTurn > 5)
        {
           $lastMoves = array_values($this->result->getChoicesFor($this->opponentSide));
           $x = sizeof($lastMoves) - 1;
           for ($i = 0; $i < 5; $i++)
            {
                $move = $lastMoves[$x - $i];
                if ($move == parent::rockChoice())
                  if ($i == 4)
                  $repetitivness = parent::rockChoice();
                continue;

            }
            for ($i = 0; $i < 5; $i++)
            {
                $move = $lastMoves[$x - $i];
                if ($move == parent::paperChoice())
                  if ($i == 4)
                  $repetitivness = parent::paperChoice();
                continue;

            }
            for ($i = 0; $i < 5; $i++)
            {
                $move = $lastMoves[$x - $i];
                if ($move == parent::scissorsChoice())
                  if ($i == 4)
                  $repetitivness = parent::scissorsChoice();
                continue;

            }
            if ($repetitivness == parent::rockChoice())
                $choice = parent::paperChoice();
                if ($repetitivness == parent::paperChoice())
                $choice = parent::scissorsChoice();
                if ($repetitivness == parent::scissorsChoice())
                $choice = parent::rockChoice();
        }
        if ($repetitivness != null)
            return $choice;

        else if ($nbTurn == 0)
        $choice = parent::rockChoice();

        else if ($ennemyStats['rock'] / $nbTurn > 0.5)
            $choice = parent::paperChoice();
        else if ($ennemyStats['paper'] / $nbTurn > 0.5)
            $choice = parent::scissorsChoice();
        else if ($ennemyStats['scissors'] / $nbTurn > 0.5)
            $choice = parent::rockChoice();
        else if ($ennemyStats['rock'] < $ennemyStats['scissors'] &&
           $ennemyStats['paper'] < $ennemyStats['scissors'])
           $choice = parent::rockChoice();
      else if ($ennemyStats['scissors'] < $ennemyStats['rock'] &&
      $ennemyStats['paper'] < $ennemyStats['rock'])
      $choice = parent::paperChoice();
      else if ($ennemyStats['rock'] < $ennemyStats['paper'] &&
      $ennemyStats['scissors'] < $ennemyStats['paper'])
      $choice = parent::scissorsChoice();
      else
          $choice = parent::rockChoice();
   
   return $choice;
         /*
        if (10 * $ennemyStats['rock'] < $ennemyStats['scissors'] &&
             10 * $ennemyStats['paper'] < $ennemyStats['scissors'])
             $choice = parent::rockChoice();
        else if (10 * $ennemyStats['scissors'] < $ennemyStats['rock'] &&
        10 * $ennemyStats['paper'] < $ennemyStats['rock'])
        $choice = parent::paperChoice();
        else if (10 * $ennemyStats['rock'] < $ennemyStats['paper'] &&
        10 * $ennemyStats['scissors'] < $ennemyStats['paper'])
        $choice = parent::scissorsChoice();
       
       // Countering the counter 
        else if ( $this->result->getLastChoiceFor($this->mySide) == parent::rockChoice())
        $choice = parent::scissorsChoice();
        else if ( $this->result->getLastChoiceFor($this->mySide) == parent::paperChoice())
        $choice = parent::rockChoice();
        else if ( $this->result->getLastChoiceFor($this->mySide) == parent::scissorsChoice())
        $choice = parent::paperChoice();*/
        //If no abusive style, will take his last move and counter

        /*else if ($this->result->getLastChoiceFor($this->opponentSide) == parent::scissorsChoice())
            $choice = parent::rockChoice();
        else if ($this->result->getLastChoiceFor($this->opponentSide) == parent::rockChoice())
            $choice = parent::paperChoice();
        else
            $choice = parent::rockChoice();
*/
       
    }
};


// -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
