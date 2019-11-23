<?php

namespace AdminTools;

use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) ; bool{
        
        switch($cmd->getName()){
            case "kit":
                if($sender instanceof Player){
                   $this->openMyForm($sender);
                }
            break;
        }
        
        return true;
    }
    
    
    public function openMyForm($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->openFlyUI($player);
                break;
                
                case 1:
                
                break;
            }
        });
        $form->setTitle("MoreUI");
        $form->setContent("Select a Category");
        $form->addButton("Fly");
        $form->addButton("Kit");
        $form->sendToPlayer($player);
        return $form;
   }

   public function openFlyUI($player){
       $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
       $form = $api->createSimpleForm(function (Player $player, int $data = null){
           $result = data;
           if($result === null){
               return true;
           }
           switch($result){
               case 0:
                
               break;
                
               case 1:
                
               break;
           }
       });
       $form->setTitle("FlyUI");
       $form->setContent("Select a Category");
       $form->addButton("On");
       $form->addButton("Off");
       $form->addButton("Exits");
       $form->sendToPlayer($player);
       return $form;
   }
