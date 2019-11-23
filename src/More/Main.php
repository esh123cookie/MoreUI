<?php

namespace More;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
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
                     $sender->sendMesseage(TextFormat::RED . "You do not have permission to use this command!");
                     return true;
                }     
            break;         
         }  
        return true;                         
    }
   
    public function openMenu($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $this->openFlyUI($sender);
                break;
                case 1:
                    $this->openHealthUI($sender);
                break;
            }
        });
        $form->setTitle("§lMoreUI");
        $form->setContent("Chose a Category");
        $form->addButton("FlyUI");
        $form->addButton("HealthUI");
        $form->sendToPlayer($sender);
        return $form;                                            
    }
    
    public function openFlyUI($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
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
        $form->setTitle("§lFlyUI");
        $form->addButton("§lOn");
        $form->addButton("§lOff");
        $form->addButton("§lExit");
        $form->sendToPlayer($sender);
        return $form;                                            
    }
    
    public function openHealthUI($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $sender->setHealth(20);
                    $sender->addTitle("Healed", "Your HP is Full");
                    $sender->sendMessage("§aYou have been healed!");
                break;
                case 1:
                    
                break;
            }
        });
        $form->setTitle("§lHealUI");
        $form->addButton("§lHeal");
        $form->addButton("§lExit");
        $form->sendToPlayer($sender);
        return $form;                                            
    }
                                                                                                                                                                                                                                                                                          
}
