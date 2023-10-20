<?php

namespace App\Factory;

use App\Models\Type;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectDynamicFactory
{
    private $typeId;
    private $title;
    private $createdAtTime;
    private $contractedAt;
    private $deadline;
    private $isChain;
    private $isOnTime;
    private $hasInvestors;
    private $hasOutsource;
    private $workerCount;
    private $serviceCount;
    private $comment;
    private $effectiveValue;

    /**
     * @param $typeId
     * @param $title
     * @param $createdAtTime
     * @param $contractedAt
     * @param $deadline
     * @param $isChain
     * @param $isOnTime
     * @param $hasInvestors
     * @param $hasOutsource
     * @param $workerCount
     * @param $serviceCount
     * @param $comment
     * @param $effectiveValue
     */
    public function __construct($typeId, $title, $createdAtTime, $contractedAt, $deadline, $isChain, $isOnTime, $hasInvestors, $hasOutsource, $workerCount, $serviceCount, $comment, $effectiveValue)
    {
        $this->typeId = $typeId;
        $this->title = $title;
        $this->createdAtTime = $createdAtTime;
        $this->contractedAt = $contractedAt;
        $this->deadline = $deadline;
        $this->isChain = $isChain;
        $this->isOnTime = $isOnTime;
        $this->hasInvestors = $hasInvestors;
        $this->hasOutsource = $hasOutsource;
        $this->workerCount = $workerCount;
        $this->serviceCount = $serviceCount;
        $this->comment = $comment;
        $this->effectiveValue = $effectiveValue;
    }

    public static function make($map, $row)
    {
        return new self(
            self::getTypeId($map, $row[0]),
            $row[1],
            Date::excelToDateTimeObject($row[2]),
            Date::excelToDateTimeObject($row[9]),
            isset($row[7]) ? Date::excelToDateTimeObject($row[7]) : null,
             isset($row[3]) ? self::getBool($row[3]) : null ,
            isset($row[8]) ? self::getBool($row[8]) : null ,
            isset($row[5]) ? self::getBool($row[5]) : null ,
            isset($row[6]) ? self::getBool($row[6]) : null ,
            $row[4] ?? null,
            $row[10] ?? null,
            $row[11] ?? null,
            $row[12] ?? null,
        );
    }

    private static function getTypesMap($types): array
    {
        $map = [];
        foreach ($types as $type){
            $map[$type->title] = $type->id;
        }
        return $map;
    }

    private static function getTypeId($map, $title)
    {
        return $map[$title] ?? Type::create(['title' => $title])->id;
    }

    private static function getBool($item): bool
    {
        return $item == 'Да';
    }

    public function getOriginalValues(): array
    {
        return [
            'type_id'=>$this->getValues()['type_id'],
            'title'=>$this->getValues()['title'],
            'created_at_time'=>$this->getValues()['created_at_time'],
            'contracted_at'=>$this->getValues()['contracted_at'],
        ];
    }

    public function getValues(): array
    {
        $props = get_object_vars($this);
        $res = [];
        foreach ($props as $key => $prop){
            $res[Str::snake($key)] = $prop;
        }
        return $res;
    }

}
