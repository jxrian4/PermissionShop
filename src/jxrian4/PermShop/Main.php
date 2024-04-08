<?php

namespace jxrian4\PermShop;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginManager;

use pocketmine\utils\Config;
use pocketmine\event\Listener;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use jojoe77777\FormApi\SimpleForm;
use onebone\economyapi\EconomyAPi;

class Main extends PluginBase implements Listener {
  
  public int $i;
  public $cfg;
  
  public function onEnable(): void {
    
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->saveDefaultConfig();
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, string $label,
  array $args): bool {
    
    if($cmd->getName() === "permshop") {
      if($sender instanceof Player) {
        $this->permshop($sender);
        return true;
      } else {
        $sender->sendMessage("This command only work in-game");
        return false;
      }
    }
    return false;
  }
  
  private function permshop($player): void {
    
    $cfg = $this->getConfig();
    $name = $player->getName();
    $eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
    $monetary = $eco->getMonetaryUnit();
    $money = $eco->myMoney($player);
    
    $form = new SimpleForm(function(Player $player, $data) {
      
      if($data === null || $data === 0) {
        return true;
      }
      
      switch($data) {
        
        case 0:
          // close button
          break;
        default:
          $cfg = $this->getConfig();
          $name = $player->getName();
          $eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
          $monetary = $eco->getMonetaryUnit();
          $money = $eco->myMoney($player);
          if($money >= $cfg->get($data)["Permission"]["price"]) {
            $eco->reduceMoney($player, $cfg->get($data)["Permission"]["price"]);
            $player->addAttachment($this, $cfg->get($data)["Permission"]["permissions"]);
            $success = $cfg->get("msg-success");
            $success = str_replace("{perm}",$cfg->get($data)["Permission"]["name"], $success);
            $success = str_replace("{monetary_unit}", $monetary, $success);
            $success = str_replace("{price}", $cfg->get($data)["Permission"]["price"], $success);
            $player->sendMessage($success);
          } else {
            $failed = $cfg->get("msg-not-enough");
            $player->sendMessage($failed);
          }
        break;
      }
    });
    
    $title = $cfg->get("form-title");
    $content = $cfg->get("form-content");
    $content = str_replace("{player}", $name, $content);
    $content = str_replace("{monetary_unit}", $monetary, $content);
    $content = str_replace("{money}", $money, $content);
    $close = $cfg->get("close-button");
    
    $form->setTitle($title);
    $form->setContent($content);
    $form->addButton($close, 0, "textures/ui/cancel");
    for ($i = 1; $i <= 100; $i++) {

        if ($cfg->exists("$i")) {

            $form->addButton($cfg->get("$i")["Button"]["name"] .
            "\n§2" . $monetary . $cfg->get("$i")["Permission"]["price"], 0,
            $cfg->get("$i")["Button"]["texture"]);
            }
    }
    $player->sendForm($form);
  }
}
