<?php

namespace AdminTools;

use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getLogger()->info(TextFormat::GREEN . "MoreUI Enable");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "MoreUI Disable");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) ; bool{
        
        switch($cmd->getName()){
            case "moreui":
                if($sender instanceof Player){
                   $this->openMyForm($sender);
                }
            if ($sender->hasPermission("moreui.command")){
                     $this->openMyForm($sender);
                else{     
                     $sender->sendMesseage(TextFormat::RED . "You do not have permission to use this command!");
                     return true;
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
                    $this->openFlyUI($sender);
                break;
                
            }
        });
        $form->setTitle("MoreUI");
        $form->setContent("Select a Category");
        $form->addButton("Fly");
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
                   $sender->sendMessage(TextFormat::GREEN . "Enabled flight mode!");
                   $sender->addTitle("§l§6Fly", "§a§lEnable");
                   $sender->setAllowFlight(true);
               break;
                   
               case 1:
                   $sender->sendMessage(TextFormat::RED . "Disabled flight mode!");
                   $sender->addTitle("§l§6Fly", "§c§lDisable");
                   $sender->setAllowFlight(false);
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
}
