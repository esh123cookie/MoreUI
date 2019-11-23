<?php

namespace More;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "Enabled!");
    }
    
    public function onDisable() {
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info(TextFormat::RED . "Disabled!");
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "moreui":
                if ($sender->hasPermission("moreui.command")){
                     $this->openMenu($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "You dont have permission!");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
        
    
    public function openMenu($player){
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
        $form->sendToPlayer($sender);
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
       $form->sendToPlayer($sender);
       return $form;
   }
}
