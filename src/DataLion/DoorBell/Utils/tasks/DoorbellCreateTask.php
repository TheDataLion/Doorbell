<?php


namespace DataLion\DoorBell\Utils\tasks;


use DataLion\DoorBell\Main;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class DoorbellCreateTask extends Task
{
    private $playername;

    /** @var bool */
    private $cancel = false;

    public function __construct(string $playername)
    {
        $this->playername = $playername;
    }


    /**
     * @param bool $cancel
     */
    public function setCanceled(bool $cancel = true): void
    {
        $this->cancel = $cancel;
    }

    /**
     * @return bool
     */
    public function isCanceled(): bool
    {
        return $this->cancel;
    }


    public function onRun(int $currentTick)
    {
        if($this->isCanceled()) return;
        if(!isset(Main::$doorbellPlaceSession[$this->playername])) return;
        unset(Main::$doorbellPlaceSession[$this->playername]);


        $player = Server::getInstance()->getPlayer($this->playername);


        if(!is_null($player)) $player->sendMessage(TextFormat::GREEN."[Doorbell] Creation time ended.");
    }
}