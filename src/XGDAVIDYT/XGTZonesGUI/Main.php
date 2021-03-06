<?php

declare(strict_types=1);

namespace XGDAVIDYT\XGTZonesGUI;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\{Item, ItemIds};
use pocketmine\block\Block;
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
		//$this->getConfig() = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		if(!InvMenuHandler::isRegistered()){
            InvMenuHandler::register($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{

        $name = $sender->getName();
    	$player = $sender->getServer()->getPlayerExact($name);
			$chest = $this->getConfig()->get("Name-Chest");
			$gapple = $this->getConfig()->get("Name-GoldenApple");
			$melon = $this->getConfig()->get("Name-Melon");
			$sword = $this->getConfig()->get("Name-Sword");
			$egg = $this->getConfig()->get("Name-Egg");
			$stone = $this->getConfig()->get("Name-Stone");
			$sand = $this->getConfig()->get("Name-Sand");
			$megg = $this->getConfig()->get("Message-Egg");
			$mchest = $this->getConfig()->get("Message-Chest");
			$mgapple = $this->getConfig()->get("Message-GoldenAplle");
			$mmelon = $this->getConfig()->get("Message-Melon");
			$msword = $this->getConfig()->get("Message-Sword");
			$mstone = $this->getConfig()->get("Message-Stone");
			$msand = $this->getConfig()->get("Message-Sand");
			$locked = $this->getConfig()->get("Name-Locked");

		if($command->getName() === "zones"){
			if(!$sender instanceof Player){	
				$player->sendMessage("[XGTZonesGUI] > Command only In-Game!");
			}
			if($sender instanceof Player){
				$menu = InvMenu::create(InvMenu::TYPE_CHEST);
				
				$inventory = $menu->getInventory();
				if($this->getConfig()->get("Type") == 1){
					$menu->setListener(function(Player $player, Item $itemClicked, Item $itemClickedWith, SlotChangeAction $action) : void{
					if($itemClicked->getId() === ItemIds::GOLDEN_APPLE){
						$player->removeWindow($action->getInventory());
						$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to...");
						$player->teleport(new Vector3($this->getConfig()->get("GAplle-X"), $this->getConfig()->get("GAplle-Y"), $this->getConfig()->get("GAplle-Z")));
					}
					if($itemClicked->getId() === ItemIds::CHEST){
						$player->removeWindow($action->getInventory());
						$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to...");
						$player->teleport(new Vector3($this->getConfig()->get("Chest-X"), $this->getConfig()->get("Chest-Y"), $this->getConfig()->get("Chest-Z")));
					}
					if($itemClicked->getId() === ItemIds::MELON){
						$player->removeWindow($action->getInventory());
						$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to...");
						$player->teleport(new Vector3($this->getConfig()->get("Melon-X"), $this->getConfig()->get("Melon-Y"), $this->getConfig()->get("Melon-Z")));
					}
					if($itemClicked->getId() === ItemIds::DIAMOND_SWORD){
						$player->removeWindow($action->getInventory());
						$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to...".$sword);
						$player->teleport(new Vector3($this->getConfig()->get("DMDSword-X"), $this->getConfig()->get("DMDSword-Y"), $this->getConfig()->get("DMDSword-Z")));
					}
					});
					$block = Item::get(Block::IRON_BARS)->setCustomName($locked);
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
				}elseif($this->getConfig()->get("Type") == 2){
					$menu->setListener(function(Player $player, Item $itemClicked, Item $itemClickedWith, SlotChangeAction $action) : void{
						if($itemClicked->getId() === ItemIds::GOLDEN_APPLE){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to...");
							$player->teleport(new Vector3($this->getConfig()->get("GAplle-X"), $this->getConfig()->get("GAplle-Y"), $this->getConfig()->get("GAplle-Z")));
						}
						if($itemClicked->getId() === ItemIds::CHEST){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to...");
							$player->teleport(new Vector3($this->getConfig()->get("Chest-X"), $this->getConfig()->get("Chest-Y"), $this->getConfig()->get("Chest-Z")));
						}
						if($itemClicked->getId() === ItemIds::MELON){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to...");
							$player->teleport(new Vector3($this->getConfig()->get("Melon-X"), $this->getConfig()->get("Melon-Y"), $this->getConfig()->get("Melon-Z")));
						}
						if($itemClicked->getId() === ItemIds::DIAMOND_SWORD){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to...");
							$player->teleport(new Vector3($this->getConfig()->get("DMDSword-X"), $this->getConfig()->get("DMDSword-Y"), $this->getConfig()->get("DMDSword-Z")));
						}
						if($itemClicked->getId() === ItemIds::STONE){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to...");
							$player->teleport(new Vector3($this->getConfig()->get("Stone-X"), $this->getConfig()->get("Stone-Y"), $this->getConfig()->get("Stone-Z")));
						}
						if($itemClicked->getId() === ItemIds::EGG){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to..");
							$player->teleport(new Vector3($this->getConfig()->get("EGG-X"), $this->getConfig()->get("EGG-Y"), $this->getConfig()->get("EGG-Z")));
						}
						if($itemClicked->getId() === ItemIds::SAND){
							$player->removeWindow($action->getInventory());
							$player->sendMessage("§8[§bXGTZonesGUI§8]§l »§r§7 Teleport to...");
							$player->teleport(new Vector3($this->getConfig()->get("Sand-X"), $this->getConfig()->get("Sand-Y"), $this->getConfig()->get("Sand-Z")));
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
				}
		}
        return true;
	}
}
