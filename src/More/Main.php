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
                if ($player->hasPermission("moreui.command")){
                     $this->openMenu($sender);
                }else{     
                     $player->sendMesseage(TextFormat::RED . "You do not have permission to use this command!");
                     return true;
                }     
            break;         
         }  
        return true;                         
    }
   
    public function openMenu($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $this->openFlyUI($player);
                break;
                case 1:
                    $this->openHealthUI($player);
                break;
            }
        });
        $form->setTitle("§lMoreUI");
        $form->setContent("Chose a Category");
        $form->addButton("FlyUI");
        $form->addButton("HealthUI");
        $form->sendToPlayer($player);
        return $form;                                            
    }
    
    public function openFlyUI($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $player->sendMessage(TextFormat::GREEN . "Enabled flight mode!");
                    $player->addTitle("§l§6Fly", "§a§lEnable");
                    $player->setAllowFlight(true);
                break;
                case 1:
                    $player->sendMessage(TextFormat::RED . "Disabled flight mode!");
                    $player->addTitle("§l§6Fly", "§c§lDisable");
                    $player->setAllowFlight(false);
                break;
                case 2:
                    $this->openMenu($player);
                break;
            }
        });
        $form->setTitle("§lFlyUI");
        $form->addButton("§lOn");
        $form->addButton("§lOff");
        $form->addButton("§lExit");
        $form->sendToPlayer($player);
        return $form;                                            
    }
    
    public function openHealthUI($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $player->setHealth(20);
                    $player->addTitle("Healed", "Your HP is Full");
                    $player->sendMessage("§aYou have been healed!");
                break;
                case 1:
                    $this->openMenu($player);
                break;
            }
        });
        $form->setTitle("§lHealUI");
        $form->addButton("§lHeal");
        $form->addButton("§lExit");
        $form->sendToPlayer($player);
        return $form;                                            
    }
                                                                                                                                                                                                                                                                                          
}
