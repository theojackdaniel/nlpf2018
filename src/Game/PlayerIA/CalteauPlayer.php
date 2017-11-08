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

        //Checking abusive style
        
        $ennemyStats= $this->result->getStatsFor($this->opponentSide);
        if (5 * $ennemyStats['rock'] < $ennemyStats['scissors'] ||
             5 * $ennemyStats['paper'] < $ennemyStats['scissors'])
             $choice = parent::rockChoice();
        else if (5 * $ennemyStats['scissors'] < $ennemyStats['rock'] ||
        5 * $ennemyStats['paper'] < $ennemyStats['rock'])
        $choice = parent::paperChoice();
        else if (5 * $ennemyStats['rock'] < $ennemyStats['paper'] ||
        5 * $ennemyStats['scissors'] < $ennemyStats['paper'])
        $choice = parent::scissorsChoice();
        
        //If no abusive style, will take his last move and counter

        else if ($this->result->getLastChoiceFor($this->opponentSide) == parent::scissorsChoice())
            $choice = parent::rockChoice();
        else if ($this->result->getLastChoiceFor($this->opponentSide) == parent::rockChoice())
            $choice = parent::paperChoice();
        else
            $choice = parent::rockChoice();

        return $choice;
    }
};