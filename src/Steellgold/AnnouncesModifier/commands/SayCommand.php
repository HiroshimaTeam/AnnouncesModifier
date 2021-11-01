<?php

namespace Steellgold\AnnouncesModifier\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\CommandException;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use Steellgold\AnnouncesModifier\AM;

class SayCommand extends Command{
    public $config;

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = []) {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->config = AM::getInstance()->getConfig()->get("commands")["say"];
        if($this->config["permission"] !== "none"){
            $this->setPermission($this->config["permission"]);
        }
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!$this->testPermission($sender)){
            return true;
        }

        if(array_key_exists($args[0],$this->config["types"])){
            $prefix = $this->config["types"][$args[0]]["show"];
            $message = implode(" ", $args);
            $message = str_replace($args[0]." ","",$message);
        }else{
            $prefix = $this->config["types"]["server"]["show"];
            $message = implode(" ", $args);
        }

        Server::getInstance()->broadcastMessage(str_replace(array("{PREFIX}","{MESSAGE}"),array($prefix, $message),$this->config["message"]));
        return true;
    }
}