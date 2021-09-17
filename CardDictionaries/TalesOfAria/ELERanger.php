<?php


  function ELERangerCardType($cardID)
  {
    switch($cardID)
    {
      case "ELE031": case "ELE032": return "C";
      case "ELE033": case "ELE034": return "W";
      case "ELE035": return "AA";
      case "ELE036": return "AA";
      case "ELE037": return "A";
      case "ELE038": case "ELE039": case "ELE040": return "AA";
      case "ELE041": case "ELE042": case "ELE043": return "AA";
      case "ELE044": case "ELE045": case "ELE046": return "AA";
      case "ELE047": case "ELE048": case "ELE049": return "AA";
      case "ELE050": case "ELE051": case "ELE052": return "AA";
      case "ELE053": case "ELE054": case "ELE055": return "AA";
      case "ELE056": case "ELE057": case "ELE058": return "AA";
      case "ELE059": case "ELE060": case "ELE061": return "AA";
      case "ELE213": return "E";
      case "ELE214": return "E";
      case "ELE215": return "A";
      case "ELE216": case "ELE217": case "ELE218": return "AA";
      case "ELE219": case "ELE220": case "ELE221": return "A";
      default: return "";
    }
  }

  function ELERangerCardSubType($cardID)
  {
    switch($cardID)
    {
      case "ELE033": case "ELE034": return "Bow";
      case "ELE035": case "ELE036": return "Arrow";
      case "ELE038": case "ELE039": case "ELE040":
      case "ELE041": case "ELE042": case "ELE043":
      case "ELE044": case "ELE045": case "ELE046":
      case "ELE047": case "ELE048": case "ELE049":
      case "ELE050": case "ELE051": case "ELE052":
      case "ELE053": case "ELE054": case "ELE055":
      case "ELE056": case "ELE057": case "ELE058":
      case "ELE059": case "ELE060": case "ELE061": return "Arrow";
      case "ELE213": return "Head";
      case "ELE214": return "Head";
      case "ELE216": case "ELE217": case "ELE218": return "Arrow";
      default: return "";
    }
  }

  //Minimum cost of the card
  function ELERangerCardCost($cardID)
  {
    switch($cardID)
    {
      case "ELE035": return 1;
      case "ELE036": return 1;
      case "ELE037": return 0;
      case "ELE038": case "ELE039": case "ELE040": return 1;
      case "ELE041": case "ELE042": case "ELE043": return 0;
      case "ELE044": case "ELE045": case "ELE046": return 1;
      case "ELE047": case "ELE048": case "ELE049": return 1;
      case "ELE050": case "ELE051": case "ELE052": return 1;
      case "ELE053": case "ELE054": case "ELE055": return 0;
      case "ELE056": case "ELE057": case "ELE058": return 1;
      case "ELE059": case "ELE060": case "ELE061": return 1;
      //Normal Ranger
      case "ELE215": return 0;
      case "ELE216": case "ELE217": case "ELE218": return 0;
      case "ELE219": case "ELE220": case "ELE221": return 1;
      default: return 0;
    }
  }

  function ELERangerPitchValue($cardID)
  {
    switch($cardID)
    {
      case "ELE035": return 3;
      case "ELE036": return 2;
      case "ELE037": return 1;
      case "ELE038": case "ELE041": case "ELE044": case "ELE047": case "ELE050": case "ELE053": case "ELE056": case "ELE059": return 1;
      case "ELE039": case "ELE042": case "ELE045": case "ELE048": case "ELE051": case "ELE054": case "ELE057": case "ELE060": return 2;
      case "ELE040": case "ELE043": case "ELE046": case "ELE049": case "ELE052": case "ELE055": case "ELE058": case "ELE061": return 3;
      //Normal Ranger
      case "ELE215": return 1;
      case "ELE216": case "ELE219": return 1;
      case "ELE217": case "ELE220": return 2;
      case "ELE218": case "ELE221": return 3;
      default: return 0;
    }
  }

  function ELERangerBlockValue($cardID)
  {
    switch($cardID)
    {
      case "ELE031": case "ELE032": case "ELE033": case "ELE034": return 0;
      case "ELE037": return 2;
      case "ELE213": return 2;
      case "ELE214": return 0;
      case "ELE215": return 2;
      case "ELE219": case "ELE220": case "ELE221": return 2;
      default: return 3;
    }
  }

  function ELERangerAttackValue($cardID)
  {
    switch($cardID)
    {
      case "ELE035": return 3;
      case "ELE036": return 4;
      case "ELE038": case "ELE044": case "ELE047": case "ELE050": case "ELE056": case "ELE059": return 5;
      case "ELE039": case "ELE041": case "ELE045": case "ELE048": case "ELE051": case "ELE053": case "ELE057": case "ELE060": return 4;
      case "ELE040": case "ELE042": case "ELE046": case "ELE049": case "ELE052": case "ELE054": case "ELE058": case "ELE061": return 3;
      case "ELE043": case "ELE055": return 2;
      //Normal Ranger
      case "ELE216": return 4;
      case "ELE217": return 3;
      case "ELE218": return 2;
      default: return 0;
    }
  }

  function ELERangerPlayAbility($cardID, $from, $resourcesPaid)
  {
    global $currentPlayer, $otherPlayer;
    switch($cardID)
    {
      case "ELE031": case "ELE032":
        if(ArsenalHasFaceDownCard($currentPlayer))
        {
          $cardFlipped = SetArsenalFacing("UP", $currentPlayer);
          $rv = "Lexi turned " . $cardFlipped . " face up.";
          if(TalentContains($cardFlipped, "LIGHTNING")) AddCurrentTurnEffect("ELE031-1", $currentPlayer);
          else if(TalentContains($cardFlipped, "ICE")) PlayAura("ELE111", $otherPlayer);
        }
        return $rv;
      case "ELE033":
        if(ArsenalFull($currentPlayer)) return "Your arsenal is full, so you cannot put an arrow in your arsenal.";
        AddDecisionQueue("FINDINDICES", $currentPlayer, "MYHANDARROW");
        AddDecisionQueue("MAYCHOOSEHAND", $currentPlayer, "<-", 1);
        AddDecisionQueue("REMOVEMYHAND", $currentPlayer, "-", 1);
        AddDecisionQueue("ADDARSENALFACEUP", $currentPlayer, "HAND", 1);
        AddDecisionQueue("BUTTONINPUT", $currentPlayer, "1_Attack,Dominate");
        AddDecisionQueue("SHIVER", $currentPlayer, "-", 1);
        return "";
      case "ELE034":
        if(ArsenalFull($currentPlayer)) return "Your arsenal is full, so you cannot put an arrow in your arsenal.";
        AddDecisionQueue("FINDINDICES", $currentPlayer, "MYHANDARROW");
        AddDecisionQueue("MAYCHOOSEHAND", $currentPlayer, "<-", 1);
        AddDecisionQueue("REMOVEMYHAND", $currentPlayer, "-", 1);
        AddDecisionQueue("ADDARSENALFACEUP", $currentPlayer, "HAND", 1);
        AddDecisionQueue("BUTTONINPUT", $currentPlayer, "1_Attack,Go_again");
        AddDecisionQueue("VOLTAIRE", $currentPlayer, "-", 1);
        return "";
      case "ELE035":
        Fuse($cardID, $currentPlayer, "ICE");
        AddCurrentTurnEffect($cardID . "-1", $otherPlayer);
        return "Frost Lock makes cards and activating abilities by the opponent cost 1 more this turn.";
      case "ELE036":
        Fuse($cardID, $currentPlayer, "LIGHTNING");
        return "";
      case "ELE037":
        Fuse($cardID, $currentPlayer, "ICE,LIGHTNING");
        AddCurrentTurnEffect("ELE037-1", $currentPlayer);
        return "";
      case "ELE038": case "ELE039": case "ELE040":
        Fuse($cardID, $currentPlayer, "ICE");
        return "";
      case "ELE041": case "ELE042": case "ELE043":
        Fuse($cardID, $currentPlayer, "LIGHTNING");
        return "";
      case "ELE044": case "ELE045": case "ELE046":
        Fuse($cardID, $currentPlayer, "ICE");
        return "";
      case "ELE047": case "ELE048": case "ELE049":
        Fuse($cardID, $currentPlayer, "LIGHTNING");
        return "";
      case "ELE050": case "ELE051": case "ELE052":
        Fuse($cardID, $currentPlayer, "ICE");
        return "";
      case "ELE053": case "ELE054": case "ELE055":
        Fuse($cardID, $currentPlayer, "LIGHTNING");
        return "";
      case "ELE056": case "ELE057": case "ELE058":
        Fuse($cardID, $currentPlayer, "ICE");
        return "";
      case "ELE059": case "ELE060": case "ELE061":
        Fuse($cardID, $currentPlayer, "LIGHTNING");
        return "";
      case "ELE214":
        $arsenal = &GetArsenal($currentPlayer);
        for($i=0; $i < count($arsenal); $i+=ArsenalPieces())
        {
          AddPlayerHand($arsenal[$i], $currentPlayer, "ARS");
        }
        $arsenal = [];
        AddDecisionQueue("FINDINDICES", $currentPlayer, "HAND");
        AddDecisionQueue("MAYCHOOSEHAND", $currentPlayer, "<-", 1);
        AddDecisionQueue("MULTIREMOVEHAND", $currentPlayer, "-", 1);
        AddDecisionQueue("ADDARSENALFACEDOWN", $currentPlayer, "HAND", 1);
        return "";
      case "ELE215":
        AddCurrentTurnEffect($cardID, $currentPlayer);
        return "Seek and Destroy gives your next arrow attack +3 and if it hits destroys your opponent's hand an arsenal next turn.";
      case "ELE219": case "ELE220": case "ELE221":
        AddCurrentTurnEffect($cardID, $currentPlayer);
        Reload();
        return "Over Flex gives your next arrow attack this turn +" . EffectAttackModifier($cardID) . " and lets you reload.";
      default: return "";
    }
  }

  function ELERangerHitEffect($cardID)
  {
    global $defPlayer, $combatChainState, $CCS_AttackFused, $mainPlayer;
    switch($cardID)
    {
      case "ELE036":
        if($combatChainState[$CCS_AttackFused]) DealDamage($defPlayer, NumEquipment($defPlayer), "ATTACKHIT");
        break;
      case "ELE216": case "ELE217": case "ELE218": if(HasIncreasedAttack()) Reload($mainPlayer); break;
      default: break;
    }
  }

  function Fuse($cardID, $player, $elements)
  {
    $elementArray = explode(",", $elements);
    $elementText = "";
    for($i=0; $i<count($elementArray); ++$i)
    {
      $element = $elementArray[$i];
      AddDecisionQueue("FINDINDICES", $player, "HAND" . $element, $i > 0 ? 1 : 0);
      AddDecisionQueue("MAYCHOOSEHAND", $player, "<-", 1);
      AddDecisionQueue("REVEALMYCARD", $player, "<-", 1);
      if($i > 0) $elementText .= " and ";
      $elementText .= $element;
    }
    AddDecisionQueue("AFTERFUSE", $player, $cardID . "-" . $elements, 1);
    WriteLog("To get the effect of card " . $cardID . ", you may fuse " . $elementText . ".");
  }

  function FuseAbility($cardID, $player, $element)
  {
    global $CS_NextNAAInstant, $CS_PlayCCIndex, $combatChain;
    $otherPlayer = ($player == 2 ? 1 : 2);
    switch($cardID)
    {
      case "ELE004": AddCurrentTurnEffect($cardID, $otherPlayer); break;
      case "ELE005": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE007": case "ELE008": case "ELE009": PayOrDiscard($otherPlayer, 2, true); break;
      case "ELE010": case "ELE011": case "ELE012":
        $index = GetClassState($player, $CS_PlayCCIndex);
        $combatChain[$index + 6] += 2;
        break;
      case "ELE016": case "ELE017": case "ELE018": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE019": case "ELE020": case "ELE021": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE022": case "ELE023": case "ELE024": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE025": case "ELE026": case "ELE027": PlayAura("ELE111", $otherPlayer); break;
      case "ELE028": case "ELE029": case "ELE030": PlayAura("WTR075", $player); break;
      case "ELE035": AddCurrentTurnEffect($cardID . "-2", $player); break;
      case "ELE037": AddCurrentTurnEffect($cardID . "-2", $player); break;
      case "ELE038": case "ELE039": case "ELE040": AddCurrentTurnEffect($cardID, $otherPlayer); break;
      case "ELE041": case "ELE042": case "ELE043":
        SearchCharacterAddUses($player, 1, "W", "Bow");
        SearchCharacterAddEffect($player, "INSTANT", "W", "Bow");
        break;
      case "ELE044": case "ELE045": case "ELE046": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE047": case "ELE048": case "ELE049": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE050": case "ELE051": case "ELE052": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE053": case "ELE054": case "ELE055": GiveAttackGoAgain(); break;
      case "ELE056": case "ELE057": case "ELE058": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE059": case "ELE060": case "ELE061": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE064": AddCurrentTurnEffect($cardID, $player); DealArcane(1, 0, "PLAYCARD", $cardID, true); break;
      case "ELE065": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE066": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE070": case "ELE071": case "ELE072": DealArcane(1, 0, "PLAYCARD", $cardID, true); break;
      case "ELE073": case "ELE074": case "ELE075": DealArcane(1, 0, "PLAYCARD", $cardID, true); break;
      case "ELE076": case "ELE077": case "ELE078": SetClassState($player, $CS_NextNAAInstant, 1); break;
      case "ELE079": case "ELE080": case "ELE081":
          PrependDecisionQueue("ADDBOTDECK", $player, "-", 1);
          PrependDecisionQueue("REMOVEDISCARD", $player, "-", 1);
          PrependDecisionQueue("MAYCHOOSEDISCARD", $player, "<-", 1);
          PrependDecisionQueue("FINDINDICES", $player, "GYAA");
        break;
      case "ELE082": case "ELE083": case "ELE084": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE085": case "ELE086": case "ELE087": AddCurrentTurnEffect($cardID . "-FUSE", $player); break;
      case "ELE088": DealArcane(3, 0, "PLAYCARD", $cardID, true); break;//Assumed
      case "ELE089": DealArcane(2, 0, "PLAYCARD", $cardID, true); break;//Assumed
      case "ELE090": DealArcane(1, 0, "PLAYCARD", $cardID, true); break;
      case "ELE091":
        if($element == "EARTH") AddCurrentTurnEffect($cardID . "-BUFF", $player);
        else if($element == "LIGHTNING") AddCurrentTurnEffect($cardID . "-GA", $player);
        break;
      case "ELE092":
        if($element == "ICE") AddCurrentTurnEffect($cardID . "-DOM", $player);
        else if($element == "LIGHTNING") AddCurrentTurnEffect($cardID . "-BUFF", $player);
        break;
      case "ELE093":
        if($element == "EARTH") ExposedToTheElementsEarth($player);
        else if($element == "ICE") ExposedToTheElementsIce($player);
        break;
      case "ELE094": case "ELE095": case "ELE096":
        $index = GetClassState($player, $CS_PlayCCIndex);
        $combatChain[$index + 5] += 2;
        break;
      case "ELE097": case "ELE098": case "ELE099": AddCurrentTurnEffect($cardID, $player); break;
      case "ELE100": case "ELE101": case "ELE102": GiveAttackGoAgain(); break;
      default: break;
    }
  }

  function PayOrDiscard($player, $amount, $fromDQ=false)
  {
    if($fromDQ)
    {
      PrependDecisionQueue("DISCARDMYHAND", $player, "-", 1);
      PrependDecisionQueue("CHOOSEHAND", $player, "<-", 1);
      PrependDecisionQueue("FINDINDICES", $player, "HANDIFZERO", 1);
      PrependDecisionQueue("PAYRESOURCES", $player, "<-", 1);
      PrependDecisionQueue("FINDRESOURCECOST", $player, $amount, 1);
      PrependDecisionQueue("YESNO", $player, "if_you_want_to_pay_" . $amount . "_to_avoid_discarding_a_card", 1, 1);
    }
    else
    {
      AddDecisionQueue("YESNO", $player, "if_you_want_to_pay_" . $amount . "_to_avoid_discarding_a_card", 1, 1);
      AddDecisionQueue("FINDRESOURCECOST", $player, $amount, 1);
      AddDecisionQueue("PAYRESOURCES", $player, "<-", 1);
      AddDecisionQueue("FINDINDICES", $player, "HANDIFZERO", 1);
      AddDecisionQueue("CHOOSEHAND", $player, "<-", 1);
      AddDecisionQueue("DISCARDMYHAND", $player, "-", 1);
    }
  }

?>

