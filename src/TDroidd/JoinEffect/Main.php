<?php
namespace TDroidd\JoinEffect;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;
class Main extends PluginBase implements Listener {
	/**
	 * OnEnable
	 *
	 * (non-PHPdoc)
	 * 
	 * @see \pocketmine\plugin\PluginBase::onEnable()
	 */	
	 public function onEnable(){
		$this->saveDefaultConfig();
		$cfg = yaml_parse(file_get_contents($this->getDataFolder() . "config.yml"));
		$this->effect = array($cfg["Effect-ID"]);
		$this->duration = array($cfg["Duration"]);
		$this->particles = array($cfg["Particles"]);
		$cfg = $this->getConfig()->getAll();
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info(TextFormat::GREEN . "JoinEffect By TDroidd  0.1 Enabled!");
}
		public function onJoin(PlayerJoinEvent $event) {
		$p = $event->getPlayer();
		$cfg = $this->getConfig()->getAll();
		$effect = Effect::getEffect($this->effect = $cfg["Effect-ID"]); //Effect ID
		$effect->setVisible($this->particles = $cfg["Particles"]); //Particles
		$effect->setDuration($this->duration = $cfg["Duration"]); //Ticks
		$p->addEffect($effect);
	}
	/**
	 * OnDisable
	 * (non-PHPdoc)
	 * 
	 * @see \pocketmine\plugin\PluginBase::onDisable()
	 */
	public function onDisable() {
		$this->getLogger()->info(TextFormat::RED . "JoinEffect By TDroidd 0.1 Unloaded!");
	}
}
