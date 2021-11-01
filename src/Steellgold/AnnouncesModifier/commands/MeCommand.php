<?php

namespace Steellgold\AnnouncesModifier\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\CommandException;
use pocketmine\Player;
use pocketmine\Server;
use Steellgold\AnnouncesModifier\AM;

class MeCommand extends Command{
    public $config;

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = []) {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->config = AM::getInstance()->getConfig()->get("commands")["me"];
        if($this->config["permission"] !== "none"){
            $this->setPermission($this->config["permission"]);
        }
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!$this->testPermission($sender)){
            return true;
        }

        Server::getInstance()->broadcastMessage(str_replace(array("{SENDER}","{MESSAGE}"),array($sender->getName(), implode(" ", $args)),$this->config["message"]));
        return true;
    }
}