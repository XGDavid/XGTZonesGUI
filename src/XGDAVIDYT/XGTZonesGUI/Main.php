<?php

declare(strict_types=1);

namespace XGDAVIDYT\XGTZonesGUI;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\permission\ServerOperator;
use pocketmine\utils\TextFormat;
use pocketmine\event\entity;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\Utils;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginManager;
use pocketmine\math\Vector3;

use muqsit\invmenu\{InvMenu, InvMenuHandler, MenuIds, InvMenuEventHandler};
use pocketmine\inventory\transaction\action\SlotChangeAction;

class Main extends PluginBase implements Listener{

	public function onEnable() : void{
		$this->saveResource("config.yml");
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		if(!InvMenuHandler::isRegistered()){
            InvMenuHandler::register($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{

        $name = $sender->getName();
    	$player = $sender->getServer()->getPlayerExact($name);
        $chest = $this->config->get("Name-Chest");
		$gapple = $this->config->get("Name-GoldenAplle");
		$melon = $this->config->get("Name-Melon");
		$sword = $this->config->get("Name-Sword");
		$egg = $this->config->get("Name-Egg");
		$stone = $this->config->get("Name-Stone");
		$sand = $this->config->get("Name-Sand");
		$megg = $this->config->get("Message-Egg");
		$mchest = $this->config->get("Message-Chest");
		$mgapple = $this->config->get("Message-GoldenAplle");
		$mmelon = $this->config->get("Message-Melon");
		$msword = $this->config->get("Message-Sword");
		$mstone = $this->config->get("Message-Stone");
		$msand = $this->config->get("Message-Sand");
		$locked = $this->config->get("Name-Locked");

		if($command->getName() === "mac"){
			if($sender instanceof Player){
				$player->sendMessage("s");
				$menu = InvMenu::create(InvMenu::TYPE_CHEST);
				$inventory = $menu->getInventory();
				if($this->config->get("Type") == 1){
					$menu->setListener(function(Player $player, Item $itemClicked, Item $itemClickedWith, SlotChangeAction $action) : void{
					if($itemClicked->getId() === ItemIds::GOLDEN_APPLE){
						$player->removeWindow($action->getInventory());
						$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$mgapple);
						$player->teleport(new Vector3($this->config->get("GAplle-X"), $this->config->get("GAplle-Y"), $this->config->get("GAplle-Z")));
					}
					if($itemClicked->getId() === ItemIds::CHEST){
						$player->removeWindow($action->getInventory());
						$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$mchest);
						$player->teleport(new Vector3($this->config->get("Chest-X"), $this->config->get("Chest-Y"), $this->config->get("Chest-Z")));
					}
					if($itemClicked->getId() === ItemIds::MELON){
						$player->removeWindow($action->getInventory());
						$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$mmelon);
						$player->teleport(new Vector3($this->config->get("Melon-X"), $this->config->get("Melon-Y"), $this->config->get("Melon-Z")));
					}
					if($itemClicked->getId() === ItemIds::DIAMOND_SWORD){
						$player->removeWindow($action->getInventory());
						$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$msword);
						$player->teleport(new Vector3($this->config->get("DMDSword-X"), $this->config->get("DMDSword-Y"), $this->config->get("DMDSword-Z")));
					}
					});
					$block = Item::get(Block::IRON_BARS);
					$menu->getInventory()->setItem(10, Item::get(Item::GOLDEN_APPLE)->setCustomName($gapple));
					$menu->getInventory()->setItem(12, Item::get(Item::CHEST)->setCustomName($chest));
					$menu->getInventory()->setItem(14, Item::get(Item::DIAMOND_SWORD)->setCustomName($sword));
					$menu->getInventory()->setItem(16, Item::get(Item::MELON)->setCustomName($melon));
					$menu->getInventory()->setItem(1, $block);
					$menu->getInventory()->setItem(2, $block);
					$menu->getInventory()->setItem(3, $block);
					$menu->getInventory()->setItem(4, $block);
					$menu->getInventory()->setItem(5, $block);
					$menu->getInventory()->setItem(6, $block);
					$menu->getInventory()->setItem(7, $block);
					$menu->getInventory()->setItem(8, $block);
					$menu->getInventory()->setItem(9, $block);
					$menu->getInventory()->setItem(17, $block);
					$menu->getInventory()->setItem(18, $block);
					$menu->getInventory()->setItem(19, $block);
					$menu->getInventory()->setItem(20, $block);
					$menu->getInventory()->setItem(21, $block);
					$menu->getInventory()->setItem(22, $block);
					$menu->getInventory()->setItem(23, $block);
					$menu->getInventory()->setItem(24, $block);
					$menu->getInventory()->setItem(25, $block);
					$menu->getInventory()->setItem(0, $block);
					$menu->getInventory()->setItem(26, $block);
					$menu->readonly();
					$menu->setName("XGT Zones's");
					$menu->send($player);
				}elseif($this->config->get("Type") == 2){
					$menu->setListener(function(Player $player, Item $itemClicked, Item $itemClickedWith, SlotChangeAction $action) : void{
						if($itemClicked->getId() === ItemIds::GOLDEN_APPLE){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$mgapple);
							$player->teleport(new Vector3($this->config->get("GAplle-X"), $this->config->get("GAplle-Y"), $this->config->get("GAplle-Z")));
						}
						if($itemClicked->getId() === ItemIds::CHEST){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$mchest);
							$player->teleport(new Vector3($this->config->get("Chest-X"), $this->config->get("Chest-Y"), $this->config->get("Chest-Z")));
						}
						if($itemClicked->getId() === ItemIds::MELON){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$mmelon);
							$player->teleport(new Vector3($this->config->get("Melon-X"), $this->config->get("Melon-Y"), $this->config->get("Melon-Z")));
						}
						if($itemClicked->getId() === ItemIds::DIAMOND_SWORD){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$mgapple);
							$player->teleport(new Vector3($this->config->get("DMDSword-X"), $this->config->get("DMDSword-Y"), $this->config->get("DMDSword-Z")));
						}
						if($itemClicked->getId() === ItemIds::STONE){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$mstone);
							$player->teleport(new Vector3($this->config->get("Stone-X"), $this->config->get("Stone-Y"), $this->config->get("Stone-Z")));
						}
						if($itemClicked->getId() === ItemIds::EGG){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$megg);
							$player->teleport(new Vector3($this->config->get("EGG-X"), $this->config->get("EGG-Y"), $this->config->get("EGG-Z")));
						}
						if($itemClicked->getId() === ItemIds::SAND){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§lZonesGUI§8]§l »§r§7 ".$msand);
							$player->teleport(new Vector3($this->config->get("Sand-X"), $this->config->get("Sand-Y"), $this->config->get("Sand-Z")));
						}
						});
						$block = Item::get(Block::IRON_BARS)->setCustomName($locked);
						$menu->getInventory()->setItem(10, Item::get(Item::GOLDEN_APPLE)->setCustomName($gapple));
						$menu->getInventory()->setItem(11, Item::get(Item::CHEST)->setCustomName($chest));
						$menu->getInventory()->setItem(12, Item::get(Item::DIAMOND_SWORD)->setCustomName($sword));
						$menu->getInventory()->setItem(13, Item::get(Item::MELON)->setCustomName($melon));
						$menu->getInventory()->setItem(14, Item::get(Item::EGG)->setCustomName($egg));
						$menu->getInventory()->setItem(15, Item::get(Item::STONE)->setCustomName($stone));
						$menu->getInventory()->setItem(16, Item::get(Item::SAND)->setCustomName($sand));
						$menu->getInventory()->setItem(1, $block);
						$menu->getInventory()->setItem(2, $block);
						$menu->getInventory()->setItem(3, $block);
						$menu->getInventory()->setItem(4, $block);
						$menu->getInventory()->setItem(5, $block);
						$menu->getInventory()->setItem(6, $block);
						$menu->getInventory()->setItem(7, $block);
						$menu->getInventory()->setItem(8, $block);
						$menu->getInventory()->setItem(9, $block);
						$menu->getInventory()->setItem(17, $block);
						$menu->getInventory()->setItem(18, $block);
						$menu->getInventory()->setItem(19, $block);
						$menu->getInventory()->setItem(20, $block);
						$menu->getInventory()->setItem(21, $block);
						$menu->getInventory()->setItem(22, $block);
						$menu->getInventory()->setItem(23, $block);
						$menu->getInventory()->setItem(24, $block);
						$menu->getInventory()->setItem(25, $block);
						$menu->getInventory()->setItem(0, $block);
						$menu->getInventory()->setItem(26, $block);
						$menu->readonly();
						$menu->setName("XGT Zones's");
						$menu->send($player);
					}
				}else{
					$player->sendMessage("[XGTZonesGUI] > Command only In-Game!");
				}
		}
        return true;
	}
}
