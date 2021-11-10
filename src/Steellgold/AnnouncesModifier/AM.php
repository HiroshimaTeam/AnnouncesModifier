<?php
/*
 * Copyright (c) 2021. Gaëtan H
 * https://github.com/Steellgold
 */

namespace Steellgold\AnnouncesModifier;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use Steellgold\AnnouncesModifier\commands\MeCommand;
use Steellgold\AnnouncesModifier\commands\SayCommand;

class AM extends PluginBase {
    private string $version = "1.0";

    public static $instance;

    public function onEnable() {
        self::setInstance($this);

        if($this->getConfig()->exists("version") AND $this->getConfig()->get("version") !== $this->version){
            $this->getLogger()->alert("The plug-in configuration has been modified since an update, your old configuration has been renamed to old_config.yml");
            rename($this->getDataFolder() . "config.yml",$this->getDataFolder() . "old_config.yml");
            $this->getServer()->getPluginManager()->disablePlugin($this);
            return;
        }

        $map = $this->getServer()->getCommandMap();
        $command = $map->getCommand("me");
        $map->unregister($command);
        $command = $map->getCommand("say");
        $map->unregister($command);

        $this->getServer()->getCommandMap()->registerAll("announcesmodifier", [
            new SayCommand("say",$this->getConfig()->get("commands")["say"]["description"], "say <type:optionnal> <message>"),
            new MeCommand("me",$this->getConfig()->get("commands")["me"]["description"],"me <message>")
        ]);
    }

    public static function getInstance() : AM {
        return self::$instance;
    }


    public static function setInstance($instance): void {
        self::$instance = $instance;
    }
}