<?php

namespace App\Factory;

use App\Models\Type;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectFactory
{



    private $typeId;
    private $title;
    private $createdAtTime;
    private $contractedAt;
    private $deadline;
    private $isChain;
    private $isOnTime;
    private $hasOutsource;
    private $hasInvestors;
    private $workerCount;
    private $serviceCount;
    private $paymentFirstStep;
    private $paymentSecondStep;
    private $paymentThirdStep;
    private $paymentFourthStep;
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
     * @param $hasOutsource
     * @param $hasInvestors
     * @param $workerCount
     * @param $serviceCount
     * @param $paymentFirstStep
     * @param $paymentSecondStep
     * @param $paymentThirdStep
     * @param $paymentFourthStep
     * @param $comment
     * @param $effectiveValue
     */
    public function __construct($typeId, $title, $createdAtTime, $contractedAt, $deadline, $isChain, $isOnTime, $hasOutsource, $hasInvestors, $workerCount, $serviceCount, $paymentFirstStep, $paymentSecondStep, $paymentThirdStep, $paymentFourthStep, $comment, $effectiveValue)
    {
        $this->typeId = $typeId;
        $this->title = $title;
        $this->createdAtTime = $createdAtTime;
        $this->contractedAt = $contractedAt;
        $this->deadline = $deadline;
        $this->isChain = $isChain;
        $this->isOnTime = $isOnTime;
        $this->hasOutsource = $hasOutsource;
        $this->hasInvestors = $hasInvestors;
        $this->workerCount = $workerCount;
        $this->serviceCount = $serviceCount;
        $this->paymentFirstStep = $paymentFirstStep;
        $this->paymentSecondStep = $paymentSecondStep;
        $this->paymentThirdStep = $paymentThirdStep;
        $this->paymentFourthStep = $paymentFourthStep;
        $this->comment = $comment;
        $this->effectiveValue = $effectiveValue;
    }

    public static function make($map, $row)
    {
        return new self(
            self::getTypeId($map, $row['tip']),
            $row['naimenovanie'],
            Date::excelToDateTimeObject($row['data_sozdaniia']),
            Date::excelToDateTimeObject($row['podpisanie_dogovora']),
            isset($row['dedlain']) ? Date::excelToDateTimeObject($row['dedlain']) : null,
            isset($row['setevik']) ? self::getBool($row['setevik']) : null,
            self::getBool($row['sdaca_v_srok']),
            self::getBool($row['nalicie_autsorsinga']),
            self::getBool($row['nalicie_investorov']),
            $row['kolicestvo_ucastnikov'] ?? null ?? null ,
            $row['kolicestvo_uslug'] ?? null ,
            $row['vlozenie_v_pervyi_etap'] ?? null ,
            $row['vlozenie_vo_vtoroi_etap'] ?? null ,
            $row['vlozenie_v_tretii_etap'] ?? null ,
            $row['vlozenie_v_cetvertyi_etap'] ?? null ,
            $row['kommentarii'] ?? null ,
            $row['znacenie_effektivnosti'] ?? null ,
        );
    }
    private static function getTypeId($map, $title)
    {
        return isset($map[$title]) ? $map[$title] : Type::create(['title' => $title])->id;
    }

    public static function getBool($item): bool
    {
        return $item == 'Да';
    }

    public function getValues() : array
    {
        $props = get_object_vars($this);

        $res = [];

        foreach ($props as $key => $prop) {
            $res[Str::snake($key)] = $prop;
        }
        return $res;


    }

}
