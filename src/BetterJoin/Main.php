<?php

namespace BetterJoin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\world\sound\XpCollectSound;
use IvanCraft623\RankSystem\RankSystem;

class Main extends PluginBase implements Listener{

    private Config $config;

    public function onEnable(): void{
        $this->saveDefaultConfig();
        $this->config = $this->getConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event): void{
        $player = $event->getPlayer();
        $event->setJoinMessage($this->buildMessage($player, true));

        if($this->config->getNested("sound.enabled", true)){
            $player->getWorld()->addSound($player->getLocation(), new XpCollectSound());
        }
    }

    public function onQuit(PlayerQuitEvent $event): void{
        $player = $event->getPlayer();
        $event->setQuitMessage($this->buildMessage($player, false));
    }

    private function buildMessage(Player $player, bool $join): string{
        $mode = strtolower($this->config->get("message-mode", "static"));
        $symbol = $join ? $this->config->getNested("symbols.join") : $this->config->getNested("symbols.leave");
        $format = $join ? $this->config->getNested("format.join") : $this->config->getNested("format.leave");

        if($mode === "dynamic"){
            $color = $this->getRankColor($player);
            $coloredSymbol = $color . $symbol;
            $playerName = $color . $player->getName();
        }else{
            // FORCE RESET before applying static color
            $color = $join ? $this->config->getNested("static.join-color") : $this->config->getNested("static.leave-color");
            $coloredSymbol = "§r" . $color . $symbol;
            $playerName = "§r" . $color . $player->getName();
        }

        $message = str_replace("{symbol}", $coloredSymbol, $format);
        $message = str_replace("{player}", $playerName, $message);

        return "§r" . $message;
    }

    private function getRankColor(Player $player): string{

        if(!class_exists(RankSystem::class)){
            return "§f";
        }

        $rankSystem = RankSystem::getInstance();
        $session = $rankSystem->getSessionManager()->get($player);

        if($session === null){
            return "§f";
        }

        $rank = $session->getHighestRank();
        $nameTagData = $rank->getNameTagFormat();

        if(isset($nameTagData["nameColor"])){
            return $nameTagData["nameColor"];
        }

        return "§f";
    }
}
